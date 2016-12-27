$(document).ready(function() {

  $('#btn_send').prop('disabled', false);

  $('#btn_send').on('click', function() {

    resetInput();
    if(checkInput()) {
      return;
    }

    var email = $('#email').val();
    var name = $('#name').val();
    var msg = $('#message').val();

    $('.loader').removeClass('hidden');
    $('#btn_send').prop('disabled', true);

    $.post(mail_url,
    {
      email: email,
      name: name,
      msg: msg
    },
    function(data, status) {

      $('.loader').addClass('hidden');

      if(data == 'ok') {

        $('.alert-success').removeClass('hidden');
        $('.alert-success').hide();
        $('.alert-success').slideDown();

        $('#btn_new').removeClass('hidden');
        $('#btn_new').hide();
        $('#btn_new').fadeIn();

      } else {

        $('#error_alert').removeClass('hidden');
        $('#error_alert').hide();
        $('#error_alert').slideDown();
      }
    }).fail(function(data) {

      $('.loader').addClass('hidden');

      $('#error_alert').removeClass('hidden');
      $('#error_alert').hide();
      $('#error_alert').slideDown();
    });
  });

  $('#btn_new').on('click', function() {

    $('.loader').addClass('hidden');
    $(this).addClass('hidden');
    $('.alert-success').slideUp(function() {
      $('.alert-success').addClass('hidden');
    });
    $('.alert-danger').addClass('hidden');

    $('#btn_send').prop('disabled', false);

    $('#email').val('');
    $('#name').val('');
    $('#message').val('');
  });
});

function checkInput() {

  var email = $('#email').val();
  var name = $('#name').val();
  var msg = $('#message').val();

  var error = false;

  if(email === '') {
    $('#email').addClass('form-error');
    error = true;
  }

  if(name === '') {
    $('#name').addClass('form-error');
    error = true;
  }

  if(msg === '') {
    $('#message').addClass('form-error');
    error = true;
  }

  if(error) {
    $('#wrong_input').removeClass('hidden');
  }

  return error;
}

function resetInput() {

  $('.alert-danger').addClass('hidden');

  $('#email').removeClass('form-error');
  $('#name').removeClass('form-error');
  $('#message').removeClass('form-error');
}
