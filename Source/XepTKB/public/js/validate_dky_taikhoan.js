$(document).ready(function () {

    // Ẩn thông báo lỗi email trường.
    $("#email_ctu").hide(0);

    // Kiểm tra email có phải do trường cấp hay không?
    $("#form_dki_tk").submit(function (e) { 
        
        // mail = $("#email").val();
        // if (mail != ""){
        //     if (mail.indexOf("ctu.edu.vn") == -1){
        //         $("#email_ctu").show(0);
        //         $("#email").focus();
        //         e.preventDefault();
        //     }
        //     else {
        //         $("#email_ctu").hide(0);
        //     }
        // }
    });

    // Hàm xử lý thông báo và ràng buột khi nhập dữ liệu đăng kí tài khoản.
    $("#form_dki_tk").validate({
        rules: {
            name: {
                required: true,
                maxlength: 50
            },
            email: {
                required: true,
                maxlength: 50,
                email: true
            },
            mssv: {
                required: true,
                maxlength: 8
            },
            password:{
                required: true,
                minlength: 8,
                maxlength: 20
            },            
            confirm:{
                required: true,
                minlength: 8,
                maxlength: 20,
                equalTo : "#password"
            },
            malop:{
                required: true,
                maxlength: 8
            }
        },

        messages: {
            name: {
                required: "Chưa nhập họ tên",
                maxlength: "Họ tên tối đa 50 kí tự"
            },
            email: {
                required: "Chưa nhập email",
                maxlength: "Email tối đa 50 kí tự",
                email: "Email không đúng định dạng"
            },
            mssv: {
                required: "Chưa nhập mssv",
                maxlength: "Mã số tối đa 8 kí tự"
            },
            password: {
                required: "Chưa nhập mật khẩu",
                minlength: "Mật khẩu ít nhất 8 kí tự",
                maxlength: "Mật khẩu tối đa 20 kí tự"
            },
            confirm: {
                required: "Chưa nhập lại mật khẩu",
                minlength: "Mật khẩu ít nhất 8 kí tự",
                maxlength: "Mật khẩu tối đa 20 kí tự",
                equalTo : "Hai mật khẩu chưa khớp nhau"
            },
            malop: {
                required: "Chưa nhập mã lớp",
                maxlength: "Mã lớp tối đa 8 kí tự"
            }
        },

        errorPlacement: function (error, element) {
            error.css("color", "#990000");
            error.addClass("help-block");
            error.insertAfter(element.closest("div"));
        },

        errorClass: "has-error",
        validClass: "has-success",
        highlight: function(element,errorClass,validClass){
            $(element).parent(".input-group").addClass(errorClass).removeClass(validClass);   
        },
                    
        unhighlight: function(element, errorClass, validClass) {
            $(element).parent(".input-group").removeClass(errorClass).addClass(validClass); 
        }

    });
});