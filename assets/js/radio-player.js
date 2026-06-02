(function () {
	'use strict';

	document.addEventListener('DOMContentLoaded', function () {
		var players = document.querySelectorAll('.caverna-radio-player');

		if (!players.length) {
			return;
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

			if (!audio || !button) {
				return;
			}

			button.setAttribute('aria-pressed', 'false');

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
