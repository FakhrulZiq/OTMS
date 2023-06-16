
(function ($) {
    "use strict";

    // Toggle password visibility for password field
$("#togglePassword").click(function() {
    var passwordField = $("#password");
    var fieldType = passwordField.attr('type');
    if (fieldType === 'password') {
      passwordField.attr('type', 'text');
    } else {
      passwordField.attr('type', 'password');
    }
  });
  
  // Toggle password visibility for password confirmation field
  $("#togglePasswordConfirmation").click(function() {
    var passwordConfirmationField = $("#password_confirmation");
    var fieldType = passwordConfirmationField.attr('type');
    if (fieldType === 'password') {
      passwordConfirmationField.attr('type', 'text');
    } else {
      passwordConfirmationField.attr('type', 'password');
    }
  });
  
    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    $('.validate-form').on('submit',function(){
        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }

        return check;
    });


    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else if ($(input).attr('type') == 'password_confirmation' || $(input).attr('name') == 'password_confirmation'){
            var password = $('input[name="password"]').val().trim(); // Get value of password field
            var passwordConfirmation = $(input).val().trim(); // Get value of password_confirmation field
            
            if (passwordConfirmation !== password) { // Compare values
                return false; // Return false if values are not the same
            }
        }        
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }
    
    

})(jQuery);