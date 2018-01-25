$(document).ready(function () {
    // Hàm xử lý thông báo và ràng buột khi nhập dữ liệu đăng kí tài khoản.
    $("#form_doimk").validate({
        rules: {
            old_pass:{
                required: true,
                minlength: 8,
                maxlength: 20
            },
            new_pass:{
                required: true,
                minlength: 8,
                maxlength: 20
            },            
            r_new_pass:{
                required: true,
                minlength: 8,
                maxlength: 20,
                equalTo : "#new_pass"
            }
        },

        messages: {
            old_pass: {
                required: "Chưa nhập mật khẩu cũ",
                minlength: "Mật khẩu ít nhất 8 kí tự",
                maxlength: "Mật khẩu tối đa 20 kí tự"
            },
            new_pass: {
                required: "Chưa nhập mật khẩu mới",
                minlength: "Mật khẩu ít nhất 8 kí tự",
                maxlength: "Mật khẩu tối đa 20 kí tự"
            },
            r_new_pass: {
                required: "Chưa nhập lại mật khẩu mới",
                minlength: "Mật khẩu ít nhất 8 kí tự",
                maxlength: "Mật khẩu tối đa 20 kí tự",
                equalTo : "Hai mật khẩu mới chưa khớp nhau"
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
            $(element).parent(".form-group").addClass(errorClass).removeClass(validClass);   
        },
                    
        unhighlight: function(element, errorClass, validClass) {
            $(element).parent(".form-group").removeClass(errorClass).addClass(validClass); 
        }

    });
});