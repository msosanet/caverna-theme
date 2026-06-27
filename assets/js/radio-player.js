(function () {
	'use strict';

	var nowPlayingTimer = null;
	var masterAudio = null;
	var masterReady = false;
	var playerState = 'paused';
	var volumeStorageKey = 'cavernaRadioVolume';
	var visibilityReady = false;

	function updateNowPlaying(data) {
		var players = document.querySelectorAll('.caverna-radio-player');

		if (!data || !players.length) {
			return;
		}

		players.forEach(function (player) {
			var title = player.querySelector('[data-radio-title]');
			var program = player.querySelector('[data-radio-program]');
			var category = player.querySelector('[data-radio-category]');
			var artwork = player.querySelector('[data-radio-artwork]');

			if (title && data.title) {
				title.textContent = data.title;
			}

			if (program && data.program) {
				program.textContent = data.program;
			}

			if (category && data.category) {
				category.textContent = data.category;
			}

			if (artwork) {
				if (data.artwork) {
					artwork.innerHTML = '<img src="' + data.artwork + '" alt="" loading="lazy">';
					artwork.hidden = false;
				} else {
					artwork.innerHTML = '';
					artwork.hidden = true;
				}
			}
		});
	}

	function refreshNowPlaying() {
		if (!window.cavernaRadio || !window.cavernaRadio.ajaxUrl) {
			return;
		}

		fetch(window.cavernaRadio.ajaxUrl + '?action=caverna_now_playing', {
			credentials: 'same-origin',
		}).then(function (response) {
			return response.json();
		}).then(function (payload) {
			if (payload && payload.success) {
				updateNowPlaying(payload.data);
			}
		}).catch(function () {
			return;
		});
	}

	function initRadioPlayers() {
		var players = document.querySelectorAll('.caverna-radio-player');

		if (!players.length) {
			return;
		}

		function getPlayers() {
			return Array.prototype.slice.call(document.querySelectorAll('.caverna-radio-player'));
		}

		function getStoredVolume() {
			var storedVolume;

			try {
				storedVolume = window.localStorage.getItem(volumeStorageKey);
			} catch (error) {
				storedVolume = null;
			}

			storedVolume = Number(storedVolume);

			if (Number.isNaN(storedVolume)) {
				return 80;
			}

			return Math.max(0, Math.min(100, storedVolume));
		}

		function storeVolume(volume) {
			try {
				window.localStorage.setItem(volumeStorageKey, String(volume));
			} catch (error) {
				return;
			}
		}

		function stateText(state) {
			if ('playing' === state) {
				return 'Reproduciendo';
			}

			if ('loading' === state) {
				return 'Cargando...';
			}

			if ('error' === state) {
				return 'No se pudo reproducir';
			}

			return 'Pausado';
		}

		function stateLabel(state) {
			if ('playing' === state) {
				return 'Pausar Caverna Radio';
			}

			if ('loading' === state) {
				return 'Cargando Caverna Radio';
			}

			return 'Reproducir Caverna Radio';
		}

		function setState(player, state) {
			var button = player.querySelector('.caverna-radio-player__button');
			var status = player.querySelector('.caverna-radio-player__status');

			player.classList.toggle('is-playing', 'playing' === state);
			player.classList.toggle('is-loading', 'loading' === state);
			player.classList.toggle('has-error', 'error' === state);

			if (status) {
				status.textContent = stateText(state);
			}

			if (button) {
				button.setAttribute('aria-label', stateLabel(state));
				button.setAttribute('aria-pressed', 'playing' === state ? 'true' : 'false');
			}
		}

		function syncState(state) {
			playerState = state;
			getPlayers().forEach(function (player) {
				setState(player, state);
			});
			updateFixedVisibility();
		}

		function applyVolume(player, volume) {
			var audio = player.querySelector('.caverna-radio-player__audio');
			var volumeRange = player.querySelector('.caverna-radio-player__volume-range');
			var volumeValue = player.querySelector('.caverna-radio-player__volume-value');

			if (audio) {
				audio.volume = volume / 100;
			}

			if (volumeRange) {
				volumeRange.value = String(volume);
			}

			if (volumeValue) {
				volumeValue.textContent = volume + '%';
			}
		}

		function syncVolume(volume) {
			getPlayers().forEach(function (player) {
				applyVolume(player, volume);
			});
		}

		function getMasterAudio() {
			var fixedAudio = document.querySelector('.caverna-radio-player--fixed .caverna-radio-player__audio');
			var firstAudio = document.querySelector('.caverna-radio-player__audio');

			return fixedAudio || firstAudio;
		}

		function updateFixedVisibility() {
			var fixedPlayer = document.querySelector('.caverna-radio-player--fixed');
			var mainPlayers = getPlayers().filter(function (player) {
				return !player.classList.contains('caverna-radio-player--fixed');
			});
			var hasVisibleMain = mainPlayers.some(function (player) {
				var rect = player.getBoundingClientRect();

				return rect.bottom > 80 && rect.top < window.innerHeight - 80;
			});
			var shouldShow = fixedPlayer && (mainPlayers.length ? !hasVisibleMain : 'playing' === playerState || 'loading' === playerState);

			if (!fixedPlayer) {
				return;
			}

			fixedPlayer.classList.toggle('is-visible', shouldShow);
			document.body.classList.toggle('caverna-fixed-player-visible', shouldShow);
		}

		function bindMasterAudio() {
			if (masterReady) {
				return;
			}

			masterAudio = getMasterAudio();

			if (!masterAudio) {
				return;
			}

			masterReady = true;
			masterAudio.addEventListener('playing', function () {
				syncState('playing');
			});

			masterAudio.addEventListener('pause', function () {
				syncState('paused');
			});

			masterAudio.addEventListener('waiting', function () {
				syncState('loading');
			});

			masterAudio.addEventListener('error', function () {
				syncState('error');
			});
		}

		function togglePlayback() {
			masterAudio = masterAudio || getMasterAudio();

			if (!masterAudio) {
				return;
			}

			if (masterAudio.paused) {
				syncState('loading');
				masterAudio.play().then(function () {
					syncState('playing');
				}).catch(function (error) {
					syncState('error');

					if (window.console && window.console.error) {
						window.console.error('Error al reproducir Caverna Radio:', error);
					}
				});

				return;
			}

			masterAudio.pause();
			syncState('paused');
		}

		bindMasterAudio();

		getPlayers().forEach(function (player) {
			var button = player.querySelector('.caverna-radio-player__button');
			var volumeRange = player.querySelector('.caverna-radio-player__volume-range');

			if (player.dataset.cavernaRadioReady) {
				return;
			}

			if (!audio || !button) {
				return;
			}

			player.dataset.cavernaRadioReady = 'true';
			button.setAttribute('aria-pressed', 'false');
			applyVolume(player, getStoredVolume());

			if (volumeRange) {
				volumeRange.addEventListener('input', function () {
					var volume = Number(volumeRange.value);

					storeVolume(volume);
					syncVolume(volume);
				});
			}

			button.addEventListener('click', togglePlayback);
		});

		syncVolume(getStoredVolume());
		syncState(playerState);

		if (!visibilityReady) {
			visibilityReady = true;
			window.addEventListener('scroll', updateFixedVisibility, { passive: true });
			window.addEventListener('resize', updateFixedVisibility);
			document.addEventListener('caverna:page-load', updateFixedVisibility);
		}

		if (window.cavernaRadio && window.cavernaRadio.nowPlaying) {
			updateNowPlaying(window.cavernaRadio.nowPlaying);
		}

		if (!nowPlayingTimer) {
			refreshNowPlaying();
			nowPlayingTimer = window.setInterval(refreshNowPlaying, 30000);
		}
	}

	window.cavernaRadioPlayerInit = initRadioPlayers;
	document.addEventListener('DOMContentLoaded', initRadioPlayers);
}());
