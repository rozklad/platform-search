(function($) {

  'use strict';

  $(document).ready(function() {
    // Initializes search overlay plugin.
    // Replace onSearchSubmit() and onKeyEnter() with
    // your logic to perform a search and display results
    $(".list-view-wrapper").scrollbar();

    $('[data-pages="search"]').search({
      // Bind elements that are included inside search overlay
      searchField: '#overlay-search',
      closeButton: '.overlay-close',
      suggestions: '#overlay-suggestions',
      brand: '.brand',
      // Callback that will be run when you hit ENTER button on search box
      onSearchSubmit: function(searchString) {
        console.log("Search for: " + searchString);

        showSearchResults(searchString);
      },
      // Callback that will be run whenever you enter a key into search box.
      // Perform any live search here.
      onKeyEnter: function(searchString) {
        console.log("Live search for: " + searchString);
        var searchField = $('#overlay-search');

        showSearchResults(searchString);

      }
    })

  });


  $('.panel-collapse label').on('click', function(e){
    e.stopPropagation();
  })

})(window.jQuery);

function showSearchResults(searchString) {
  var searchResults = $('.search-results');
  searchResults.fadeOut("fast");

  $.ajax({
    type: 'GET',
    url: window.configuration.api.search,
    data: {
      search: searchString
    }
  }).success(function(data){
    console.log(data);
    var compiled = _.template( $('#search-results').html() );
    searchResults.html( compiled({results: data}) );

    searchResults.fadeIn("fast");
  });
}
