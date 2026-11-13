<?php

namespace Oree\Api;

use Osimatic\Security\LoginSession;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Handlers of the menu routes. Each method returns a JSON response.
 */
final class MenuController
{
	/** The login session of the current request, checked before any change */
	private readonly LoginSession $session;

	/** Service publishing the menu and archiving the previous one */
	private readonly MenuService $menuService;

	public function __construct()
	{
		$this->session = LoginSession::getInstance();
		$this->menuService = new MenuService();
	}

	/**
	 * Replaces the published menu with the uploaded PDF (form field "menu"), archiving the previous one.
	 */
	public function replace(Request $request): JsonResponse
	{
		if (!$this->session->isAuthenticated()) {
			return new JsonResponse(['error' => 'unauthenticated'], JsonResponse::HTTP_UNAUTHORIZED);
		}

		$file = $request->files->get('menu');
		if (null === $file) {
			return new JsonResponse(['error' => 'missing_file'], JsonResponse::HTTP_BAD_REQUEST);
		}

		try {
			$archiveName = $this->menuService->replace($file);
		} catch (\InvalidArgumentException $e) {
			return new JsonResponse(['error' => 'invalid_file', 'message' => $e->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
		} catch (\RuntimeException $e) {
			error_log('Menu replacement failed: ' . $e->getMessage());
			return new JsonResponse(['error' => 'storage_failure'], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
		}

		return new JsonResponse(['archive' => $archiveName]);
	}
}