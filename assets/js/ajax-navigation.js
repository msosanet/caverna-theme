(function () {
	'use strict';

	var parser = new DOMParser();
	var activeController = null;
	var viewSelector = '#caverna-view';
	var loadingClass = 'is-ajax-loading';

	function isPlainLeftClick(event) {
		return 0 === event.button && !event.metaKey && !event.ctrlKey && !event.shiftKey && !event.altKey;
	}

	function isNavigableLink(link) {
		var url;

		if (!link || !link.href || link.target || link.hasAttribute('download')) {
			return false;
		}

		if (link.closest('[data-no-ajax], .no-ajax, #wpadminbar')) {
			return false;
		}

		url = new URL(link.href, window.location.href);

		if (url.origin !== window.location.origin) {
			return false;
		}

		if (url.pathname.indexOf('/wp-admin/') !== -1 || url.pathname.indexOf('/wp-login.php') !== -1) {
			return false;
		}

		if (url.pathname === window.location.pathname && url.search === window.location.search && url.hash) {
			return false;
		}

		return true;
	}

	function isNavigableForm(form) {
		var method = (form.getAttribute('method') || 'get').toLowerCase();
		var action = new URL(form.getAttribute('action') || window.location.href, window.location.href);

		if ('get' !== method || form.target || form.closest('[data-no-ajax], .no-ajax, #wpadminbar')) {
			return false;
		}

		if (action.origin !== window.location.origin) {
			return false;
		}

		return action.pathname.indexOf('/wp-admin/') === -1 && action.pathname.indexOf('/wp-login.php') === -1;
	}

	function setLoading(isLoading) {
		document.documentElement.classList.toggle(loadingClass, isLoading);
	}

	function updateBodyClass(nextDocument) {
		if (nextDocument.body && nextDocument.body.className) {
			document.body.className = nextDocument.body.className;
		}
	}

	function updateDocumentMeta(nextDocument) {
		var canonical = document.querySelector('link[rel="canonical"]');
		var nextCanonical = nextDocument.querySelector('link[rel="canonical"]');

		document.title = nextDocument.title || document.title;
		updateBodyClass(nextDocument);

		if (canonical && nextCanonical) {
			canonical.setAttribute('href', nextCanonical.getAttribute('href'));
		}
	}

	function runPageScripts() {
		if (window.cavernaRadioPlayerInit) {
			window.cavernaRadioPlayerInit();
		}

		document.dispatchEvent(new CustomEvent('caverna:page-load'));
	}

	function scrollToHash(hash) {
		var target;

		if (!hash) {
			window.scrollTo({ top: 0, behavior: 'instant' in window ? 'instant' : 'auto' });
			return;
		}

		target = document.getElementById(decodeURIComponent(hash.substring(1)));

		if (target) {
			target.scrollIntoView();
		}
	}

	function replaceView(html, url) {
		var nextDocument = parser.parseFromString(html, 'text/html');
		var currentView = document.querySelector(viewSelector);
		var nextView = nextDocument.querySelector(viewSelector);

		if (!currentView || !nextView) {
			throw new Error('Missing AJAX view container.');
		}

		currentView.replaceWith(nextView);
		updateDocumentMeta(nextDocument);
		runPageScripts();
		scrollToHash(url.hash);
	}

	function navigateTo(url, options) {
		var targetUrl = 'string' === typeof url ? new URL(url, window.location.href) : url;
		var shouldPush = !options || false !== options.push;

		if (activeController) {
			activeController.abort();
		}

		activeController = new AbortController();
		setLoading(true);

		return fetch(targetUrl.href, {
			credentials: 'same-origin',
			headers: {
				'X-Requested-With': 'fetch',
			},
			signal: activeController.signal,
		}).then(function (response) {
			if (!response.ok) {
				throw new Error('HTTP ' + response.status);
			}

			return response.text();
		}).then(function (html) {
			replaceView(html, targetUrl);

			if (shouldPush) {
				window.history.pushState({ cavernaAjax: true }, '', targetUrl.href);
			}
		}).catch(function (error) {
			if ('AbortError' === error.name) {
				return;
			}

			window.location.href = targetUrl.href;
		}).finally(function () {
			setLoading(false);
			activeController = null;
		});
	}

	document.addEventListener('click', function (event) {
		var link = event.target.closest('a');

		if (!isPlainLeftClick(event) || !isNavigableLink(link)) {
			return;
		}

		event.preventDefault();
		navigateTo(new URL(link.href));
	});

	document.addEventListener('submit', function (event) {
		var form = event.target;
		var action;
		var params;

		if (!isNavigableForm(form)) {
			return;
		}

		event.preventDefault();
		action = new URL(form.getAttribute('action') || window.location.href, window.location.href);
		params = new URLSearchParams(new FormData(form));
		action.search = params.toString();
		navigateTo(action);
	});

	window.addEventListener('popstate', function () {
		navigateTo(window.location.href, { push: false });
	});
}());
