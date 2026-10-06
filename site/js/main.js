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
