<?php

namespace Oree\Api;

use Osimatic\Data\JsonDB;

/**
 * Accounts of the administration, stored in api/data/users.json.
 * An account has an e-mail address (the login), a password hashed with password_hash(), a first name and a last name.
 *
 * @link https://www.php.net/manual/en/function.password-hash.php password_hash
 * @link https://www.php.net/manual/en/function.password-verify.php password_verify
 */
final class UserService
{
	// ========================================
	// Constants
	// ========================================

	/** Name of the JSON file holding the accounts */
	private const string FILENAME = 'users.json';

	/** Minimum length of a password */
	private const int MIN_PASSWORD_LENGTH = 6;

	// ========================================
	// Constructor & Configuration
	// ========================================

	/**
	 * @param JsonDB $jsonDB The JsonDB instance giving access to the data directory
	 */
	public function __construct(private readonly JsonDB $jsonDB) {}

	// ========================================
	// Public Methods
	// ========================================

	/**
	 * Returns the account if the e-mail address and the password match, null otherwise.
	 *
	 * @param string $email The e-mail address (login)
	 * @param string $password The password in clear
	 * @return array{email: string, firstName: string, lastName: string, passwordHash: string}|null The account, or null
	 */
	public function authenticate(string $email, string $password): ?array
	{
		$user = $this->findByEmail($email);
		return null !== $user && password_verify($password, $user['passwordHash']) ? $user : null;
	}

	/**
	 * Changes the password of an account, after checking the current one.
	 *
	 * @param string $email The e-mail address (login) of the account
	 * @param string $currentPassword The current password in clear
	 * @param string $newPassword The new password in clear
	 * @return bool True if the password has been changed, false if the account or the current password does not match
	 * @throws \InvalidArgumentException If the new password is too short
	 */
	public function changePassword(string $email, string $currentPassword, string $newPassword): bool
	{
		if (strlen($newPassword) < self::MIN_PASSWORD_LENGTH) {
			throw new \InvalidArgumentException('The new password is too short.');
		}

		$normalizedEmail = self::normalizeEmail($email);
		$users = $this->read();
		foreach ($users as $index => $user) {
			if ($user['email'] !== $normalizedEmail) {
				continue;
			}
			if (!password_verify($currentPassword, $user['passwordHash'])) {
				return false;
			}
			$users[$index]['passwordHash'] = password_hash($newPassword, PASSWORD_DEFAULT);
			$this->jsonDB->write(self::FILENAME, $users);
			return true;
		}
		return false;
	}

	// ========================================
	// Helper Methods
	// ========================================

	/**
	 * Finds an account by its e-mail address.
	 *
	 * @param string $email The e-mail address (login)
	 * @return array{email: string, firstName: string, lastName: string, passwordHash: string}|null The account, or null
	 */
	private function findByEmail(string $email): ?array
	{
		$normalizedEmail = self::normalizeEmail($email);
		foreach ($this->read() as $user) {
			if ($user['email'] === $normalizedEmail) {
				return $user;
			}
		}
		return null;
	}

	/**
	 * Reads the accounts from the JSON file.
	 *
	 * @return array<int, array{email: string, firstName: string, lastName: string, passwordHash: string}> The accounts (empty array if none)
	 */
	private function read(): array
	{
		return array_values($this->jsonDB->read(self::FILENAME));
	}

	/**
	 * Normalizes an e-mail address for comparison: trimmed and lowercase.
	 *
	 * @param string $email The e-mail address
	 * @return string The normalized address
	 */
	private static function normalizeEmail(string $email): string
	{
		return strtolower(trim($email));
	}
}