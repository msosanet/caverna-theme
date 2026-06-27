(function () {
	'use strict';

	function bindMediaButtons() {
		document.querySelectorAll('[data-caverna-media-target]').forEach(function (button) {
			button.addEventListener('click', function () {
				var target = document.getElementById(button.dataset.cavernaMediaTarget);
				var frame;

				if (!target || !window.wp || !window.wp.media) {
					return;
				}

				frame = window.wp.media({
					title: 'Elegir imagen',
					button: { text: 'Usar imagen' },
					multiple: false,
				});

				frame.on('select', function () {
					var attachment = frame.state().get('selection').first().toJSON();
					target.value = attachment.url || '';
				});

				frame.open();
			});
		});
	}

	function wrapText(ctx, text, x, y, maxWidth, lineHeight, maxLines) {
		var words = text.split(/\s+/);
		var line = '';
		var lines = [];

		words.forEach(function (word) {
			var testLine = line ? line + ' ' + word : word;

			if (ctx.measureText(testLine).width > maxWidth && line) {
				lines.push(line);
				line = word;
				return;
			}

			line = testLine;
		});

		if (line) {
			lines.push(line);
		}

		lines.slice(0, maxLines).forEach(function (currentLine, index) {
			ctx.fillText(currentLine, x, y + (index * lineHeight));
		});
	}

	function initPlateGenerator() {
		var canvas = document.getElementById('caverna_plate_canvas');
		var title = document.getElementById('caverna_plate_title');
		var category = document.getElementById('caverna_plate_category');
		var file = document.getElementById('caverna_plate_image');
		var download = document.getElementById('caverna_plate_download');
		var ctx;
		var image = null;

		if (!canvas || !title || !category || !file || !download) {
			return;
		}

		ctx = canvas.getContext('2d');

		function draw() {
			var gradient = ctx.createLinearGradient(0, 0, 1080, 1080);

			gradient.addColorStop(0, '#050005');
			gradient.addColorStop(0.55, '#180817');
			gradient.addColorStop(1, '#3a1010');
			ctx.fillStyle = gradient;
			ctx.fillRect(0, 0, 1080, 1080);

			if (image) {
				var scale = Math.max(1080 / image.width, 1080 / image.height);
				var width = image.width * scale;
				var height = image.height * scale;
				var x = (1080 - width) / 2;
				var y = (1080 - height) / 2;

				ctx.drawImage(image, x, y, width, height);
				ctx.fillStyle = 'rgba(0, 0, 0, 0.52)';
				ctx.fillRect(0, 0, 1080, 1080);
			}

			ctx.fillStyle = '#f000b8';
			ctx.fillRect(0, 0, 1080, 22);
			ctx.fillStyle = '#ffe600';
			ctx.fillRect(0, 22, 1080, 10);

			ctx.fillStyle = '#ffe600';
			ctx.font = '900 44px Arial, sans-serif';
			ctx.fillText((category.value || 'CAVERNA RADIO').toUpperCase(), 72, 160);

			ctx.fillStyle = '#ffffff';
			ctx.font = '900 86px Arial, sans-serif';
			wrapText(ctx, title.value || 'Nueva placa de Caverna Radio', 72, 300, 900, 96, 6);

			ctx.fillStyle = '#f000b8';
			ctx.fillRect(72, 914, 180, 12);
			ctx.fillStyle = '#ffffff';
			ctx.font = '800 34px Arial, sans-serif';
			ctx.fillText('CavernaRadio.net', 72, 985);
		}

		[title, category].forEach(function (input) {
			input.addEventListener('input', draw);
		});

		file.addEventListener('change', function () {
			var selected = file.files && file.files[0];
			var reader;

			if (!selected) {
				image = null;
				draw();
				return;
			}

			reader = new FileReader();
			reader.addEventListener('load', function () {
				var nextImage = new Image();
				nextImage.addEventListener('load', function () {
					image = nextImage;
					draw();
				});
				nextImage.src = reader.result;
			});
			reader.readAsDataURL(selected);
		});

		download.addEventListener('click', function () {
			var link = document.createElement('a');
			link.download = 'caverna-placa.png';
			link.href = canvas.toDataURL('image/png');
			link.click();
		});

		draw();
	}

	document.addEventListener('DOMContentLoaded', function () {
		bindMediaButtons();
		initPlateGenerator();
	});
}());
