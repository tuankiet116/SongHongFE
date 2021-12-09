$(document).ready(function() {
    $("#signup_btn").click(function(e) {
        e.preventDefault();
        var data = {
            'username'             : $("#name_input").val() == null ? "" : $("#name_input").val(),
            'password'             : $("#pass_input").val() == null ? "" : $("#pass_input").val(),
            'password_verify'      : $("#pass_verify_input").val() == null ? "" : $("#pass_verify_input").val(),
            'phone'                : $("#phone_input").val() == null ? "" : $("#phone_input").val(),
            'email'                : $("#mail_input").val() == null ? "" : $("#mail_input").val(),
            'address'              : $("#address_input").val() == null ? "" : $("#address_input").val(),
        };

        var url = base_url+"/auth/adduser";

        var account_name = $("#name_input").val();
        var password_first = $("#pass_input").val();
        var password_main = $("#pass_verify_input").val();
        var phone_check = $("#phone_input").val();
        var email_check = $("#mail_input").val();
        var address_check = $("#address_input").val();

        if (isValid(account_name)) {
            $("#modal-account-name .modal-alert-position").css("display", "block");
            $("#modal-account-name .modal-alert-position").html(`Tài khoản không chứa ký tự đặc biệt`);
            $("#modal-account-password .modal-alert-position").css("display", "none");
            $("#modal-account-password-main .modal-alert-position").css("display", "none");
            $("#modal-account-email .modal-alert-position").css("display", "none");
            $("#modal-account-tele .modal-alert-position").css("display", "none");
            $("#modal-account-address .modal-alert-position").css("display", "none");
            return false;
        }

        if (account_name == "" || account_name == null) {
            $("#modal-account-name .modal-alert-position").css("display", "block");
            $("#modal-account-password .modal-alert-position").css("display", "none");
            $("#modal-account-password-main .modal-alert-position").css("display", "none");
            $("#modal-account-email .modal-alert-position").css("display", "none");
            $("#modal-account-tele .modal-alert-position").css("display", "none");
            $("#modal-account-address .modal-alert-position").css("display", "none");
            return false;
        }

        if (password_first == "" || password_first == null) {
            $("#modal-account-name .modal-alert-position").css("display", "none");
            $("#modal-account-password .modal-alert-position").css("display", "block");
            $("#modal-account-password-main .modal-alert-position").css("display", "none");
            $("#modal-account-email .modal-alert-position").css("display", "none");
            $("#modal-account-tele .modal-alert-position").css("display", "none");
            $("#modal-account-address .modal-alert-position").css("display", "none");
        }

        if (password_main == "" || password_main == null) {
            $("#modal-account-name .modal-alert-position").css("display", "none");
            $("#modal-account-password .modal-alert-position").css("display", "none");
            $("#modal-account-password-main .modal-alert-position").css("display", "block");
            $("#modal-account-email .modal-alert-position").css("display", "none");
            $("#modal-account-tele .modal-alert-position").css("display", "none");
            $("#modal-account-address .modal-alert-position").css("display", "none");
        }

        if (phone_check == "" || phone_check == null) {
            $("#modal-account-name .modal-alert-position").css("display", "none");
            $("#modal-account-password .modal-alert-position").css("display", "none");
            $("#modal-account-password-main .modal-alert-position").css("display", "none");
            $("#modal-account-email .modal-alert-position").css("display", "none");
            $("#modal-account-tele .modal-alert-position").css("display", "block");
            $("#modal-account-address .modal-alert-position").css("display", "none");
            return false;
        }

        if (email_check == "" || email_check == null) {
            $("#modal-account-name .modal-alert-position").css("display", "none");
            $("#modal-account-password .modal-alert-position").css("display", "none");
            $("#modal-account-password-main .modal-alert-position").css("display", "none");
            $("#modal-account-email .modal-alert-position").css("display", "block");
            $("#modal-account-tele .modal-alert-position").css("display", "none");
            $("#modal-account-address .modal-alert-position").css("display", "none");
            return false;
        }

        if (address_check == "" || address_check == null) {
            $("#modal-account-name .modal-alert-position").css("display", "none");
            $("#modal-account-password .modal-alert-position").css("display", "none");
            $("#modal-account-password-main .modal-alert-position").css("display", "none");
            $("#modal-account-email .modal-alert-position").css("display", "none");
            $("#modal-account-tele .modal-alert-position").css("display", "none");
            $("#modal-account-address .modal-alert-position").css("display", "block");
            return false;
        }

        if (isValid(password_first)) {
            $("#modal-account-password .modal-alert-position").css("display", "block");
            $("#modal-account-password .modal-alert-position").html(`Mật khẩu không chứa ký tự đặc biệt`);
            $("#modal-account-name .modal-alert-position").css("display", "none");
            $("#modal-account-password-main .modal-alert-position").css("display", "none");
            $("#modal-account-email .modal-alert-position").css("display", "none");
            $("#modal-account-tele .modal-alert-position").css("display", "none");
            $("#modal-account-address .modal-alert-position").css("display", "none");
            return false;
        }

        if (isValid(password_main)) {
            $("#modal-account-password-main .modal-alert-position").css("display", "block");
            $("#modal-account-password-main .modal-alert-position").html(`Mật khẩu không chứa ký tự đặc biệt`);
            $("#modal-account-name .modal-alert-position").css("display", "none");
            $("#modal-account-password .modal-alert-position").css("display", "none");
            $("#modal-account-email .modal-alert-position").css("display", "none");
            $("#modal-account-tele .modal-alert-position").css("display", "none");
            $("#modal-account-address .modal-alert-position").css("display", "none");
            return false;
        }

        if (validPhone(phone_check)) {
            $("#modal-account-tele .modal-alert-position").css("display", "block");
            $("#modal-account-tele .modal-alert-position").html(`Số điện thoại không hợp lệ`);
            $("#modal-account-name .modal-alert-position").css("display", "none");
            $("#modal-account-password .modal-alert-position").css("display", "none");
            $("#modal-account-password-main .modal-alert-position").css("display", "none");
            $("#modal-account-email .modal-alert-position").css("display", "none");
            $("#modal-account-address .modal-alert-position").css("display", "none");
            return false;
        }

        if (password_first.length < 6) {
            $("#modal-account-password .modal-alert-position").css("display", "block");
            $("#modal-account-password .modal-alert-position").html(`Mật khẩu không nhỏ hơn 6 ký tự`);
            $("#modal-account-name .modal-alert-position").css("display", "none");
            $("#modal-account-password-main .modal-alert-position").css("display", "none");
            $("#modal-account-email .modal-alert-position").css("display", "none");
            $("#modal-account-tele .modal-alert-position").css("display", "none");
            $("#modal-account-address .modal-alert-position").css("display", "none");
            return false;
        }

        if (password_first != password_main) {
            $("#modal-account-password-main .modal-alert-position").css("display", "block");
            $("#modal-account-password-main .modal-alert-position").html(`Mật khẩu không trùng khớp`);
            $("#modal-account-password .modal-alert-position").css("display", "none");
            $("#modal-account-name .modal-alert-position").css("display", "none");
            $("#modal-account-email .modal-alert-position").css("display", "none");
            $("#modal-account-tele .modal-alert-position").css("display", "none");
            $("#modal-account-address .modal-alert-position").css("display", "none");
            return false;
        }

        $.ajax({
            method: "POST",
            contentType: 'application/json',
            data: JSON.stringify(data),
            async: true,
            dataType: "JSON",
            url: url,
            success: function (data) {
                if (data.success == true) {
                    signupSuccess(data);
                    $("#tab_login").click();
                }
                else if (data.success == false) {
                    // showAlert("warning", data.msg);
                    showAlert("error", "Đăng ký không thành công!");
                }
            },
            error: function (data) {
                signupError(data);
            },
        });
        // return false;
    });

    function ajax(data,  url, success, error, type = 'POST', dataType = 'JSON', async = true){
        $.ajax({
            type: type,
            data: data,
            async: async,
            dataType: dataType,
            url: url,
            success: success,
            error: error
        });
    }

    function signupSuccess(data) {
        showAlert("success", "Đăng ký tài khoản thành công!");
        $(".modal-account-content input").val("");
        $("#modal-account-tele small").remove();
        $("#modal-account-name small").remove();
        $("#modal-account-password small").remove();
        $("#modal-account-password-main small").remove();
        $("#modal-account-email small").remove();
        $("#modal-account-address small").remove();
    }

    function signupError(data) {
        showAlert("error","Đăng ký không thành công!");
    }

    function showAlert(type, message) {
        switch (String(type)) {
            case "success":
                Swal.fire("Thành Công", message, "success");
                break;
            case "error":
                Swal.fire("Thất Bại", message, "error");
                break;
            case "warning":
                Swal.fire("Cảnh Báo", message, "warning");
                $("#modal-account-tele small").remove();
                $("#modal-account-name small").remove();
                $("#modal-account-password small").remove();
                $("#modal-account-password-main small").remove();
                $("#modal-account-email small").remove();
                $("#modal-account-address small").remove();
                break;
        }
    }

    function isValid(str) {
        return /[^\w]|_/g.test(str);
    }

    function validPhone(str) {
        return /[A-Za-z -]|[^\w]/g.test(str);
    }

});
