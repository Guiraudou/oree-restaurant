// Administration page: redirects visitors who are not logged in, publishes a new menu PDF, changes the password, logs out.
// The login itself is done on the public site (modal), this page only uses the session cookie.

import { HTTPClient } from '@osimatic/core-js/network/HTTPClient.js';
import { FormHelper } from '@osimatic/core-js/form/FormHelper.js';
import { FlashMessage } from '@osimatic/core-js/widgets/FlashMessage.js';
import { Modal } from 'bootstrap';

const errorMessage = 'Une erreur s\'est produite.';

const api = document.body.dataset.api;
const home = document.body.dataset.home;

const content = document.getElementById('adminContent');
const menuForm = document.getElementById('menuForm');
const logoutButton = document.getElementById('logoutButton');
const userName = document.getElementById('userName');
const passwordForm = document.getElementById('passwordForm');

// Messages shown for the error codes returned by the API
const ERROR_MESSAGES = {
	missing_file: 'Aucun fichier sélectionné.',
	invalid_file: 'Ce fichier n\'est pas valide.',
	invalid_current_password: 'Le mot de passe actuel est incorrect.',
	password_too_short: 'Le nouveau mot de passe doit contenir au moins 6 caractères.',
};

/**
 * Calls the API through HTTPClient. The session cookie is sent, the Bearer token of JwtSession is not.
 * Never rejects: the result always tells whether the call succeeded, its HTTP status (0 on network error) and its JSON body.
 *
 * @param {string} method HTTP method (GET, POST, ...)
 * @param {string} path Path relative to the API base URL (e.g. "/auth/session")
 * @param {Object|FormData|string} data Body of the request (FormData for file uploads, JSON string otherwise)
 * @param {Object} headers Additional request headers
 * @returns {Promise<{ok: boolean, status: number, data: Object}>} The result of the call
 * @see https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API Fetch API
 */
async function apiCall(method, path, data = {}, headers = {}) {
	try {
		const { response, jsonData } = await HTTPClient.requestAsPromise(method, api + path, data, headers, false);
		return { ok: true, status: response.status, data: jsonData ?? {} };
	} catch (error) {
		return { ok: false, status: error?.response?.status ?? 0, data: error?.jsonData ?? {} };
	}
}

function redirectToHome() {
	window.location.replace(home);
}

/**
 * Shows the administration content if the caller is logged in, otherwise redirects to the public site.
 * A network error is shown as a message, without redirecting.
 */
async function checkSession() {
	const { status, data } = await apiCall('GET', '/auth/session');
	if (0 === status) {
		FlashMessage.displayError(errorMessage);
		return;
	}
	if (!data.authenticated) {
		redirectToHome();
		return;
	}
	userName.textContent = data.user.firstName;
	content.hidden = false;
}

menuForm.addEventListener('submit', async (event) => {
	event.preventDefault();
	const submitButton = menuForm.querySelector('button[type="submit"]');
	FormHelper.buttonLoader(submitButton, 'start');

	const { ok, status, data } = await apiCall('POST', '/menu', new FormData(menuForm));
	FormHelper.buttonLoader(submitButton, 'reset');
	if (401 === status) {
		redirectToHome();
		return;
	}
	if (ok) {
		menuForm.reset();
		Modal.getOrCreateInstance(document.getElementById('menuModal')).hide();
		FlashMessage.displaySuccess('La nouvelle carte est publiée.');
		// Reload the preview with a new query string, so that the browser does not show the previous PDF from its cache
		document.getElementById('menuPreview').src = `../assets/carte/menu_oree.pdf?${Date.now()}`;
		return;
	}
	FormHelper.hideFormErrors(menuForm.closest('.modal'));
	FormHelper.displayFormErrorsFromText(menuForm, 0 === status ? errorMessage : (ERROR_MESSAGES[data.error] ?? errorMessage));
});

passwordForm.addEventListener('submit', async (event) => {
	event.preventDefault();
	const submitButton = passwordForm.querySelector('button[type="submit"]');
	FormHelper.buttonLoader(submitButton, 'start');

	// The body must be sent as JSON: the API reads it with toArray()
	const { ok, status, data } = await apiCall('POST', '/auth/password', JSON.stringify({
		currentPassword: passwordForm.currentPassword.value,
		newPassword: passwordForm.newPassword.value,
	}), {'Content-Type': 'application/json'});
	FormHelper.buttonLoader(submitButton, 'reset');
	if (401 === status) {
		redirectToHome();
		return;
	}
	if (ok) {
		passwordForm.reset();
		Modal.getOrCreateInstance(document.getElementById('passwordModal')).hide();
		FlashMessage.displaySuccess('Mot de passe modifié.');
		return;
	}
	FormHelper.hideFormErrors(passwordForm.closest('.modal'));
	FormHelper.displayFormErrorsFromText(passwordForm, 0 === status ? errorMessage : (ERROR_MESSAGES[data.error] ?? errorMessage));
});

logoutButton.addEventListener('click', async () => {
	await apiCall('POST', '/auth/logout');
	redirectToHome();
});

checkSession();
