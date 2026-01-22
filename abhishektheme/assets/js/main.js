document.addEventListener('DOMContentLoaded', function () {
	const stickyBar = document.querySelector('.sticky-bar');
	const phoneButton = document.querySelector('[data-phone-copy]');

	if (stickyBar) {
		const toggleSticky = () => {
			if (window.scrollY > 40) {
				stickyBar.classList.add('scrolled');
			} else {
				stickyBar.classList.remove('scrolled');
			}
		};

		window.addEventListener('scroll', toggleSticky, { passive: true });
		toggleSticky();
	}

	if (phoneButton) {
		phoneButton.addEventListener('click', () => {
			const phone = phoneButton.getAttribute('data-phone-copy');
			const tel = phoneButton.getAttribute('data-phone-tel');
			if (phone && navigator.clipboard && navigator.clipboard.writeText) {
				navigator.clipboard.writeText(phone).catch(() => {});
			}

			if (window.matchMedia('(max-width: 768px)').matches && tel) {
				window.location.href = tel;
			}

			phoneButton.classList.add('copied');
			setTimeout(() => phoneButton.classList.remove('copied'), 1500);
		});
	}
});
