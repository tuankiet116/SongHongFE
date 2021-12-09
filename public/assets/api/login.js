$(document).ready(function () {
  $("#login_btn").on("click", function (e) {
    e.preventDefault();
    var data = {
      username         : $("#username_input").val(),
      password         : $("#password_input").val(),
    };

    var url = base_url+"/auth/login";

    var account_name = $("#username_input").val();
    var password = $("#password_input").val();

    if (account_name == "" || account_name == null) {
      $("#modal-account-login .modal-alert-position").css("display", "block");
      $("#modal-account-login-password .modal-alert-position").css("display", "none");
      return false;
    }

    if (password == "" || password == null) {
      $("#modal-account-login-password .modal-alert-position").css("display", "block");
      $("#modal-account-login .modal-alert-position").css("display", "none");
      return false;
    }

    $.ajax({
      method: "POST",
      contentType: 'application/json',
      data: JSON.stringify(data),
      async: false,
      dataType: "JSON",
      url: url,
      success: function (data) {
        loginSuccess(data);
        getToken(data);
        validateSuccess();
        insertCart();
      },
      error: function (data) {
        loginError(data);
      },
    });
    return false;
  });
});

function insertCart(){
  let token =  localStorage.getItem('userToken')
  let cart = localStorage.getItem('cart') || []
  if(typeof(cart) === 'string') cart = JSON.parse(cart)
  
  $.ajax({
    type: "POST",
    url: base_url+"/api/cart/insert",
    data: JSON.stringify(cart),
    dataType: "JSON",
    contentType: 'application/json',
    headers: { Authorization: `Bearer ${token}` },
    success: function (res) {
      console.log(res)
      localStorage.setItem('cart', JSON.stringify([]))
      getCart(getCartSuccess, errorGetCart)
    },
    error: function (res) {
      console.log(res)
    }
  });
}




function loginSuccess(data) {
  showAlert("success", "Đăng Nhập Thành Công");
  $("#close_login").click();
}

function loginError(data) {
  // showAlert("error", "<strong>ERROR: </strong>" + data.statusText);
  showAlert("error", "Thông tin đăng nhập không chính xác!");
}

function getToken(data) {
  console.log(data);
  localStorage.setItem("userToken", data.accessToken);
  localStorage.setItem("userName", data.user.username);
  localStorage.setItem("_phone", data.user.phone);
  localStorage.setItem("_address", data.user.address);

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
}

function showAlert(type, message) {
  switch (String(type)) {
    case "success":
      Swal.fire("Thành Công", message, "success");
      $("#close-signup").click();
      break;
    case "error":
      Swal.fire("Thất Bại", message, "error");
      break;
    case "warning":
      Swal.fire("Cảnh Báo", message, "warning");
      // $("#modal-account-tele small").remove();
      // $("#modal-account-name small").remove();
      // $("#modal-account-password small").remove();
      // $("#modal-account-password-main small").remove();
      // $("#modal-account-email small").remove();
      // $("#modal-account-address small").remove();
      break;
  }
}


