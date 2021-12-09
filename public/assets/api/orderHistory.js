$(document).ready(function () {
    let token = localStorage.getItem('userToken')

    getOrderByUser(token, "unpaid", success, error, "#tab_status_wait_check_hide")


    $('.get-order').click(function(){
        let status = $(this).attr('status')
        let whereRender = '#'+$(this)[0].id+'_hide'
        getOrderByUser(token, status, success, error, whereRender)
    })
    
});

function success(res, whereRender){
    let html = null
    if(res.success){
        if(res.totalSize > 0){
            html = res.data.map(item => {
                let isPayment = item.isActive ? 
                    `<p class="paid"><i class="ti-check-box"></i>Đã thanh toán</p>`: 
                    `<p class="unpay"><i class="ti-na"></i>chưa thanh toán</p>`

                let orderDetail  =  item.dtoBillDetails.map(order =>{
                    return`
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                <div class="profile-status-items-img">
                                    <img src="${base_url + order.productImage[0]}" alt="status image">
                                </div>
                            </div>

                            <div class="col-lg-7 col-md-7 col-sm-7 col-7">
                                <p class="profile-status-items-title"> ${order.productTitle} </p>
                                <p class="profile-status-items-properties">
                                    <span>${order.properties}</span>
                                </p>
                                <p class="profile-status-items-count"> x${order.quantity} </p>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                <p class="profile-status-items-cash">${new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(order.money)}</p>
                            </div>
                        </div>
                    `
                })

                return `
                <div class="profile-status-items">
                    <div class="row">
                        <div class="profile-status-items-name col-lg-6 col-md-6 col-sm-12 col-12">
                            <p>
                                <i class="ti-bag"></i>
                                Đơn hàng:
                                <span> ${item.codeBill} </span>
                            </p>
                        </div>

                        <div class="profile-status-items-payment col-lg-6 col-md-6 col-sm-12 col-12">
                            ${isPayment}
                            <p class="paid-type">
                                <i class="ti-credit-card"></i>
                                ${item.payment}
                            </p>
                        </div>
                    </div>

                    ${orderDetail.join('')}

                    <div class="profile-status-items-total">
                        <p>
                            <i class="ti-money"></i>
                            Tổng số tiền: 
                            <span> ${new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(item.totalMoney)} </span>
                        </p>
                    </div>
                </div>
                `
            })
        }
        else{
            html = `
                <div>
                    <div style="width: 100%">
                        <div style="display: flex; justify-content: center; align-items: center; height: 200px" >
                            <p>chưa có đơn hàng nào</p>
                        </div>
                    </div>
                </div>
            `
        }
    }
    else{
        html = `
            <div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <p>xảy ra lỗi</p>
                    </div>
                </div>
            </div>
        `
    }

    if(typeof(html) == 'object') html = html.join('')
    $(whereRender).html(html)
}

function error(res){
    console.log(res)
}

