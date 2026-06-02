(function () {
	'use strict';

	document.addEventListener('DOMContentLoaded', function () {
		var players = document.querySelectorAll('.caverna-radio-player');
		var volumeStorageKey = 'cavernaRadioVolume';

		if (!players.length) {
			return;
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

		function setState(player, state, text, label) {
			var button = player.querySelector('.caverna-radio-player__button');
			var status = player.querySelector('.caverna-radio-player__status');

			player.classList.toggle('is-playing', 'playing' === state);
			player.classList.toggle('is-loading', 'loading' === state);
			player.classList.toggle('has-error', 'error' === state);

			if (status) {
				status.textContent = text;
			}

			if (button) {
				button.setAttribute('aria-label', label);
				button.setAttribute('aria-pressed', 'playing' === state ? 'true' : 'false');
			}
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
			players.forEach(function (player) {
				applyVolume(player, volume);
			});
		}

		function pauseOtherPlayers(currentPlayer) {
			players.forEach(function (player) {
				var audio = player.querySelector('.caverna-radio-player__audio');

				if (player === currentPlayer || !audio || audio.paused) {
					return;
				}

				audio.pause();
				setState(player, 'paused', 'Pausado', 'Reproducir Caverna Radio');
			});
		}

		players.forEach(function (player) {
			var audio = player.querySelector('.caverna-radio-player__audio');
			var button = player.querySelector('.caverna-radio-player__button');
			var volumeRange = player.querySelector('.caverna-radio-player__volume-range');

			if (!audio || !button) {
				return;
			}

			button.setAttribute('aria-pressed', 'false');
			applyVolume(player, getStoredVolume());

			if (volumeRange) {
				volumeRange.addEventListener('input', function () {
					var volume = Number(volumeRange.value);

					storeVolume(volume);
					syncVolume(volume);
				});
			}

			button.addEventListener('click', function () {
				if (audio.paused) {
					pauseOtherPlayers(player);
					setState(player, 'loading', 'Cargando...', 'Cargando Caverna Radio');

					audio.play().then(function () {
						setState(player, 'playing', 'Reproduciendo', 'Pausar Caverna Radio');
					}).catch(function (error) {
						setState(player, 'error', 'No se pudo reproducir', 'Reproducir Caverna Radio');

						if (window.console && window.console.error) {
							window.console.error('Error al reproducir Caverna Radio:', error);
						}
					});

					return;
				}

				audio.pause();
				setState(player, 'paused', 'Pausado', 'Reproducir Caverna Radio');
			});

			audio.addEventListener('playing', function () {
				setState(player, 'playing', 'Reproduciendo', 'Pausar Caverna Radio');
			});

			audio.addEventListener('pause', function () {
				setState(player, 'paused', 'Pausado', 'Reproducir Caverna Radio');
			});

			audio.addEventListener('waiting', function () {
				setState(player, 'loading', 'Cargando...', 'Cargando Caverna Radio');
			});

			audio.addEventListener('error', function () {
				setState(player, 'error', 'No se pudo reproducir', 'Reproducir Caverna Radio');
			});
		});
	});
}());
