window.addEventListener('DOMContentLoaded', () => {
	var searchTriggers = document.getElementsByClassName('search-trigger');
	for (var i=0; i<searchTriggers.length; i++) {
		searchTriggers[i].addEventListener('click', function () {
			console.log('search trigger clicked');
			document.getElementById('s').focus();
		});
	}

	var classNameReaderMode = 'fasto-reader-mode';
	var activatedReaderMode = false;
	if (localStorage) {
		activatedReaderMode = localStorage.getItem('readerMode');
	}
	if (activatedReaderMode) {
		document.body.classList.add(classNameReaderMode);
	}
	var readerModeToggles = document.getElementsByClassName('fasto-reader-mode-trigger');
	for (var i = 0; i < readerModeToggles.length; i++) {
		var readerModeToggle = readerModeToggles[i];
		readerModeToggle.addEventListener('click', function (event) {
			event.preventDefault();
			if (document.body.className.indexOf(classNameReaderMode) > -1) {
				console.log('toggle must remove');
				document.body.classList.remove(classNameReaderMode);
				if (localStorage) {
					localStorage.removeItem('readerMode');
				}
			} else {
				console.log('toggle must add');
				document.body.classList.add(classNameReaderMode);
				if (localStorage) {
					localStorage.setItem('readerMode', 'true');
				}
			}
		});
	}
});
