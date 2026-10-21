<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= htmlspecialchars($meta_title ?? SITE_NAME . ' — Restaurant à Annecy · Cour de l\'Abbaye') ?></title>
	<?php if (!empty($meta_description)): ?>
	<meta name="description" content="<?= htmlspecialchars($meta_description) ?>">
	<?php endif; ?>
	<link rel="icon" href="favicon.ico" sizes="48x48">
	<link rel="icon" type="image/png" href="assets/img/favicon-192.png" sizes="192x192">
	<link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;1,400&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="dist/vendor.css?<?= ASSET_TOKEN ?>">
	<link rel="stylesheet" href="css/style.css?<?= ASSET_TOKEN ?>">
</head>
<body>

<header class="navbar navbar-expand-md navbar-dark fixed-top header" id="header">
	<div class="container-fluid px-3 px-md-4">
		<a href="#accueil" class="navbar-brand header__logo" aria-label="<?= SITE_NAME ?> — accueil">
			<img src="assets/img/logo-nude.png" alt="<?= SITE_NAME ?>" width="120" height="41">
		</a>
		<button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Menu">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="nav">
			<nav class="navbar-nav mx-auto header__nav" aria-label="Navigation principale">
				<a class="nav-link" href="#lieu">Le lieu</a>
				<a class="nav-link" href="#carte">La carte</a>
				<a class="nav-link" href="#equipe">Derrière Orée</a>
				<a class="nav-link" href="#reserver">Contact</a>
			</nav>
			<div class="d-flex gap-3">
				<button type="button" class="btn btn-oree btn-sm" data-bs-toggle="modal" data-bs-target="#modalOffrir">Offrir</button>
				<a href="<?= BOOKING_URL ?>" class="btn btn-oree btn-sm" target="_blank" rel="noopener">Réserver</a>
			</div>
		</div>
	</div>
</header>

<main>