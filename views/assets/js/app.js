require('./bootstrap.js');

$('.like').on('click', function() {
  $(this).toggleClass('fa-thumbs-o-up fa-thumbs-up')
});