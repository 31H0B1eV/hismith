require('./bootstrap.js');

/**
 * Handle click on likes icon
 */
$('.like').on('click', function() {
  $(this).toggleClass('fa-thumbs-o-up fa-thumbs-up')
});


/**
 * Handle button 'New Comment'
 */
$('#newComment').on('click', function (event) {
  event.preventDefault();
  window.location.href = '/comments/new'
});

/**
 * Accident sorting of comments
 */
$('#sortASC').on('click', function (event) {
  event.preventDefault();
  window.location.href = '/?sort=ASC'
});


/**
 * Descending sorting of comments (default)
 */
$('#sortDESC').on('click', function (event) {
  event.preventDefault();
  window.location.href = '/'
});