$(document).ready(function () {

    // Ẩn 3 thông báo đang tìm, bảng thông tin học phần,
    // thông báo không tìm thấy học phần và thông báo lỗi.
    $("#finding_hp").hide(0);
    $("#not_found_hp").hide(0);
    $("#found_hp").hide(0);
    $("#error_found_hp").hide(0);
    $("#error_trung_hp").hide(0);
    $("#error_add_hp").hide(0);

    // Khi ấn chọn tìm học phần.
    $("#f_tim_hp").submit(function (e) {
        e.preventDefault();

        // Hiển thị thông báo đang tìm học phần.
        $("#finding_hp").show(0);
        $("#not_found_hp").hide(0);
        $("#found_hp").hide(0);
        $("#error_found_hp").hide(0);
        $("#error_trung_hp").hide(0);

        // Lấy giá trị mã hp cần tìm và tạo token.
        ma_hp = $("#mahp_input").val();

        // Gửi yêu cầu tìm học phần.
        $.ajax({
            type: "POST",
            url: "/tim_hp",
            data: {
                ma_hp: ma_hp,
                _token: token
            },                    
            success: function (response) {
                $("#finding_hp").hide(0);

                //==================================================================
                // Tính học phần và kí hiệu vừa thêm.
                // 
                hp_vua_them = response;

                // console.log(hp_vua_them);
                // 
                //==================================================================

                // console.log(response);

                // Tính số lớp học phần tìm được.
                sl = response.length;

                // Nếu có lớp hp được tìm thấy.
                if (sl != 0) {

                    // Hiển thị bảng thông tin học phần,
                    // ẩn phần thông báo không tìm thấy và thông báo lỗi.
                    $("#not_found_hp").hide(0);
                    $("#error_found_hp").hide(0);
                    $("#error_trung_hp").hide(0);
                    $("#found_hp").show(0);

                    // Điền mã và tên học phần lên bảng thông tin.
                    $("#mahp_tim").text(response[0].MAHP);
                    $("#tenhp_tim").text(response[0].TENHP);
                } 
                // Nếu không tìm thấy.
                else {
                    // Ẩn thị bảng thông tin học phần,
                    // hiển phần thông báo không tìm thấy và thông báo lỗi.
                    $("#found_hp").hide(0);
                    $("#error_found_hp").hide(0);
                    $("#not_found_hp").show(0);
                    console.log("Không tìm thấy học phần");
                }
            },
            error: function(xhr,err){

                // Hiện thông báo lỗi ẩn các kết quả tìm học phần và loading.                
                $("#found_hp").hide(0);
                $("#not_found_hp").hide(0);
                $("#finding_hp").hide(0);
                $("#error_found_hp").show(0);
                console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
            }
        });
    });
});