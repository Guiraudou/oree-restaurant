import 'bootstrap/dist/css/bootstrap.min.css';
import {Modal} from 'bootstrap';
import {TelephoneNumber} from '@osimatic/core-js/contact_details.js';
import {SocialNetwork} from '@osimatic/core-js/social_network.js';
import {Organization} from '@osimatic/core-js/organization.js';
import {Currency} from '@osimatic/core-js/number.js';

// Popup d'annonce de l'ouverture : affichée au chargement, une seule fois par session
(function () {
	return;
	var el = document.getElementById('modalOuverture');
	if (!el) return;
	try {
		if (sessionStorage.getItem('oree-ouverture-vue')) return;
		sessionStorage.setItem('oree-ouverture-vue', '1');
	} catch (e) {
	}
	Modal.getOrCreateInstance(el).show();
})();

// Numéros de téléphone : affichage au format national à partir du format international (href="tel:+33…")
// Pays par défaut requis par core-js (sans lui, formatNational échoue sur toUpperCase et renvoie une chaîne vide)
TelephoneNumber.setLocalCountryCode('FR');
document.querySelectorAll('[data-phone]').forEach(function (el) {
	el.textContent = TelephoneNumber.formatNational(el.getAttribute('data-phone'));
});

// SIRET : affichage groupé (ex. "109 978 346 00012")
document.querySelectorAll('[data-siret]').forEach(function (el) {
	el.textContent = Organization.formatFranceSiret(el.getAttribute('data-siret'));
});

// Capital social : affichage monétaire (ex. "10 000 €")
document.querySelectorAll('[data-capital]').forEach(function (el) {
	el.textContent = Currency.format(Number(el.getAttribute('data-capital')), 0);
});

// Identifiant Instagram (@…) déduit de l'URL du profil
document.querySelectorAll('[data-instagram]').forEach(function (el) {
	el.textContent = SocialNetwork.getInstagramHandle(el.closest('a').href);
});

(function () {
	var SLIDE_DURATION = 6000;
	var header = document.getElementById('header');
	var slides = Array.prototype.slice.call(document.querySelectorAll('.slide'));
	var dotsEl = document.getElementById('dots');
	var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
	var current = 0;
	var timer = null;

	document.querySelector('.hero').style.setProperty('--slide-duration', SLIDE_DURATION + 'ms');

	// Vidéos : créées uniquement si data-src est renseigné
	slides.forEach(function (slide) {
		var src = slide.getAttribute('data-src');
		if (!src) return;
		var v = document.createElement('video');
		v.muted = true;
		v.loop = true;
		v.playsInline = true;
		v.preload = 'metadata';
		v.setAttribute('aria-hidden', 'true');
		v.src = src;
		slide.appendChild(v);
		slide.classList.add('has-video');
	});

	// Pastilles
	var dots = slides.map(function (slide, i) {
		var b = document.createElement('button');
		b.type = 'button';
		b.setAttribute('aria-label', 'Diapositive ' + (i + 1) + ' : ' + slide.getAttribute('data-label'));
		b.addEventListener('click', function () {
			show(i);
		});
		dotsEl.appendChild(b);
		return b;
	});

	function show(i) {
		current = (i + slides.length) % slides.length;
		slides.forEach(function (s, k) {
			var active = k === current;
			s.classList.toggle('is-active', active);
			var v = s.querySelector('video');
			if (v) {
				if (active) {
					v.currentTime = 0;
					v.play().catch(function () {
					});
				} else {
					v.pause();
				}
			}
		});
		dots.forEach(function (d, k) {
			d.classList.remove('is-active');
			if (k === current) {
				void d.offsetWidth;
				d.classList.add('is-active');
			} // relance l'animation
		});
		clearTimeout(timer);
		if (!reduceMotion) timer = setTimeout(function () {
			show(current + 1);
		}, SLIDE_DURATION);
	}

	show(0);

	// Pause quand l'onglet est caché
	document.addEventListener('visibilitychange', function () {
		if (document.hidden) clearTimeout(timer); else show(current);
	});

	// Header : transparent sur le hero, plein ensuite + lien actif
	var hero = document.getElementById('accueil');
	var links = Array.prototype.slice.call(document.querySelectorAll('.header__nav a'));
	var sections = links.map(function (a) {
		return document.querySelector(a.getAttribute('href'));
	});

	function onScroll() {
		header.classList.toggle('is-solid', window.scrollY > hero.offsetHeight - 120);
		var y = window.scrollY + 140, idx = -1;
		sections.forEach(function (s, i) {
			if (s && s.offsetTop <= y) idx = i;
		});
		links.forEach(function (a, i) {
			a.classList.toggle('is-current', i === idx);
		});
	}

	window.addEventListener('scroll', onScroll, {passive: true});
	onScroll();
})();
