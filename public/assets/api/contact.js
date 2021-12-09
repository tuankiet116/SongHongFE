$(document).ready(function () {
    $('#submit-contact').click(function(){
        let name    = $('#name-cus').val()
        let phone   = $('#phone-cus').val()
        let email   = $('#email-cus').val()
        let address = $('#address-cus').val()
        let title   = $('#title-cus').val()
        let content = $('#content-cus').val()

        if(!validateField(name, phone, email)) return


        let data = {
            email: email,
            nameCus:name,
            phone: phone,
            address: address,
            title: title,
            content: content,
        }

        insertEmail(insertEmailSuccess, insertEmailError, JSON.stringify(data))
       
    })
});

function insertEmailSuccess(res){
    if(res.success){
        Swal.fire("Admin đã nhận phản hồi của bạn", "", "success")
        $('#name-cus').val('')
        $('#phone-cus').val('')
        $('#email-cus').val('')
        $('#address-cus').val('')
        $('#title-cus').val('')
        $('#content-cus').val('')
    }
    else{
        Swal.fire("oops! có lỗi xảy ra", "", "error")
    }
}

function insertEmailError(res){
    Swal.fire("oops! có lỗi xảy ra", "", "error")
}

function validateField(name, phone, email){
    let check = true

    if( name == '' || name == null ){
        $('#small-name-cus').css('display', 'block')
        check = false
    } 

    if(phone == '' || phone == null){
        $('#small-phone-cus').text('Số điện thoại đang bị bỏ trống').css('display', 'block')
        check = false
    }
        
    if(email == '' || email == null){
        $('#small-email-cus').text('Email đang bị bỏ trống').css('display', 'block')
        check = false   
    }        
    
    if(!isVietnamesePhoneNumber(phone) && phone != null && phone != ''){
        $('#small-phone-cus').text('Vui lòng nhập đúng số điện thoại của bạn').css('display', 'block')
        check = false
    }
        
    if(!validateEmail(email) && email != null && email != ''){
        $('#small-email-cus').text('Vui lòng nhập đúng email của bạn').css('display', 'block')
        check = false
    }

    return check
}