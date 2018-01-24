// File validate dữ liệu login.

$(document).ready(function () {

    // Hàm xử lý thông báo và ràng buột khi nhập dữ liệu
    $( "#form_login" ).validate({
        rules: {
            mssv: {
                required: true,
                maxlength: 8
            },
            password:{
                required: true,
                minlength: 8,
                maxlength: 20
            }
        },

        messages: {
            mssv: {
                required: "Chưa nhập mssv",
                maxlength: "Mã số tối đa 8 kí tự"
            },
            password: {
                required: "Chưa nhập mật khẩu",
                minlength: "Mật khẩu ít nhất 8 kí tự",
                maxlength: "Mật khẩu tối đa 20 kí tự"
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