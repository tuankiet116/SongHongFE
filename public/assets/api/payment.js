$(document).ready(function () {
    fillUserData();
    getCart(paymentGetCart, errorPaymentGetCart, errorTokenPayment);
    provinceAPI(getProvinceSuccess, getAddressError);
    $('#state-province').on('change', function () {
        $('#ward').html("<option>-- Chọn phường/xã --</option>").ready(function () {
            $('#ward').niceSelect('update');
        });
        var id_province = $(this).val();
        districtAPI(id_province, getDistrictSuccess, getAddressError);
    });

    $('#district').on('change', function () {
        var id_district = $(this).val();
        wardAPI(id_district, getWardSuccess, getAddressError);
    });

    $('.button-payment').on('click', function () {

        var token = localStorage.getItem("userToken");

        if (validateData() == 1) {
            $('.loading').css('display', 'block');
            $('.checkout').css('opacity', '0.5');
            var type = 'COD';
            if(parseFloat(totalCart) < 0){
                sweetAlert('Lỗi', 'Không có đơn hàng khả dụng.', 'error', 'OK');
                return;
            }
            if($('#cod').prop('checked') == true){
                type = 'COD';
            }
            if($('#vnpay').prop('checked') == true){
                if(parseFloat(totalCart) > 20000000){
                    sweetAlert('Lỗi', 'Đơn hàng vượt quá mức thanh toán 20.000.000 vnd cho VNPay.', 'error', 'OK');
                    return;
                }
                type = 'VNPAY';
            }
            if($('#momo').prop('checked') == true){
                if(parseFloat(totalCart) > 20000000){
                    sweetAlert('Lỗi', 'Đơn hàng vượt quá mức thanh toán 20.000.000 vnd cho Momo.', 'error', 'OK');
                    return;
                }
                type = 'MOMO';
            }
            var data = progressDataPayment(type);
            console.log(data)
            if(token !== null && token != ""){
                createPayment(paymentSuccess, paymentError, JSON.stringify(data), token);
                return;
            }
            createPaymentPublic(paymentSuccess, paymentError,JSON.stringify(data));
        }
        return false;
    })
});
let dataProducts = [];
var totalCart = 0;
function paymentGetCart(data) {
    dataProducts = data;
    let html = '';
    if (data.success) {
        html = data.data.map(function (item) {
            var str = "";
            let price = item.discountMoney;
            let totalPrice = item.discountMoney * item.quantity;
            totalCart += totalPrice
            str += `<li>
                        <div class="row">
                            <div class="order-item-left col-lg-3 col-md-3 col-sm-3 col-3" >
                                <div class="order-item-image">
                                    <a href = "../chi-tiet-san-pham/${item.productId}">
                                        <img src="${base_url + item.variationImage}" alt="IMG_PRODUCT">
                                    </a>
                                </div>
                                <div class="order-item-count"> ${item.quantity} </div>
                            </div>
                            <div class="order-item-middle col-lg-6 col-md-6 col-sm-6 col-6">
                                <a href = "../chi-tiet-san-pham/${item.productId}">
                                    <p>${item.productName}</p>
                                </a>`;
            if (item.properties.length > 0) {
                str += item.properties.map(function (property) {
                    var propertystr = `<div class="order-item-properties">
                                    <p> ${property.keyname} /</p>
                                    <p> ${property.value} </p>
                                </div>`;
                    return propertystr;
                }).join('');
            }

            str += `</div>
                        <div class="order-item-right col-lg-3 col-md-3 col-sm-3 col-3">
                            <p>${new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(price)}</p>
                        </div>
                    </div>
                </li>`;
            return str;
        });
    }
    else {
        sweetAlert('Lỗi', 'Hiện hệ thống không thể thanh toán.', 'warning', "Ok");
    }

    if (data.total == 0) {
        html = `<li><p style="text-align: center">Chưa có sản phẩm nào</p></li>`
    }
    $('.order-item-content>ul').html(html);
    $('.total-price').text(new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(totalCart))
}

function errorPaymentGetCart(data) {
    console.log(data);
}

function errorTokenPayment() {
    $('.bg0>.container').html('<h3>Bạn cần đăng nhập!</h3>');
}

function getProvinceSuccess(data) {
    if (data.data != null && data.data.length > 0) {
        html = '<option value = "#">-- Chọn tỉnh thành phố --</option>'
        html += data.data.map(function (item) {
            return `<option value='${item.id}'>${item.name}</option>`;
        });
        $('#state-province').html(html).ready(function () {
            $('#state-province').niceSelect('update');
        });
    }
}

function getDistrictSuccess(data) {
    if (data.data != null && data.data.length > 0) {
        html = data.data.map(function (item) {
            return `<option value='${item.id}'>${item.name}</option>`;
        });
        $('#district').html(html).ready(function () {
            $('#district').niceSelect('update');
        });
    }
}

function getWardSuccess(data) {
    if (data.data != null && data.data.length > 0) {
        html = data.data.map(function (item) {
            return `<option value='${item.id}'>${item.name}</option>`;
        });
        $('#ward').html(html).ready(function () {
            $('#ward').niceSelect('update');
        });
    }
}

function getAddressError(data) {
    console.log(data);
}

function validateData() {
    var validated = 1;
    $('small').css('display', 'none');
    if ($('#name').val() == "" || $('#name').val() == null) {
        validated = 0;
        $('#small-name').css('display', 'block');
    }

    if ($('#phone').val() == "" || $('#phone').val() == null || !isVietnamesePhoneNumber($('#phone').val())) {
        validated = 0;
        $('#small-phone').css('display', 'block');
    }

    if($('#email').val() == "" || $('#email').val() == null || !validateEmail($('#email').val())){
        validated = 0;
        $('#small-email').css('display', 'block');
    }

    if ($('#state-province').val() == "#" || $('#state-province').val() == null) {
        validated = 0;
        $('#small-state-province').css('display', 'block');
    }

    if ($('#district').val() == "-- Chọn quận/huyện --" || $('#district').val() == null) {
        validated = 0;
        $('#small-district').css('display', 'block');
    }

    if ($('#ward').val() == "-- Chọn phường/xã --" || $('#ward').val() == null) {
        validated = 0;
        $('#small-ward').css('display', 'block');
    }

    if ($('#address').val() == "" || $('#address').val() == null) {
        validated = 0;
        $('#small-address').css('display', 'block');
    }
    return validated;
}

function progressDataPayment(type = "COD"){
    var data = dataProducts.data.map(function(item){
        return {
            productId: item.productId,
            variantId: item.variantId,
            quantity: item.quantity
        };
    });
    return {
        shopId: shopID,
        innerNote: '',
        printNote: '',
        payment: type,
        customerName: $('#name').val(),
        customerPhone: $('#phone').val(),
        customerWard: $('#ward').siblings('.nice-select').find('.current').text(),
        customerDistrict: $('#district').siblings('.nice-select').find('.current').text(),
        customerProvince: $('#state-province').siblings('.nice-select').find('.current').text(),
        customerFulladdress: $('#address').val(),
        email: $('#email').val(),
        dtoBillDetails: data
    }
}

function paymentSuccess(data){
    $('.loading').css('display', 'none');
    $('.checkout').css('opacity', '1');
    if(data.payment == 'VNPAY' || data.payment == 'MOMO'){
        location.href = data.url;
        return;
    }

    if(data.success == true){
        sweetAlert('Thành Công', 'Đặt hàng thành công.', 'success', 'OK');
        totalCart = 0;
        getCart(paymentGetCart, errorPaymentGetCart, errorTokenPayment);
        return;
    }
    sweetAlert('Lỗi', 'Hệ thống bận, không thể đặt hàng lúc này.', 'error', 'OK');
}

function paymentError(data){
    $('.loading').css('display', 'none');
    $('.checkout').css('opacity', '1');
    if(data.responseJSON.success == false){
        sweetAlert('Lỗi', 'Không có đơn hàng khả dụng.', 'error', 'OK');
    }
}

function fillUserData(){
    var userName = localStorage.getItem('userName');
    var userPhone = localStorage.getItem('_phone');
    var userAddress = localStorage.getItem('_address');

    $('#name').val(userName);
    $('#phone').val(userPhone);
    $('#address').val(userAddress);
}
