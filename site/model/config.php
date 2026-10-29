<?php

/**
 * Configuration du site Orée
 */

define('ASSET_TOKEN', strtotime('2026-10-19 12:45:00'));

// Informations du site
define('SITE_NAME', 'Orée');
define('SITE_URL', 'https://oree-restaurant.com');

// Contact
define('EMAIL', 'contact@oree-restaurant.com');
define('PHONE', '+33450525563');
define('ADDRESS_LINE_1', '15 chemin de l’Abbaye');
define('ADDRESS_LINE_2', '74940 Annecy');

// Réseaux sociaux
define('INSTAGRAM_URL', 'https://www.instagram.com/oree_restaurant/');
define('FACEBOOK_URL', 'https://www.facebook.com/profile.php?id=61595701282972');

// Réservation en ligne
define('BOOKING_URL', 'https://bookings.zenchef.com/results?rid=388055&pid=1001');

// Carte (PDF)
define('MENU_PDF', 'assets/carte/menu_oree.pdf');

// Autres paramètres
define('TIMEZONE', 'Europe/Paris');
date_default_timezone_set(TIMEZONE);
