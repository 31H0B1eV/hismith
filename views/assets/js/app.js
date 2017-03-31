require('./bootstrap.js');

$('.like').on('click', function() {
  $(this).toggleClass('fa-thumbs-o-up fa-thumbs-up')
});

$('#newComment').on('click', function (event) {
  event.preventDefault();
  window.location.href = '/comments/new'
});