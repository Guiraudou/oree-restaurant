<!-- Modal Offrir -->
<div class="modal fade modal-oree" id="modalOffrir" tabindex="-1" aria-labelledby="modalOffrirLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header border-0 pb-0">
				<p class="eyebrow text-uppercase text-terracotta mb-0">Offrir</p>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
			</div>
			<div class="modal-body">
				<h2 class="modal-title mb-3" id="modalOffrirLabel">Offrir un moment chez Orée</h2>
				<p class="lead">Envie de faire plaisir à vos proches ?</p>
				<p>Offrez-leur une expérience gourmande chez Orée, à travers un bon cadeau personnalisé.</p>
				<p>Pour créer votre bon cadeau sur mesure, contactez-nous directement par téléphone ou par e-mail. Nous serons ravis de vous accompagner dans votre choix.</p>
				<p class="mb-1">Par téléphone : <a class="link" href="tel:<?= PHONE ?>" data-phone="<?= PHONE ?>"><?= PHONE ?></a></p>
				<p class="mb-0">Par e-mail : <a class="link" href="mailto:<?= EMAIL ?>"><?= EMAIL ?></a></p>
			</div>
		</div>
	</div>
</div>

<!-- Modal Ouverture (s'ouvre au chargement de la page) -->
<div class="modal fade modal-oree" id="modalOuverture" tabindex="-1" aria-labelledby="modalOuvertureLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content text-center">
			<div class="modal-header border-0 pb-0 justify-content-end">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
			</div>
			<div class="modal-body pt-0 px-md-4 pb-4">
				<img class="encart__logo d-block mx-auto mb-4" src="assets/img/logo-noir.png" alt="<?= SITE_NAME ?>" width="240" height="82">
				<p class="eyebrow text-uppercase text-terracotta mb-3" id="modalOuvertureLabel">Ouverture le 16 novembre 2026</p>
			</div>
		</div>
	</div>
</div>

<!-- Modal Mentions légales -->
<div class="modal fade modal-oree" id="modalMentionsLegales" tabindex="-1" aria-labelledby="modalMentionsLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
		<div class="modal-content">
			<div class="modal-header border-0 pb-0">
				<p class="eyebrow text-uppercase text-terracotta mb-0">Informations légales</p>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
			</div>
			<div class="modal-body">
				<h2 class="modal-title mb-4" id="modalMentionsLabel">Mentions légales</h2>

				<h3 class="fs-5 text-terracotta">Éditeur du site</h3>
				<p class="small">
					<?= SITE_NAME ?> — <?= COMPANY_LEGAL_FORM ?> au capital de <span data-capital="<?= COMPANY_CAPITAL ?>"><?= number_format(COMPANY_CAPITAL, 0, ',', ' ') ?> €</span><br>
					Siège social : <?= ADDRESS_LINE_1 ?>, <?= ADDRESS_LINE_2 ?><br>
					SIRET : <span data-siret="<?= COMPANY_SIRET ?>"><?= COMPANY_SIRET ?></span> — TVA intracommunautaire : <?= COMPANY_VAT_NUMBER ?><br>
					Téléphone : <a class="link" href="tel:<?= PHONE ?>" data-phone="<?= PHONE ?>"><?= PHONE ?></a><br>
					E-mail : <a class="link" href="mailto:<?= EMAIL ?>"><?= EMAIL ?></a>
				</p>

				<h3 class="fs-5 text-terracotta">Directeur de la publication</h3>
				<p class="small">Chloé Reveillere, en qualité de Présidente.</p>

				<h3 class="fs-5 text-terracotta">Hébergement</h3>
				<p class="small">
					OVH<br>
					2 rue Kellermann, 59100 Roubaix, France<br>
					Contact : www.ovhcloud.com/fr/contact
				</p>

				<h3 class="fs-5 text-terracotta">Propriété intellectuelle</h3>
				<p class="small">
					L’ensemble des contenus du site (textes, photographies, vidéos, logo, graphismes) est protégé par le droit d’auteur.
					Toute reproduction, représentation ou adaptation, totale ou partielle, sans autorisation écrite préalable de <?= SITE_NAME ?>, est interdite.
				</p>

				<h3 class="fs-5 text-terracotta">Données personnelles</h3>
				<p class="small">
					Les informations recueillies via le formulaire de contact ou par e-mail sont utilisées uniquement pour répondre à votre demande.
					Elles ne sont ni cédées ni vendues à des tiers. Conformément au Règlement général sur la protection des données (RGPD) et à la loi Informatique et Libertés,
					vous disposez d’un droit d’accès, de rectification et de suppression de vos données, que vous pouvez exercer en nous écrivant à <a class="link" href="mailto:<?= EMAIL ?>"><?= EMAIL ?></a>.
				</p>

				<h3 class="fs-5 text-terracotta">Cookies</h3>
				<p class="small mb-0">
					Ce site n’utilise pas de cookies publicitaires. Il peut charger des ressources de services tiers (polices Google Fonts, module de réservation Zenchef) susceptibles de déposer leurs propres cookies, selon leurs politiques respectives.
				</p>
			</div>
		</div>
	</div>
</div>
