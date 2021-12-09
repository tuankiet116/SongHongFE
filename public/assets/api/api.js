function getCart(success, error) {
    let token = localStorage.getItem("userToken")
    let url = !token ? `bill/get/money`: `cart/get`
    let data = !token ? localStorage.getItem('cart') || [] : null
    if(typeof(data) ==='object') data = JSON.stringify(data)
    let header = !token ? {} : { Authorization: `Bearer ${token}` }
    let method = !token ? "POST": "GET"

    $.ajax({
        method: method,
        url: `${base_url}/api/${url}`,
        contentType: 'application/json',
        async: false,
        headers: header,
        data: data,
        dataType: "JSON",
        success: success,
        error: error
    });

}

function provinceAPI(success, error) {
    $.ajax({
        url: `${base_url}/api/address/province`,
        method: "GET",
        contentType: 'application/json',
        async: false,
        dataType: "JSON",
        success: success,
        error: error
    });
}

function districtAPI(id, success, error) {
    $.ajax({
        url: `${base_url}/api/address/district/` + parseInt(id),
        method: "GET",
        contentType: 'application/json',
        async: false,
        dataType: "JSON",
        success: success,
        error: error
    });
}

function wardAPI(id, success, error) {
    $.ajax({
        url: `${base_url}/api/address/ward/` + parseInt(id),
        method: "GET",
        contentType: 'application/json',
        async: false,
        dataType: "JSON",
        success: success,
        error: error
    });
}

function createPaymentPublic(success, error, data) {
    $.ajax({
        method: "POST",
        url: `${base_url}/api/pub/insertbill`,
        contentType: 'application/json',
        data: data,
        dataType: "JSON",
        success: success,
        error: error
    });
}

function createPayment(success, error, data, token) {
    $.ajax({
        method: "POST",
        url: `${base_url}/api/bill/insert`,
        contentType: 'application/json',
        headers: { Authorization: `Bearer ${token}` },
        data: data,
        dataType: "JSON",
        success: success,
        error: error
    });
}

function sweetAlert(title = "",
    text = "",
    icon = "warning",
    confirmButtonText = "OK",
    cancelButtonText = "Cancel",
    confirmButtonColor = "#3085d6",
    cancelButtonColor = "#d33",
    confirmed, notConfirmed) {
    Swal.fire({
        title: title,
        text: text,
        icon: icon,
        showCancelButton: true,
        confirmButtonColor: confirmButtonColor,
        cancelButtonColor: cancelButtonColor,
        confirmButtonText: confirmButtonText,
        cancelButtonText: cancelButtonText
    }).then((result) => {
        if (result.isConfirmed) {
            confirmed
        }
        else {
            notConfirmed
        }
    })
}

function sweetAlert(title = "",
    text = "",
    icon = "warning",
    confirmButtonText = "OK",
    cancelButtonText = "Cancel",
    confirmButtonColor = "#3085d6",
    cancelButtonColor = "#d33",
    confirmed, notConfirmed) {
    Swal.fire({
        title: title,
        text: text,
        icon: icon,
        showCancelButton: true,
        confirmButtonColor: confirmButtonColor,
        cancelButtonColor: cancelButtonColor,
        confirmButtonText: confirmButtonText,
        cancelButtonText: cancelButtonText
    }).then((result) => {
        if (result.isConfirmed) {
            confirmed
        }
        else {
            notConfirmed
        }
    })
}

function sweetAlertNoti(title, text, icon) {
    Swal.fire(
        title,
        text,
        icon
    )
}

function orderSearchAPI(data, success, error) {
    $.ajax({
        url: `${base_url}/api/bill/get/bill/on`,
        method: "GET",
        contentType: 'application/json',
        async: false,
        dataType: "JSON",
        data: JSON.stringify(data),
        success: success,
        error: error
    });
}

function getOrderByUser(token, status, success, error, whereRender){
    $.ajax({
        method: "GET",
        url: `${base_url}/api/bill/get/bill/user?status=${status}`,
        headers: { Authorization: `Bearer ${token}` },
        contentType: 'application/json',
        dataType: "JSON",
        success: function(res){
            success(res, whereRender)
        },
        error: error
    });
}


function userInfoAPI(success, error) {
    var token = localStorage.getItem('userToken');
    $.ajax({
        url: `${base_url}/api/user/getbyusername`,
        method: "GET",
        headers: { Authorization: `Bearer ${token}` },
        contentType: 'application/json',
        async: false,
        dataType: "JSON",
        success: success,
        error: error
    });
}

function updateUserProfileAPI(success, error, data) {
    var token = localStorage.getItem('userToken');
    $.ajax({
        url: `${base_url}/api/user/update`,
        method: "POST",
        headers: { Authorization: `Bearer ${token}` },
        contentType: 'application/json',
        async: false,
        data: JSON.stringify(data),
        dataType: "JSON",
        success: success,
        error: error
    });
}

function updatePasswordAPI(success, error, data){
    var token = localStorage.getItem('userToken');
    $.ajax({
        url: `${base_url}/api/user/changepassword`,
        method: "POST",
        headers: { Authorization: `Bearer ${token}` },
        contentType: 'application/json',
        async: false,
        data: JSON.stringify(data),
        dataType: "JSON",
        success: success,
        error: error
    });
}

function getOrderInformationAPI(success, error, data){
    console.log(`${base_url}/api/bill/get/bill/on?${data.trim()}`);
    $.ajax({
        url: `${base_url}/api/bill/get/bill/on?${data.trim()}`,
        method: "GET",
        contentType: 'application/json',
        async: false,
        dataType: "JSON",
        contentType: 'application/json',
        success: success,
        error: error
    })
}
function insertEmail(success, error, data){
    $.ajax({
        method: "POST",
        url: `${base_url}/api/pub/insert/email`,
        data: data,
        dataType: "JSON",
        contentType: 'application/json',
        success: success,
        error: error
    });
}

function isVietnamesePhoneNumber(number) {
    return /(03|05|07|08|09|01[2|6|8|9])+([0-9]{8})\b/.test(number);
}

function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function validatePassword(old, password){
    $('small').css('display', 'none');
    if(String(old) !== String(password)){
        $('#small-password').css('display', 'block');
        return false;
    }

    if(parseInt(password.length)<8){
        $('#small-new-password').css('display', 'block');
        return false;
    }
    return true;
}
