require('./bootstrap.js');

$(function() {
  let total = parseInt($('#pagination').attr('total'));
  let current = parseInt($('#pagination').attr('current'));

  if(current === 1) {
    $('#previousComment').closest('li').addClass('disabled');
  }

  if (current === total) {
    $('#nextComment').closest('li').addClass('disabled');
  }

  $('#previousComment').on('click', function (event) {
    event.preventDefault();

    window.location.href = `/comment/${current - 1}`
  });

  $('#nextComment').on('click', function (event) {
    event.preventDefault();

    window.location.href = `/comment/${current + 1}`
  });
});

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