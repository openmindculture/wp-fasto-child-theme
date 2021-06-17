jQuery(".search-trigger").on( "click", function() {
    console.log('child theme search trigger (outside IIFE');
    /* focus on the search input form field */
    document.getElementById('s').focus();
});