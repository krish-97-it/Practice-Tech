var customValidation = {
    nameValidation: function (ele, error_msg_key, errorMessage) {
        var sel = jQuery(ele);
        var sel_value = sel.val().trim();
        var keyName = error_msg_key ? error_msg_key : 'Name';
        var msg = '';
        var reg_exp = /^[a-zA-Z][a-zA-Z\-\ \.]{2,}$/i;
        sel.siblings('.input-error-msg').remove();
        if (!sel_value || sel_value === null) {
            msg = '*'+keyName + ' is required.';
        } else if (sel_value.length <= 2) {
            msg = '*Name should be minimum 3 characters.';
        } else if (!sel_value.match(reg_exp)) {
            msg = errorMessage ? errorMessage : '*Accepts alphabets only.';
        } else {
            msg = '';
        }
        jQuery('.invalid_name').addClass("hidden");
        if (msg) {
            jQuery('.invalid_name').removeClass("hidden");
            sel.addClass('input-error').removeClass('input-valid');
            let name_error = '<div class="input-error-msg">' + msg + '</div>';
            invalid_name.innerHTML = name_error;
            return false;
        } else {
            sel.removeClass('input-error');
            sel.addClass('input-valid');
            return true;
        }
    },
    phoneValidation: function (ele,errorMessage) {
        var sel = jQuery(ele);
        var sel_value = sel.val();
        var msg = '';
        var reg_exp = /^\d{10}$/;
        sel.siblings('.input-error-msg').remove();
        if (!sel_value || sel_value === null) {
            msg = '*Mobile no. is required.';
        } else if (!sel_value.match(reg_exp)) {
            msg = errorMessage ? errorMessage : 'Mobile No. should be 10 digits.';
        }
        jQuery('.invalid_mobile').addClass("hidden");
        if (msg) {
            jQuery('.invalid_mobile').removeClass("hidden");
            sel.addClass('input-error').removeClass('input-valid');
            let mobile_error = '<div class="input-error-msg">' + msg + '</div>';
            invalid_mobile.innerHTML = mobile_error;
            return false;
        } else {
            sel.removeClass('input-error');
            sel.addClass('input-valid');
            return true;
        }
    },
    cityValidation: function (ele) {
        var sel = jQuery(ele);
        var sel_value = sel.val();
        var msg = '';
        sel.siblings('.input-error-msg').remove();
        if (!sel_value || sel_value === null) {
            msg = '*Please select a city';
        } 
        jQuery('.invalid_city').addClass("hidden");
        if (msg) {
            jQuery('.invalid_city').removeClass("hidden");
            sel.addClass('input-error').removeClass('input-valid');
            let cityname_error = '<div class="input-error-msg">' + msg + '</div>';
            invalid_city.innerHTML = cityname_error;
            return false;
        } else {
            sel.removeClass('input-error');
            sel.addClass('input-valid');
            return true;
        }
    },
    centerValidation: function (ele) {
        var sel = jQuery(ele);
        var sel_value = sel.val();
        var msg = '';
        sel.siblings('.input-error-msg').remove();
        if (!sel_value || sel_value === null) {
            msg = '*Please select a center';
        } 
        jQuery('.invalid_center').addClass("hidden");
        if (msg) {
            jQuery('.invalid_center').removeClass("hidden");
            sel.addClass('input-error').removeClass('input-valid');
            let centername_error = '<div class="input-error-msg">' + msg + '</div>';
            invalid_center.innerHTML = centername_error;
            return false;
        } else {
            sel.removeClass('input-error');
            sel.addClass('input-valid');
            return true;
        }
    }
}

function validatorInputFields() {
    var valiatorInput = false;
    valiatorInput     = 
                        customValidation.nameValidation(jQuery('[name="name"]')) &&
                        customValidation.phoneValidation(jQuery('[name="mobile"]')) &&
                        customValidation.cityValidation(jQuery('[name="cityname"]'), '', 'Select City') &&
                        customValidation.centerValidation(jQuery('[name="centername"]'),  '', 'Select Center');  
                        
    if(!valiatorInput) {
        customValidation.nameValidation(jQuery('[name="name"]'));
        customValidation.phoneValidation(jQuery('[name="mobile"]'));
        customValidation.cityValidation(jQuery('[name="cityname"]'), '', 'Select City');
        customValidation.centerValidation(jQuery('[name="centername"]'), '', 'Select Center'); 
    } 
    return valiatorInput;
}