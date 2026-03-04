/* Netvio Calculators – Admin JS */
(function () {
	'use strict';

	// ── Copy shortcode to clipboard ──────────────────────────────────────────
	document.addEventListener('click', function (e) {
		const btn = e.target.closest('.netvio-copy-btn');
		if (!btn) return;

		const shortcode = btn.dataset.shortcode;
		if (!shortcode) return;

		navigator.clipboard.writeText(shortcode).then(function () {
			btn.textContent = 'Copied!';
			btn.classList.add('copied');

			showToast();

			setTimeout(function () {
				btn.textContent = 'Copy';
				btn.classList.remove('copied');
			}, 2000);
		}).catch(function () {
			// Fallback for older browsers
			const el = document.createElement('textarea');
			el.value = shortcode;
			el.style.position = 'fixed';
			el.style.opacity = '0';
			document.body.appendChild(el);
			el.select();
			document.execCommand('copy');
			document.body.removeChild(el);

			btn.textContent = 'Copied!';
			btn.classList.add('copied');
			showToast();

			setTimeout(function () {
				btn.textContent = 'Copy';
				btn.classList.remove('copied');
			}, 2000);
		});
	});

	function showToast() {
		const toast = document.getElementById('netvio-toast');
		if (!toast) return;
		toast.classList.add('show');
		setTimeout(function () {
			toast.classList.remove('show');
		}, 2500);
	}

	// ── Live search for calculators table ───────────────────────────────────
	const searchInput = document.getElementById('netvio-calc-search');
	if (searchInput) {
		searchInput.addEventListener('input', function () {
			const query = this.value.toLowerCase().trim();
			const rows  = document.querySelectorAll('.netvio-calc-row');

			rows.forEach(function (row) {
				const name = row.dataset.name || '';
				row.style.display = name.includes(query) ? '' : 'none';
			});

			// Hide category sections if all rows are hidden
			document.querySelectorAll('.netvio-calc-category').forEach(function (section) {
				const visible = section.querySelectorAll('.netvio-calc-row[style=""],.netvio-calc-row:not([style])');
				const allHidden = Array.from(section.querySelectorAll('.netvio-calc-row')).every(function (r) {
					return r.style.display === 'none';
				});
				section.style.display = allHidden ? 'none' : '';
			});
		});
	}
})();
