jQuery(document).ready(function($) {
    /**
     * ------------------------------------------------------------------
     * Contact Form 7
     * ------------------------------------------------------------------
     */
    // initialise plugin
    $(".2fa-phone").intlTelInput({
        preferredCountries: [],
        defaultCountry: "auto",
        nationalMode: true,
        separateDialCode: true,
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/9.0.9/js/utils.js",
        geoIpLookup: function(callback) {
            $.ajax({
                url: wpjs.ajax_url,
                data: {
                    action: 'get_ipinfo'
                },
                cache: false,
                success: function(data) {
                    var obj = $.parseJSON(data);
                    callback(obj.country);
                },
                error: function() {
                    var x = "IE";
                    callback(x);
                }
            });
        }
    });

    $(".wpcf7-form").submit(function(){

        //Create mobile-validation field
        if($('#mobile-number').length <= 0) {
            $(".wpcf7-form").append('<input name="mobile-number" id="mobile-number" class="wpcf7-form-control wpcf7-text" type="hidden">');
        }

        // Create Hidden code field.
        if($('#tfa-code').length <= 0) {
            $(".wpcf7-form").append('<input name="code" id="tfa-code" class="wpcf7-form-control wpcf7-text" type="hidden">');
        }

        var ts=String(new Date().getTime()), i = 0, out = '';
        for(i=0;i<ts.length;i+=2) {
           out+=Number(ts.substr(i, 2)).toString(36);
        }

        // Create Ref ID field
        if($('#ref-id').length <= 0) {
            $(".wpcf7-form").append('<input name="ref-id" id="ref-id" class="wpcf7-form-control wpcf7-text" value="wordpress_contact_form7_' + out + '" type="hidden">');
        }

        if ($(".2fa-phone").val() !== '' ){
            $("#mobile-number").val(
                $(".2fa-phone").intlTelInput("getNumber")
            );
        }

        $.ajax({
            type: "POST",
            url: '/wp-admin/admin-ajax.php',
            data: { 'mobile-number': $("#mobile-number").val(), 'action': 'send_tfa_code', 'ref-id': $("#ref-id").val()},
        });

        var code = prompt("In a few moments you will receive an SMS with a code. Please enter the code in the field below:", "");
        if (code != null) {
            $("#tfa-code").val(code);
        }
    });

});
