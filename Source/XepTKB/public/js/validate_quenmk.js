$(document).ready(function () {

    // Ẩn thông báo lỗi email trường.
    $("#email_ctu").hide(0);

    // Kiểm tra email có phải do trường cấp hay không?
    $("#form_quenmk").submit(function (e) { 
        
        mail = $("#email").val();
        if (mail != ""){
            if (mail.indexOf("ctu.edu.vn") == -1){
                $("#email_ctu").show(0);
                $("#email").focus();
                e.preventDefault();
            }
            else {
                $("#email_ctu").hide(0);
            }
        }
    });

    // Hàm xử lý thông báo và ràng buột khi nhập email để lấy mật khẩu lại.
    $("#form_quenmk").validate({
        rules: {
            email: {
                required: true,
                maxlength: 50,
                email: true
            }
        },

        messages: {
            email: {
                required: "Chưa nhập email",
                maxlength: "Email tối đa 50 kí tự",
                email: "Email không đúng định dạng"
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