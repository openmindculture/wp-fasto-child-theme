window.addEventListener('DOMContentLoaded', () => {
	var searchTrigger = document.getElementById('search-trigger');
	if (searchTrigger) {
		searchTrigger.addEventListener('click', function () {
			document.getElementById('s').focus();
		});
	}

	var classNameReaderMode = 'fasto-reader-mode';
	var activatedReaderMode = false;
	if (localStorage) {
		activatedReaderMode = localStorage.getItem('readerMode');
	}
	if (!prefersMoreContrast && !activatedReaderMode) {
		document.body.classList.remove(classNameReaderMode);
	} else {
		document.body.classList.add(classNameReaderMode);
	}
	var readerModeToggle = document.getElementById('fasto-reader-mode-trigger');
	if (readerModeToggle) {
		readerModeToggle.addEventListener('click', function () {
			if (document.body.className.indexOf(classNameReaderMode) > -1) {
				document.body.classList.remove(classNameReaderMode);
				if (localStorage) {
					localStorage.removeItem('readerMode');
				}
			} else {
				document.body.classList.add(classNameReaderMode);
				if (localStorage) {
					localStorage.setItem('readerMode', 'true');
				}
			}
		});
	}
});
