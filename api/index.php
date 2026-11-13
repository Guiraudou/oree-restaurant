<?php

/**
 * Front controller of the API: every request under /api is routed here (see api/.htaccess).
 */

use Oree\Api\AdminController;
use Oree\Api\MenuController;
use Osimatic\Network\ApiRouter;
use Osimatic\Network\HTTPMethod;
use Osimatic\Security\LoginSession;
use Symfony\Component\HttpFoundation\Request;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/../inc/config.php';

$request = Request::createFromGlobals();

LoginSession::initialize('oree_admin', 28800, 120);
LoginSession::getInstance()->start($request);

$admin = new AdminController();
$menu = new MenuController();

$router = (new ApiRouter())->requireTrustedOrigin();
$router->add(HTTPMethod::GET, '/auth/session', $admin->session(...));
$router->add(HTTPMethod::POST, '/auth/login', $admin->login(...));
$router->add(HTTPMethod::POST, '/auth/logout', $admin->logout(...));
$router->add(HTTPMethod::POST, '/auth/password', $admin->changePassword(...));
$router->add(HTTPMethod::POST, '/menu', $menu->replace(...));

$router->dispatch($request)->send();