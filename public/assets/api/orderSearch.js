$(document).ready(function () {
    $('.order-check-btn').on('click', function () {
        var data = progressData();
        getOrderInformationAPI(getOrderSuccess, getOrderError, data);
    });
});

function progressData() {
    var email = $('#email-order').val().trim();
    var phone = $('#phone-order').val().trim();
    var code = $('#code-order').val().trim();
    return `email=${email}&codeBill=${code}&phone=${phone}`;
}

function getOrderSuccess(res) {
    var data = res.data;
    if(data.length == 0){
        $('.main').html('<h4 style="text-align: center;padding: 30px;">Không Có Đơn Hàng Nào</h4>');
        return;
    }
    var content = data.map(function (item) {
        var html = `
        <div class="order-status-container">
        <div class="order-status-head">
            <div class="row">
                <div class="col-lg-3">
                    <p>
                        Mã đơn hàng:
                        <span style="font-weight: bold"> #${item.codeBill} </span>
                        <i id="${item.codeBill}" class="toggle-btn ti-exchange-vertical"></i>
                    </p>
                </div>

                <div class="col-lg-1">
                    <p> Số lượng:
                        ${item.dtoBillDetails.length} 
                    </p>
                </div>

                <div class="col-lg-2">
                    <p> Ngày mua:
                        <span> ${moment(item.createdDate).format('DD/MM/YYYY')} </span>
                    </p>
                </div>

                <div class="col-lg-2">
                    <p>
                        Số điện thoại:
                        <span>${item.customerPhone}</span>
                    </p>
                </div>

                <div class="col-lg-2">
                    <p>
                        Nhà vận chuyển:
                        <span> ${item.shippingName} </span>
                    </p>
                </div>

                <div class="col-lg-2">
                    <p style="color: rgb(116, 116, 253);">
                        Mã vận đơn:
                        <span> ${item.shippingCode} </span>
                    </p>
                    <p> 
                        Trạng Thái:`;
                        if(item.isActive === true){
                            html += `<span style="color: green;" >Đã Thanh Toán</span>`;
                        }
                        else{
                            html += `<span style="color: red;">Chưa Thanh Toán</span>`;
                        }
                       
                   html += `</p>
                </div>
            </div>
        </div>

        <div class="order-toggle-content">
            <div class="order-status-progress">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                        <div class="progress-content`;
        if (item.status == 'unpaid') {
            html += ` progress-active`
        }

        html += `">
                            <i class="ti-settings"></i>
                        </div>

                        <div class="progress-line-in"></div>

                        <p> Chờ xác nhận </p>
                    </div>

                    <div class="progress-line-box col-lg-1 col-md-1 col-sm-12 col-12">
                        <div class="progress-line"></div>
                        <div class="progress-vertical"></div>
                    </div>

                    <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                        <div class="progress-content`;
        if (item.status == 'shipwait') {
            html += ` progress-active`
        }

        html += `">
                            <i class="ti-truck"></i>
                        </div>

                        <p> Chờ lấy hàng </p>

                        <div class="progress-line"></div>
                    </div>

                    <div class="progress-line-box col-lg-1 col-md-1 col-sm-12 col-12">
                        <div class="progress-line"></div>
                        <div class="progress-vertical"></div>
                    </div>

                    <div class="col-lg-2 col-md-3 col-sm-12 col-12">
                        <div class="progress-content`;
        if (item.status == 'paid') {
            html += ` progress-active`
        }

        html += `">
                            <i class="ti-check"></i>
                        </div>

                        <p> Đã giao hàng </p>

                        <div class="progress-line"></div>
                    </div>

                    <div class="progress-line-box col-lg-1 col-md-1 col-sm-12 col-12">
                        <div class="progress-line"></div>
                        <div class="progress-vertical"></div>
                    </div>

                    <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                        <div class="progress-content`;
        if (item.status == 'cancel') {
            html += ` progress-active`
        }

        html += `">
                            <i class="ti-close"></i>
                        </div>

                        <p> Hủy </p>

                        <div class="progress-line" style="left: -50px"></div>
                    </div>
                </div>
            </div>

            <div class="order-status-table">
                <div class="order-status-table-container">
                    <div class="order-status-table-content">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th> Sản phẩm </th>
                                    <th> Đơn giá </th>
                                    <th> Số lượng </th>
                                    <th> Thành tiền </th>
                                </tr>
                            </thead>
                            <tbody>`;
        var detail = item.dtoBillDetails;
        html += detail.map(function (value) {
            return `<tr>
                        <td>${value.productTitle}</td>
                        <td>${new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(value.price)}</td>
                        <td>${value.quantity}</td>
                        <td>${new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(value.money)}</td>
                    </tr>`;
        }).join('');

        html += `</tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>`;
        return html;
    });

    $('.main').html(content).ready(function () {
        /********** ORDER CHECK TOGGLE **********/
        $(".order-status-container:not(:first) .order-toggle-content").slideUp();
        $(".order-status-container:first .order-toggle-content").addClass('opened');

        $(".toggle-btn").click(function () {
            $(".order-toggle-content").slideUp();
            if($(this).closest('.order-status-container').find('.order-toggle-content').hasClass('opened')){
                $(this).closest('.order-status-container').find('.order-toggle-content').removeClass('opened');
                return;
            }
            $(this).closest('.order-status-container').find('.order-toggle-content').slideToggle();
            $(this).closest('.order-status-container').find('.order-toggle-content').addClass('opened');
        });
    });
}

function getOrderError(data) {
    console.log(data);
}
