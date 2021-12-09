$(document).ready(function () {
    getCart(getCartSuccess, errorGetCart)

    $('#add-cart').click(addCart)
    $('#buy-now').click(addCart)
});


function errorGetCart(res){
    console.log(res)
}

function getCartSuccess(res) {
    let html = null
    let quantityCart = res.totalSize ?? 0
    let totalCart = res.totalSale

    $('#payment-redirect').click(function(){
        if(res.totalSize == 0){
            sweetAlert('Chưa có đơn hàng', 'Không có đơn hàng để thanh toán.', 'error');
            return false;
        }
    });

    if (res.success) {
        if(res.data.length){

            html = res.data.map(function (item) {
                let price = item.discountMoney;
                let totalPrice = item.totalMoneyItemSalePrice

                let properties = item.properties.map(element => {
                    return element.value
                })

                return `
                            <tr class="table_row">
                                <td class="wrap-icon">
                                    <div class="icon-close" id-cart="${item.id ?? item.variantId}">
                                        <i class="ti-close"></i>
                                    </div>
                                </td>
                                <td class="column-1">
                                    <div class="how-itemcart1">
                                        <a href="chi-tiet-san-pham/${item.productId}" style="display: block">
                                            <img src="${base_url + item.variationImage}" alt="IMG">
                                        </a>
                                    </div>
                                </td>
                                <td class="column-2">
                                    <a href="chi-tiet-san-pham/${item.productId}" style="display: block; width: 81px; overflow-wrap: break-word">
                                        ${item.productName}
                                    </a>
                                </td>
                                <td class="column-2">
                                    <div style="width: 150px">
                                        ${properties.join(', ')}
                                    </div>
                                </td>
                                <td class="column-4">
                                    <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                        <div class="btn-num-product-down-ajax cl8 hov-btn3 trans-04 flex-c-m btn-css" id-cart="${item.id ?? item.variantId}">
                                            <i class="fs-16 zmdi zmdi-minus"></i>
                                        </div>

                                        <input class="mtext-104 cl3 txt-center num-product" type="number"
                                            name="num-product1" value="${item.quantity}" id-cart="${item.id ?? item.variantId}">

                                        <div class="btn-num-product-up-ajax cl8 hov-btn3 trans-04 flex-c-m btn-css" id-cart="${item.id ?? item.variantId}">
                                            <i class="fs-16 zmdi zmdi-plus"></i>
                                        </div>
                                    </div>
                                </td>
                                <td class="column-3">${new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(price)}</td>

                                <td class="column-5">${new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(totalPrice)}</td>
                            </tr>
                        `
            })
        }
        else{
            html = `<td class="table_row" colspan="7">
                        <p style="text-align: center">Chưa có sản phẩm nào</p>
                    </td>`
        }
    }
    else {
        if(localStorage.getItem('cart')) localStorage.setItem('cart', JSON.stringify([]))

        html = `<td class="table_row" colspan="7">
                            <p style="text-align: center">Chưa có sản phẩm nào</p>
                        </td>`
    }

    cartProcess(html, totalCart, quantityCart)
}

function cartProcess(html, total, quantityCart) {
    let token = localStorage.getItem("userToken")
    $('.table-shopping-cart > tbody').html(html).ready(function () {
        $('.icon-close').unbind().click(function () {
            let id = $(this).attr('id-cart')
            deleteCart(id, token)
        });

        $('.btn-num-product-down-ajax').on('click', function () {

            let cartId = $(this).attr('id-cart')

            var numProduct = Number($(this).next().val())
            $(this).next().val(numProduct - 1)

            if (numProduct <= 1){
                $(this).next().val(1)
                deleteCart(cartId)
                return
            }

            let quantityDown = $(this).next().val()
            updateCart(quantityDown, cartId, token)
        });

        $('.btn-num-product-up-ajax').on('click', function () {
            var numProduct = Number($(this).prev().val())
            $(this).prev().val(numProduct + 1)

            let quantityUp = $(this).prev().val()
            let cartId = $(this).attr('id-cart')
            updateCart(quantityUp, cartId, token)
        });

        $('.num-product').unbind().change(function () {
           let quantity = $(this).val()
           let cartId = $(this).attr('id-cart')
           updateCart(quantity, cartId, token)
        })

        $('.total-cart').text(new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(total ?? 0))
        $('#counter').text(quantityCart)
    })
}

function deleteCart(id, token) {
    Swal.fire({
        title: "Thông Báo",
        text: "Bạn muốn hủy sản phẩm này?",
        icon: "info",
        showCancelButton: true,
        cancelButtonText: "Đóng",
        confirmButtonText: "OK",
    }).then(res => {
        if (res.isConfirmed) {
            if(token){
                $.ajax({
                    method: "POST",
                    url: `${base_url}/api/cart/delete?cartIds=${id}`,
                    contentType: 'application/json',
                    headers: { Authorization: `Bearer ${token}` },
                    dataType: "JSON",
                    success: function (res) {
                        if (res.success)
                            Swal.fire({text: 'Thành công', icon: 'success'})
                        else
                            Swal.fire({text: 'Thất bại', icon: 'error'})

                        getCart(getCartSuccess, errorGetCart)
                    },
                    error: function (res) {
                        console.log(res)
                    }
                })
            }
            else{
                let cart = checkExistCart()
                let cartRemove = cart.filter(item => item.variantId != id)
                localStorage.setItem('cart', JSON.stringify(cartRemove))

                getCart(getCartSuccess, errorGetCart)
            }
        }
    })

}

function addCart() {
    let checkRedirect = $(this).hasClass('redirect')
    let token = localStorage.getItem("userToken")

    if (!variationID) {
        alert('bạn cần chọn đủ màu sắc, bộ sản phẩm, kích thước')
        return
    }

    let data = {
        "quantity": $('#num-product').val(),
        "productId": $(this).attr('product_id'),
        "variantId": variationID
    }


    if (!token) {
        let cart  = checkExistCart()
        let checkCartSucces = false

        cart.forEach(item => {
            if(item.variantId == data.variantId){
                let quantityItem = parseInt(item.quantity)
                let quantityData = parseInt(data.quantity)
                quantityItem += quantityData
                updateItemLocalStorage(item.variantId, quantityItem)
                checkCartSucces = true
            }
        })

        if(checkCartSucces){
            Swal.fire({text: 'Thêm sản phẩm thành công', icon: 'success'})
            return
        }

        cart.push(data)
        localStorage.setItem('cart', JSON.stringify(cart))
        Swal.fire({text: 'Thêm sản phẩm thành công', icon: 'success'})
        if(checkRedirect) window.location.href = routeCart
        getCart(getCartSuccess, errorGetCart)

    }

    if(token){
        $.ajax({
            method: "POST",
            url: `${base_url}/api/cart/insert`,
            data: JSON.stringify([data]),
            contentType: 'application/json',
            headers: { Authorization: `Bearer ${token}` },
            dataType: "JSON",
            success: function (res) {
                if (res.success){
                    Swal.fire({text: 'Thêm sản phẩm thành công', icon: 'success'})
                    if(checkRedirect) window.location.href = routeCart
                }
                else{
                    Swal.fire({text: 'Thêm sản phẩm thất bại', icon: 'error'})
                }

                getCart(getCartSuccess, errorGetCart)
            },
            error: function (res) {
                console.log(res)
            }
        })
    }
}

function updateCart(quantity, cartId, token) {
    if(token){
        $.ajax({
            method: "POST",
            url: `${base_url}/api/cart/update?cartId=${cartId}&quantity=${quantity}`,
            headers: { Authorization: `Bearer ${token}` },
            contentType: 'application/json',
            dataType: "JSON",
            success: function (res) {
                getCart(getCartSuccess, errorGetCart)
            },
            error: function (res) {
                console.log(res)
            }
        });
    }
    else{
        updateItemLocalStorage(cartId, quantity)
        getCart(getCartSuccess, errorGetCart)
    }
}

function checkExistCart(){
    let cart = localStorage.getItem('cart') || []
    if(typeof(cart) === 'string'){
        cart = JSON.parse(cart)
    }
    return cart
}

function updateItemLocalStorage(id, value){
    let cart = checkExistCart()
    cart.forEach(item => {
        if(item.variantId == id)
            item.quantity = String(value)
    })

    localStorage.setItem('cart', JSON.stringify(cart))
}


