$(document).ready(function () {

    /********** Checking user if has loged in or not **********/

    var userToken = localStorage.getItem("userToken");
    if (userToken == "" || userToken == null) {
        removeToken();
    }
    else if (userToken != "" || userToken != null) {
        validateSuccess();
    }

    /********** Tabs **********/

    $("#tabs li a:not(:first)").addClass("inactive");
    $("#tabs li a:first").addClass("tabs-active");
    $(".login-container").hide();
    $(".login-container:first").show();

    $("#tabs li a").click(function () {
        var t = $(this).attr("id");
        if ($(this).hasClass("inactive")) {
            //this is the start of our condition
            $("#tabs li a").addClass("inactive");
            $(this).removeClass("inactive");

            $(".login-container").hide();
            $("#" + t + "_hide").fadeIn("slow");

            $("#tabs li a").removeClass("tabs-active");
            $("#" + t).addClass("tabs-active");
            $("#" + t + " i").addClass("tabs-active");
        }
    });

    $("#tab_login").click(function () {
        $(".left-signin").addClass("left-active");
        $(".left-signup").removeClass("left-active");
    });

    $("#tab_signup").click(function () {
        $(".left-signup").addClass("left-active");
        $(".left-signin").removeClass("left-active");
    });


    $("#modal_close").click(function() {
        $(".modal-account-content input").val("");
        $("#modal-account-name .modal-alert-position").css("display", "none");
        $("#modal-account-password .modal-alert-position").css("display", "none");
        $("#modal-account-password-main .modal-alert-position").css("display", "none");
        $("#modal-account-email .modal-alert-position").css("display", "none");
        $("#modal-account-tele .modal-alert-position").css("display", "none");
        $("#modal-account-address .modal-alert-position").css("display", "none");
        $("#close_login").click();
    });

    $("#close_login").click(function() {
        $(".modal-account-content input").val("");
        $("#modal-account-name .modal-alert-position").css("display", "none");
        $("#modal-account-password .modal-alert-position").css("display", "none");
        $("#modal-account-password-main .modal-alert-position").css("display", "none");
        $("#modal-account-email .modal-alert-position").css("display", "none");
        $("#modal-account-tele .modal-alert-position").css("display", "none");
        $("#modal-account-address .modal-alert-position").css("display", "none");
    });

    $('.product-categories-link').click(function(){
        $(this).siblings('input').click();
        return false;
    });

    $('.image_post_redirect').click(function(){
        localtion.redirect = "";
    });

    /********** TABS PROFILE **********/

    $("#tabs li p:not(:first)").addClass("inactive");
    $("#tabs li p:first").addClass("list-profile-active");
    $(".profile-container").hide();
    $(".profile-container:first").show();

    $("#tabs li p").click(function () {
        var t = $(this).attr("id");
        if ($(this).hasClass("inactive")) {
        //this is the start of our condition
        $("#tabs li p").addClass("inactive");
        $(this).removeClass("inactive");

        $(".profile-container").hide();
        $("#" + t + "_hide").fadeIn("slow");

        $("#tabs li p").removeClass("list-profile-active");
        $("#" + t).addClass("list-profile-active");
        $("#" + t + " i").addClass("list-profile-active");
        }
    });

    /********** TABS STATUS **********/

    $("#tabs_status div:not(:first)").addClass("inactive");
    $("#tabs_status div:first").addClass("profile-list-div-active");
    $("#tabs_status div p:first").addClass("profile-list-p-active");
    $(".profile-status-tab-content").hide();
    $(".profile-status-tab-content:first").show();

    $("#tabs_status div").click(function () {
        var t = $(this).attr("id");
        if ($(this).hasClass("inactive")) {
            //this is the start of our condition
            $("#tabs_status div").addClass("inactive");
            $(this).removeClass("inactive");

            $(".profile-status-tab-content").hide();
            $("#" + t + "_hide").fadeIn("slow");

            $("#tabs_status div").removeClass("profile-list-div-active");
            $("#tabs_status div p").removeClass("profile-list-p-active");
            $("#" + t).addClass("profile-list-div-active");
            $("#" + t + " p").addClass("profile-list-p-active");
        }
    });

    $('#submit-email-footer').on('click', function(){
        let data = $('#email-footer').val()
        if(data == '' || data == null){
            let text = 'Email đang bị để trống!'
            $('#small-email-footer')
             .css('display', 'block')
             .text(text)
            return
        }

        if(!validateEmail(data)){
            let text = 'Vui lòng nhập đúng Email của bạn!'
            $('#small-email-footer')
             .css('display', 'block')
             .text(text)
            return
        }

        dataAjax = {
            email:data,
            content:null
        }

        insertEmail(insertEmailSuccess, insertEmailError, JSON.stringify(dataAjax))
    })
});

function insertEmailSuccess(res){
    if(res.success){
        Swal.fire("Nhớ kiểm tra Email để không bỏ lỡ các chương trình sale của Sông Hồng nhé", "", "success")
        $('#email-footer').val('')
    }
    else{
        Swal.fire("oops! có lỗi xảy ra", "", "error")
    }
}

function insertEmailError(res){
    Swal.fire("oops! có lỗi xảy ra", "", "error")
}

function validateSuccess(){
    $(".welcome-user").html(
        `<p>` +
            `<i class="ti-user"></i>` +
            localStorage.getItem("userName") +
            `</p>` +
            `<div class="user-container">
            <div class="user-hover"></div>
            <div class="user-dropdown">
                <ul>
                    <li>
                        <a href="/thong-tin-ca-nhan">
                            <i class="ti-pencil-alt"></i>
                            Thông tin cá nhân
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="logout_btn">
                            <i class="ti-back-right"></i>
                            Đăng xuất
                        </a>
                    </li>
                </ul>
            </div>
        </div>`
    );

    /********** Logout **********/

    $(".logout_btn").ready(function () {
        $(".logout_btn").click(function () {
            Swal.fire({
                icon: "question",
                title: "Đăng xuất",
                text: "Bạn có muốn đăng xuất?",
                showCancelButton: true,
                confirmButtonText: "Đăng xuất",
                cancelButtonText: "Hủy",
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire("Đăng xuất thành công", "", "success");
                    removeToken();
                    getCart(getCartSuccess, errorGetCart)
                }
            });
        });
    });

}

function removeToken() {
    localStorage.removeItem("userToken");
    localStorage.removeItem("userName");
    $(".welcome-user").html(`
        <a href="#" class="flex-c-m trans-04 p-lr-25" data-toggle="modal" data-target="#loginModal">
            Đăng ký / Đăng nhập
        </a>
    `);
}



