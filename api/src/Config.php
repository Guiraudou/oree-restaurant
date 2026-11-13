<?php

namespace Oree\Api;

/**
 * Configuration of the API: reads the local secrets file (secret.ini, not versioned) and exposes the settings the API needs, with sensible defaults.
 *
 * Supported keys of secret.ini:
 * - rp_id: domain name credentials are bound to (default: host of SITE_URL), to override for local development (e.g. "localhost").
 */
final class Config
{
	// ========================================
	// Properties
	// ========================================

	/** @var array<string, string> Raw values of the secrets file */
	private readonly array $values;

	// ========================================
	// Constructor & Configuration
	// ========================================

	/**
	 * @param string $siteRoot Absolute path of the site root (the folder containing "api", "assets" and "inc")
	 * @param string $siteUrl Public URL of the site (SITE_URL constant)
	 */
	public function __construct(
		private readonly string $siteRoot,
		private readonly string $siteUrl,
	)
	{
		$this->values = $this->loadSecrets($siteRoot . DIRECTORY_SEPARATOR . 'secret.ini');
	}

	// ========================================
	// Public Methods
	// ========================================

	/**
	 * Returns the absolute path of the site root.
	 */
	public function getSiteRoot(): string
	{
		return $this->siteRoot;
	}

	/**
	 * Returns the absolute path of the folder where the API keeps its data (passkeys, rate limiting counters, logs). It is not served over HTTP.
	 */
	public function getDataDirectory(): string
	{
		return $this->siteRoot . DIRECTORY_SEPARATOR . 'data';
	}

	/**
	 * Returns the domain name passkeys are bound to.
	 */
	public function getRelyingPartyId(): string
	{
		$configured = $this->values['rp_id'] ?? '';
		if ('' !== $configured) {
			return $configured;
		}
		return (string)parse_url($this->siteUrl, PHP_URL_HOST);
	}

	// ========================================
	// Helper Methods
	// ========================================

	/**
	 * Reads the secrets file. Values are read raw (no interpretation of special characters), surrounding quotes are removed.
	 *
	 * @param string $path Absolute path of the secrets file
	 * @return array<string, string> The values (empty array if the file is missing or unreadable)
	 */
	private function loadSecrets(string $path): array
	{
		if (!is_file($path)) {
			return [];
		}
		$parsed = @parse_ini_file($path, false, INI_SCANNER_RAW);
		if (!is_array($parsed)) {
			return [];
		}

		$values = [];
		foreach ($parsed as $key => $value) {
			if (is_string($value)) {
				$values[(string)$key] = trim($value, " \t\"'");
			}
		}
		return $values;
	}
}