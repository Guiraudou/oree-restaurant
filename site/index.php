<?php require_once 'model/config.php'; ?>
<?php
$meta_title = 'Orée — Restaurant à Annecy · Cour de l’Abbaye';
$meta_description = 'Orée, table gastronomique à Annecy, dans le domaine de la Fondation d’Art Christian Réal – La Cour de l’Abbaye. Une cuisine exigeante de haute précision, servie avec la simplicité d’une maison qui aime recevoir.';
?>
<?php require_once 'header.inc.php'; ?>

	<!-- HERO : carrousel de vidéos très courtes -->
	<section class="hero position-relative overflow-hidden vh-100 d-flex align-items-center justify-content-center text-center" id="accueil">
		<div class="hero__slides" id="slides">
			<!-- Photos animées (effet Ken Burns). Pour une vraie vidéo : renseigner data-src (mp4/webm, 3–6 s, sans son, < 3 Mo) -->
			<div class="slide slide--1 is-active" data-src="" data-label="La Cour de l’Abbaye">
				<img class="slide__photo" src="assets/img/vue_ensemble.jpg" alt="">
			</div>
			<div class="slide slide--2" data-src="" data-label="La terrasse">
				<img class="slide__photo" src="assets/img/exterieur2.jpg" alt="">
			</div>
			<!--<div class="slide slide--3" data-src="" data-label="L’assiette">
				<img class="slide__photo" src="assets/img/plat1.jpg" alt="">
			</div>
			<div class="slide slide--4" data-src="" data-label="Le tartare">
				<img class="slide__photo" src="assets/img/plat2.jpg" alt="">
			</div>-->
		</div>
		<div class="hero__shade"></div>

		<div class="position-relative z-2 px-4">
			<img class="hero__logo d-block mx-auto mb-5" src="assets/img/logo-nude.png" alt="<?= SITE_NAME ?>" width="420" height="143">
			<!--<p class="hero__tagline fw-light mb-4">Une cuisine exigeante de haute précision,<br>servie avec la simplicité d’une maison qui aime recevoir.</p>-->
			<a href="<?= BOOKING_URL ?>" class="btn btn-oree mt-5" target="_blank" rel="noopener">Réserver une table</a>
		</div>

		<div class="hero__dots" id="dots" role="tablist" aria-label="Diaporama"></div>
		<a href="#lieu" class="hero__scroll" aria-label="Descendre"><span></span></a>
	</section>

	<!-- LE LIEU -->
	<section class="panel panel--forest panel--left" id="lieu">
		<div class="panel__stage">
			<figure class="panel__photo">
				<div class="panel__frame panel__frame--swap"><img src="assets/img/exterieur2.jpg" alt="La terrasse d’Orée sous les arbres, dans les jardins de la Fondation" loading="lazy"><img src="assets/img/vue_ensemble.jpg" alt="Vue aérienne du restaurant Orée et de son jardin, dans le domaine de la Fondation" loading="lazy"></div>
			</figure>
			<div class="panel__text">
				<div class="panel__inner">
					<p class="eyebrow mb-3 text-uppercase text-matcha">Le lieu</p>
					<h2>Un lieu où l’on se sent bien</h2>
					<p class="lead">Au cœur de la Cour de l’Abbaye, à Annecy-le-Vieux, Orée prend place dans un cadre singulier, où se rencontrent l’art, la nature et le calme du jardin.</p>
					<p>Nous avons imaginé ce restaurant comme un lieu de vie et de partage, à notre image. Ici, nous aimons recevoir avec simplicité, générosité et attention. Une adresse chaleureuse, où l’on prend plaisir à se retrouver, à découvrir, à bien manger et à profiter du moment.</p>
				</div>
			</div>
		</div>
	</section>

	<!-- LA CARTE -->
	<section class="panel panel--nude panel--right" id="carte">
		<div class="panel__stage">
			<figure class="panel__photo">
				<div class="panel__frame panel__frame--color panel__frame--ocre"><!-- Photos provisoirement retirées (shooting prévu début novembre) -->
					<!--<img src="assets/img/plat1.jpg" alt="Assiette de la carte, sur porcelaine blanche" loading="lazy">
					<img src="assets/img/plat2.jpg" alt="Tartare et jeunes pousses de laitue sur assiette noire" loading="lazy">-->
				</div>
			</figure>
			<div class="panel__text">
				<div class="panel__inner">
					<p class="eyebrow mb-3 text-uppercase text-terracotta">La carte</p>
					<h2>Au fil des saisons et des arrivages</h2>

					<h3 class="fs-5 mt-5 mb-3 text-terracotta">Nos formules</h3>
					<ul class="list-unstyled row g-3 mb-0 formules">
						<li class="col-xl-4">
							<div class="formule">
								<div class="d-flex justify-content-between align-items-baseline gap-3"><h4>Cimes</h4><span class="text-nowrap">39 €</span></div>
								<p class="note text-uppercase text-terracotta">Le midi</p>
								<p>Chaque midi, notre équipe vous présente de vive voix le plat du jour, inspiré par la saison. Vous choisissez ensuite une entrée et un dessert à la carte.</p>
							</div>
						</li>
						<li class="col-xl-4">
							<div class="formule">
								<div class="d-flex justify-content-between align-items-baseline gap-3"><h4>Hêtre</h4><span class="text-nowrap">55 €</span></div>
								<p class="note text-uppercase text-terracotta">Entrée, plat, dessert</p>
								<p>Composez votre menu au gré de vos envies : une entrée, un plat et un dessert choisis à la carte.</p>
							</div>
						</li>
						<li class="col-xl-4">
							<div class="formule">
								<div class="d-flex justify-content-between align-items-baseline gap-3"><h4>Lichen</h4><span class="text-nowrap">79 €</span></div>
								<p class="note text-uppercase text-terracotta">Le soir</p>
								<p>Le soir, laissez-vous guider sur les sentiers d’un menu en cinq temps.</p>
							</div>
						</li>
					</ul>

					<p class="text-center mt-5 mb-0"><a class="btn btn-oree btn-oree--dark" href="<?= MENU_PDF ?>" target="_blank" rel="noopener">Voir la carte (PDF)</a></p>
				</div>
			</div>
		</div>
	</section>

	<!-- DERRIERE OREE -->
	<section class="panel panel--terra panel--left" id="equipe">
		<div class="panel__stage">
			<figure class="panel__photo">
				<!-- Photo provisoirement retirée (shooting prévu début novembre) -->
				<div class="panel__frame panel__frame--color panel__frame--forest"><!--<img src="assets/img/julien.jpg" alt="Le chef Julien Guiraudou, derrière le comptoir d’Orée" loading="lazy" style="object-position: 35% center">--></div>
			</figure>
			<div class="panel__text">
				<div class="panel__inner">
					<p class="eyebrow mb-3 text-uppercase text-nude opacity-75">Derrière Orée</p>
					<h2>Chloé Réveillère &amp; Julien Guiraudou</h2>
					<p>Notre histoire commence sur les bancs de l’école Ferrandi à Paris, où nous nous sommes rencontrés autour d’une passion commune pour la gastronomie.</p>
					<p>Depuis, nos parcours nous ont menés dans de prestigieuses maisons étoilées, en France comme à l’étranger, de Paris à Londres, jusqu’au Japon. Des expériences enrichissantes, ponctuées de concours gastronomiques, qui ont façonné notre savoir-faire et notre vision de la restauration.</p>
					<p>Passionné par la précision et la technicité en cuisine, Julien partage cette aventure avec son frère Maxime, lui aussi passé par de grandes maisons gastronomiques. Une complicité familiale et une même exigence au service d’une cuisine précise, généreuse et sincère.</p>
					<p>En salle, Chloé apporte sa bonne humeur, son sens de l’accueil et son attention aux détails, pour que chacun se sente naturellement à sa place.</p>
					<p>Après plus de dix ans à imaginer notre propre restaurant, nous donnons enfin vie à Orée. Un lieu à notre image, où l’exigence rencontre la simplicité et où le plaisir de recevoir reste essentiel.</p>
				</div>
			</div>
		</div>
	</section>

	<!-- RESERVER / INFOS -->
	<section class="section section--forest min-vh-100 d-flex flex-column" id="reserver">
		<div class="container my-auto">
			<div class="row justify-content-center text-center">
				<div class="col-lg-8">
					<span class="sprig--nude d-block mx-auto mb-4" role="presentation"></span>
					<h2 class="mb-4">Réserver une table</h2>
					<ul class="list-unstyled mx-auto mt-4 mb-5 horaires">
						<li><span class="text-end">Lundi</span><span>:</span><span>Midi et Soir</span></li>
						<li><span class="text-end">Mardi</span><span>:</span><span>Midi et Soir</span></li>
						<li><span class="text-end">Mercredi</span><span>:</span><span>Midi</span></li>
						<li><span class="text-end">Jeudi</span><span>:</span><span>Midi et Soir</span></li>
						<li><span class="text-end">Vendredi</span><span>:</span><span>Midi et Soir</span></li>
					</ul>
					<p class="mb-4"><a href="<?= BOOKING_URL ?>" class="btn btn-oree btn-oree--big" target="_blank" rel="noopener">Réserver en ligne</a></p>
					<p class="small mb-0">ou par téléphone au <a class="link link--light" href="tel:<?= PHONE ?>" data-phone="<?= PHONE ?>"><?= PHONE ?></a></p>

					<div class="row g-4 mt-5 pt-5 border-top border-light border-opacity-25">
						<div class="col-md-4">
							<h4 class="fw-normal text-matcha mb-2">Adresse</h4>
							<p class="small mb-0"><?= ADDRESS_LINE_1 ?><br><?= ADDRESS_LINE_2 ?></p>
						</div>
						<div class="col-md-4">
							<h4 class="fw-normal text-matcha mb-2">Contact</h4>
							<p class="small mb-0"><a class="link link--light" href="mailto:<?= EMAIL ?>"><?= EMAIL ?></a><br><a class="link link--light d-inline-block mt-2" href="tel:<?= PHONE ?>" data-phone="<?= PHONE ?>"><?= PHONE ?></a></p>
						</div>
						<div class="col-md-4">
							<h4 class="fw-normal text-matcha mb-2">Suivez-nous</h4>
							<p class="small mb-1"><a class="link link--light d-inline-flex align-items-center gap-2" href="<?= INSTAGRAM_URL ?>" target="_blank" rel="noopener"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4.2"/><circle cx="17.3" cy="6.7" r=".6" fill="currentColor"/></svg><span data-instagram><?= INSTAGRAM_URL ?></span></a></p>
							<p class="small mb-0"><a class="link link--light d-inline-flex align-items-center gap-2" href="<?= FACEBOOK_URL ?>" target="_blank" rel="noopener"><svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" aria-hidden="true"><path d="M13.5 21v-7.5h2.6l.4-3h-3V8.6c0-.9.3-1.5 1.5-1.5h1.6V4.4c-.3 0-1.2-.1-2.3-.1-2.3 0-3.8 1.4-3.8 3.9v2.3H8v3h2.5V21h3z"/></svg><span>Facebook</span></a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php require_once 'modal.inc.php'; ?>

<?php require_once 'footer.inc.php'; ?>
