$(document).ready(function(){
    getUserInformation();
    $('#tab_profile').on('click', getUserInformation);
    $('#tab_edit').on('click', getUserEditInformation);
    $('#edit-profile-btn').on('click', function(){
        updateUserProfile();
        return false;
    });
    $('#btn-change-password').on('click', function(){
        var newPass = $('#profile_new_pass').val();
        var oldPass = $('#profile_repeat_pass').val();
        if(validatePassword(oldPass, newPass)){
            var data = {
                oldpassword:$('#profile_old_pass').val(),
                password   :newPass
            }
            updatePasswordAPI(updatePasswordSuccess, updateProfileError, data);
        }
        return false;
    });
    $('#tab_logout').on('click', function(){
        $(".logout_btn").click();
    });
});

function getUserInformation(){
    userInfoAPI(userInforSuccess, userInforError);
}

function getUserEditInformation(){
    userInfoAPI(userGetInforEditSuccess, userInforError);
}

function updateUserProfile(){
    var data = {
        email: $('#profile_email').val(),
        address: $('#profile_address').val(),
        phone: $('#profile_phone').val()
    }
    if(validateUpdatedata()){
        updateUserProfileAPI(updateProfileSuccess, updateProfileError, data);
    }
}

function userInforSuccess(data){
    var userData = data.data;
    $('#username').text(userData.username);
    $('#useremail').text(userData.email);
    $('#userphone').text(userData.phone);
    $('#useraddress').text(userData.address);
}

function userInforError(data){
    if(data.responseJSON.status == 401){
        sweetAlertNoti('Cần đăng nhập', 'Bạn cần đăng nhập.', 'error');
    }
}

function userGetInforEditSuccess(data){
    var userData = data.data;
    $('#profile_email').val(userData.email);
    $('#profile_phone').val(userData.phone);
    $('#profile_address').val(userData.address);
}

function updateProfileSuccess(data){
    if(data.success == true){
        sweetAlertNoti('Thành Công', 'Cập nhật thông tin thành công.', 'success');
        getUserEditInformation();
        return;
    }
    sweetAlertNoti('Lỗi', 'Hệ thống bận.', 'error');
}

function updateProfileError(data){
    if(data.responseJSON.status == 401){
        sweetAlertNoti('Cần đăng nhập', 'Bạn cần đăng nhập.', 'error');
        return;
    }
    sweetAlertNoti('Lỗi', 'Hệ thống bận.', 'error');
}

function validateUpdatedata(){
    var validated = 1;
    $('small').css('display', 'none');
    if ($('#profile_phone').val() == "" || $('#profile_phone').val() == null || !isVietnamesePhoneNumber($('#profile_phone').val())) {
        validated = 0;
        $('#small-phone').css('display', 'block');
    }

    if ($('#profile_address').val() == "" || $('#profile_address').val() == null) {
        validated = 0;
        $('#small-address').css('display', 'block');
    }

    if ($('#profile_email').val() == "" || $('#profile_email').val() == null || !validateEmail($('#profile_email').val())) {
        validated = 0;
        $('#small-email').css('display', 'block');
    }
    return validated;
}

function updatePasswordSuccess(data){
    if(data.success == true){
        sweetAlertNoti('Thành công', data.message, 'success');
        return;
    }
    sweetAlertNoti('Lỗi', data.message, 'error');
}