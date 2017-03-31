require('./bootstrap.js');

$(function() {
  /**
   *  Handle pagination logic
   */
  let total = parseInt($('#pagination').attr('total'));
  let current = parseInt($('#pagination').attr('current'));

  if(current === 1) { // disable click on previous if first
    $('#previousComment').closest('li').addClass('disabled');
  }

  if (current === total) { // disable click on previous if last
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
  /** == end of pagination logic == */
});


/**
 * Handle click on likes icon
 */
$('.like').on('click', function() {
  $(this).toggleClass('fa-thumbs-o-up fa-thumbs-up');

  if($(this).hasClass('fa-thumbs-up')) {

    $.ajax({
      type: "POST",
      url: `/likes/${$(this).closest('footer').attr('current') || $('#pagination').attr('current')}/add`,

      success: function(res) {
        if(res !== 'exists') {
          $(this).attr('likes', res);
          location.reload();
        }
      },

      error: function(jqXHR, textStatus, errorThrown) {
        console.error(textStatus, errorThrown);
      }
    });

  } else {
    $(this).attr('likes', likes - 1);
  }
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