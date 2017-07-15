$(document).ready(function() {

	/* Search button handler */
	$('#nav-search').on('click', '.nav-search-submit', function(e) {
		let searchBar = $('#nav-search');
        let searchOpenedClass = 'nav-search-opened';

		if(!searchBar.hasClass(searchOpenedClass)) {
			e.preventDefault();
			searchBar.addClass(searchOpenedClass);
		}
	});
});