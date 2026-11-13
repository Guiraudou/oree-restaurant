<?php
require_once __DIR__ . '/../inc/config.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex, nofollow">
	<title>Administration — <?= SITE_NAME ?></title>
	<link rel="stylesheet" href="../dist/vendor.css?<?= ASSET_TOKEN ?>">
	<link rel="stylesheet" href="../css/style.css?<?= ASSET_TOKEN ?>">
</head>
<body data-api="../api" data-home="../">

<main class="container py-5" id="adminContent" hidden>
	<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
		<h1 class="h3 mb-0">Administration</h1>
		<div class="d-flex flex-wrap align-items-center gap-3">
			<div class="d-flex align-items-center gap-2">
				<span class="rounded-circle bg-secondary text-white d-inline-flex align-items-center justify-content-center" style="width: 2.75rem; height: 2.75rem;" aria-hidden="true">
					<svg viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4.4 3.6-7 8-7s8 2.6 8 7z"/></svg>
				</span>
				<span id="userName" class="h5 mb-0"></span>
			</div>
			<button type="button" class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#passwordModal">Modifier mot de passe</button>
			<button type="button" id="logoutButton" class="btn btn-link p-0">Se déconnecter</button>
		</div>
	</div>

	<section id="menuSection" class="mb-5">
		<h2 class="h5 mb-3">Carte (PDF)</h2>
		<iframe id="menuPreview" src="../assets/carte/menu_oree.pdf?<?= time() ?>" title="Carte actuelle" class="w-100 mt-3 border" style="height: 70vh;"></iframe>
		<button type="button" class="btn btn-oree btn-oree--dark" data-bs-toggle="modal" data-bs-target="#menuModal">Modifier le PDF</button>
	</section>
</main>

<div class="modal fade modal-oree" id="menuModal" tabindex="-1" aria-labelledby="menuModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header border-0 pb-0">
				<h2 class="modal-title" id="menuModalLabel">Modifier la carte</h2>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
			</div>
			<div class="modal-body">
				<form id="menuForm">
					<div class="form-group">
						<label for="" class="form-label">Nouvelle carte :</label>
						<input type="file" name="menu" accept="application/pdf" class="form-control bg-white text-dark" required>
						<div class="form-text">Fichier PDF de 10 Mo maximum</div>
					</div>
					<button type="submit" class="btn btn-oree btn-oree--dark w-100" data-loading-text="Enregistrement…">Enregistrer</button>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade modal-oree" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header border-0 pb-0">
				<h2 class="modal-title" id="passwordModalLabel">Modifier le mot de passe</h2>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
			</div>
			<div class="modal-body">
				<form id="passwordForm">
					<div class="form-group">
						<label for="currentPassword" class="form-label">Mot de passe actuel :</label>
						<input type="password" id="currentPassword" name="currentPassword" class="form-control bg-white text-dark" autocomplete="current-password" required>
					</div>
					<div class="form-group">
						<label for="newPassword" class="form-label">Nouveau mot de passe :</label>
						<input type="password" id="newPassword" name="newPassword" class="form-control bg-white text-dark" autocomplete="new-password" minlength="6" required>
						<div class="form-text">6 caractères minimum</div>
					</div>
					<button type="submit" class="btn btn-oree btn-oree--dark w-100" data-loading-text="Enregistrement…">Enregistrer</button>
				</form>
			</div>
		</div>
	</div>
</div>

<script src="../dist/admin.js?<?= ASSET_TOKEN ?>"></script>
</body>
</html>
