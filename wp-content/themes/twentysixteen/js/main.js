function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

jQuery(document).ready(function ($) {
    
    function signModalSlide(slideNumber = 1) {
        $(`#sign-step-nav :nth-child(${slideNumber}) a`).tab('show');
    }

    signModalSlide();

    $('#form-step-1').submit((e) => {
      var formElement = "#form-step-1";
      var formStep = 1;
      var name = e.currentTarget.name.value;
      var email = e.currentTarget.email.value;
      var phone_num = e.currentTarget.pnumber.value;

      if (email && name && phone_num) {
        $(formElement).find('button[type="submit"]').attr('disabled', 'disabled');
        $.ajax({
          type: 'POST',
          dataType: 'JSON',
          url: cpm_object.ajax_url,
          data: {
            action:'set_form',
            name:name,
            email:email,
            phone_num:phone_num,
            req_type:'get_details'
          },
          success: function(data) {

            if (data.STATUS == 'success') {
              $(formElement).find('button[type="submit"]').removeAttr('disabled');
              $('#verify_user').val(data.user); 
              signModalSlide(2);
              toastr.success(data.message,"User Information Acquisition Step!");
            } else {
                $(formElement).find('button[type="submit"]').removeAttr('disabled');
                toastr.error(data.message,"User Information Acquisition Step!");
            }

          },
          error: function(res) {
            
          }
        });
      }
      return false;
    });

    $('#form-step-2').submit((e) => {
        var formElement = "#form-step-2";
        var formStep = 2;
        var entered_otp = e.currentTarget.otp.value;
        var user2verify = e.currentTarget.user_verify.value;
  
        if (entered_otp&&user2verify) {
          $(formElement).find('button[type="submit"]').attr('disabled', 'disabled');
          $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: cpm_object.ajax_url,
            data: {
              action:'set_form',
              otp:entered_otp,
              associated_user:user2verify,
              req_type:'verify_otp'
            },
            success: function(data) {
  
              if (data.STATUS == 'success') {
                $(formElement).find('button[type="submit"]').removeAttr('disabled');
                toastr.success(data.message,"OTP Verification Step!");
                window.location = "http://localhost/wordpress/custom-form-redirect/";
              } else {
                $(formElement).find('button[type="submit"]').removeAttr('disabled');
                toastr.error(data.message,"OTP Verification Step!");
              }
  
            },
            error: function(res) {
              
            }
          });
        }
        return false;
      });

});