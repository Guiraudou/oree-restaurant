<?php

namespace Oree\Api;

use Osimatic\Data\JsonDB;
use Osimatic\FileSystem\FileSystem;
use Osimatic\Network\JsonRequest;
use Osimatic\Security\LoginSession;
use Osimatic\Security\RateLimiter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Handlers of the account routes: session, login, logout and password change. Each method returns a JSON response.
 */
final class AdminController
{
	// ========================================
	// Constants
	// ========================================

	/** Maximum number of login attempts per client IP within the time window */
	private const int MAX_LOGIN_ATTEMPTS = 10;

	/** Duration (in seconds) of the window used to count login attempts */
	private const int LOGIN_WINDOW_SECONDS = 900;

	// ========================================
	// Properties
	// ========================================

	/** The login session of the current request */
	private readonly LoginSession $session;

	/** The accounts */
	private readonly UserService $users;

	/** Limits the number of login attempts per client IP */
	private readonly RateLimiter $rateLimiter;

	// ========================================
	// Constructor & Configuration
	// ========================================

	public function __construct()
	{
		$config = new Config(dirname(__DIR__, 2), SITE_URL);
		$this->session = LoginSession::getInstance();
		$this->users = new UserService(new JsonDB($config->getDataDirectory()));

		// RateLimiter does not create its directory: it is created here, inside the data directory (not served over HTTP)
		$rateLimitDirectory = $config->getDataDirectory() . DIRECTORY_SEPARATOR . 'rate-limit';
		FileSystem::createDirectories($rateLimitDirectory . DIRECTORY_SEPARATOR);
		$this->rateLimiter = new RateLimiter($rateLimitDirectory);
	}

	// ========================================
	// Public Methods
	// ========================================

	/**
	 * Tells whether the caller is logged in, and who the user is.
	 */
	public function session(): JsonResponse
	{
		$user = $this->session->getUser();
		return new JsonResponse(['authenticated' => null !== $user, 'user' => $user]);
	}

	/**
	 * Logs a user in with the e-mail address (body field "email") and the password (body field "password").
	 */
	public function login(Request $request): JsonResponse
	{
		if (!$this->rateLimiter->check('login_' . $request->getClientIp(), self::MAX_LOGIN_ATTEMPTS, self::LOGIN_WINDOW_SECONDS)) {
			return new JsonResponse(['error' => 'too_many_attempts'], JsonResponse::HTTP_TOO_MANY_REQUESTS);
		}

		$body = JsonRequest::getBody($request);
		$user = $this->users->authenticate((string)($body['email'] ?? ''), (string)($body['password'] ?? ''));
		if (null === $user) {
			return new JsonResponse(['error' => 'invalid_credentials'], JsonResponse::HTTP_UNAUTHORIZED);
		}

		$this->session->login($user['email'], $user['firstName'], $user['lastName']);
		return new JsonResponse(['authenticated' => true, 'user' => $this->session->getUser()]);
	}

	/**
	 * Logs the caller out.
	 */
	public function logout(): JsonResponse
	{
		$this->session->logout();
		return new JsonResponse(['authenticated' => false]);
	}

	/**
	 * Changes the password of the logged-in user. The body holds "currentPassword" and "newPassword".
	 */
	public function changePassword(Request $request): JsonResponse
	{
		$user = $this->session->getUser();
		if (null === $user) {
			return new JsonResponse(['error' => 'unauthenticated'], JsonResponse::HTTP_UNAUTHORIZED);
		}

		$body = JsonRequest::getBody($request);
		try {
			$changed = $this->users->changePassword($user['email'], (string)($body['currentPassword'] ?? ''), (string)($body['newPassword'] ?? ''));
		} catch (\InvalidArgumentException) {
			return new JsonResponse(['error' => 'password_too_short'], JsonResponse::HTTP_BAD_REQUEST);
		}

		return $changed
			? new JsonResponse(['changed' => true])
			: new JsonResponse(['error' => 'invalid_current_password'], JsonResponse::HTTP_BAD_REQUEST);
	}
}
