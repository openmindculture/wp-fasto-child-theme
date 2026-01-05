jQuery(".search-trigger").on( "click", function() {
    /* focus on the search input form field */
    document.getElementById('s').focus();
});

window.addEventListener('DOMContentLoaded', () => {
	let classNameReaderMode = 'fasto-reader-mode';
	let activatedReaderMode = false;
	if (localStorage) {
		activatedReaderMode = localStorage.getItem('readerMode');
	}
	if (!prefersMoreContrast && !activatedReaderMode) {
		document.body.classList.remove(classNameReaderMode);
	} else {
		document.body.classList.add(classNameReaderMode);
	}
	let readerModeToggle = document.getElementById('fasto-reader-mode-trigger');
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
