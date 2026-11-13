<?php

namespace Oree\Api;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Replaces the published PDF menu and keeps the previous one in the archive folder.
 */
final class MenuService
{
	// ========================================
	// Constants
	// ========================================

	/** Maximum size of an uploaded menu, in bytes */
	public const int MAX_SIZE_BYTES = 10 * 1024 * 1024;

	// ========================================
	// Properties
	// ========================================

	/** Absolute path of the published menu */
	private readonly string $menuPath;

	/** Absolute path of the folder where previous menus are kept */
	private readonly string $archiveDirectory;

	// ========================================
	// Constructor & Configuration
	// ========================================

	/**
	 * The menu is published at assets/carte/menu_oree.pdf and archived in assets/carte/archives, relative to the site root.
	 */
	public function __construct()
	{
		$siteRoot = dirname(__DIR__, 2);
		$this->menuPath = $siteRoot . '/assets/carte/menu_oree.pdf';
		$this->archiveDirectory = $siteRoot . '/assets/carte/archives';
	}

	// ========================================
	// Public Methods
	// ========================================

	/**
	 * Archives the current menu, then publishes the uploaded PDF in its place.
	 *
	 * @param UploadedFile $file The uploaded file
	 * @return string|null Name of the archive file holding the previous menu, or null if there was no previous menu
	 * @throws \InvalidArgumentException If the file is not a valid PDF of acceptable size
	 * @throws \RuntimeException If the archive or the new menu cannot be written
	 */
	public function replace(UploadedFile $file): ?string
	{
		if (!$file->isValid() || $file->getSize() > self::MAX_SIZE_BYTES) {
			throw new \InvalidArgumentException('The file is missing, too large or not uploaded correctly.');
		}
		if (!\Osimatic\Text\PDF::checkFile($file->getPathname(), $file->getClientOriginalName())) {
			throw new \InvalidArgumentException('The file is not a PDF.');
		}

		$archiveName = null;
		if (is_file($this->menuPath)) {
			$archiveName = $this->buildArchiveName();
			if (!\Osimatic\FileSystem\FileSystem::createDirectories($this->archiveDirectory . DIRECTORY_SEPARATOR)) {
				throw new \RuntimeException('Unable to create the archive directory.');
			}
			if (!copy($this->menuPath, $this->archiveDirectory . DIRECTORY_SEPARATOR . $archiveName)) {
				throw new \RuntimeException('Unable to archive the current menu.');
			}
		}

		if (!copy($file->getPathname(), $this->menuPath)) {
			throw new \RuntimeException('Unable to publish the new menu.');
		}

		return $archiveName;
	}

	// ========================================
	// Helper Methods
	// ========================================

	/**
	 * Builds the archive file name: "<menu name>_<date>.pdf", with the time added if a file already exists for that day.
	 */
	private function buildArchiveName(): string
	{
		$baseName = pathinfo($this->menuPath, PATHINFO_FILENAME);
		$extension = pathinfo($this->menuPath, PATHINFO_EXTENSION);
		$name = $baseName . '_' . date('Y-m-d') . '.' . $extension;
		if (file_exists($this->archiveDirectory . DIRECTORY_SEPARATOR . $name)) {
			$name = $baseName . '_' . date('Y-m-d_His') . '.' . $extension;
		}
		return $name;
	}
}