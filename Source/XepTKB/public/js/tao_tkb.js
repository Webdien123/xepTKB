// Hàm thêm học phần mới lên bảng học phần.
function them_hp() {

    // Ẩn thông báo trùng học phần.
    $("#error_trung_hp").hide(0);

    // Nếu hp chưa thêm.
    if (da_them_hp() == false) {

        // Ẩn thông báo chưa có học phần.
        $("#tr_no_hp").hide(0);

        // Biến lưu danh sách kí hiệu lớp học phần.
        var ds_kihieu = [];
        var option_kihieu = "";

        // Tính danh sách kí hiệu lớp học phần.
        $.each(hp_vua_them, function(i, el){
            if($.inArray(el.KIHIEU, ds_kihieu) === -1) {
                ds_kihieu.push(el.KIHIEU);
                if (ds_kihieu.length == 1) {
                    option_kihieu += '<option value="" selected>' + ds_kihieu[ds_kihieu.length-1] + '</option>';
                }
                else{
                    option_kihieu += '<option value="">' + ds_kihieu[ds_kihieu.length-1] + '</option>';
                }
            }
        });

        // Tính html cho dòng học phần cần thêm.
        data_row = 
            '<tr class="tr_hp">\
                <td>' + hp_vua_them[0].MAHP + '</td>\
                <td>' + hp_vua_them[0].TENHP + '</td>\
                <td>\
                    <select name="" id="">' +
                        option_kihieu
                    + '</select>\
                </td>\
                <td>\
                    <button type="button" class="btn btn-large btn-block btn-danger btn_xoa_hp">\
                        <i class="fa fa-trash" aria-hidden="true"></i>\
                    </button>\
                </td>\
            </tr>';

        // Thêm thông tin lên trang tạo tkb.
        $('#tb_hp tbody').append(data_row);

        // Thêm thông tin hp vào mảng toàn cục.
        ds_hp.push(hp_vua_them);
    }
    // Nếu hp đã thêm trước đó.
    else {
        // Hiện thông báo trùng môn.
        $("#error_trung_hp").show(0);
        $("#error_trung_hp").hide(1800);
    }

        
}

// Hàm kiểm tra học phần đã thêm trước đó hay chưa.
function da_them_hp() {
    ketqua = false;
    ds_hp.forEach(element => {
        if (element[0].MAHP == hp_vua_them[0].MAHP) {            
            ketqua = true;
        }
    });
    return ketqua;
}

// Xử lý xóa học phần.
$(document).ready(function () {

    // Xóa một học phần.
    $("#tb_hp").on('click', '.btn_xoa_hp', function () {

        // Tính vị trí và tên học phần cần xóa.
        tr_can_xoa = $(this).closest('tr');
        tenhp_can_xoa = tr_can_xoa.find("td:nth-child(2)").text();

        if(window.confirm('Xóa học phần ' + tenhp_can_xoa + '?')){

            // Tính mã học phần cần xóa.
            mahp_can_xoa = tr_can_xoa.find("td:first").text();

            // Xóa HP trên giao diện.
            tr_can_xoa.remove();

            // Xóa HP trong mảng lưu toàn cục.
            ds_hp.forEach(function(item, index, object) {
                if (item[0].MAHP == mahp_can_xoa) {
                    object.splice(index, 1);
                }
            });
            
            // Kiểm tra số lượng HP còn lại.
            kiem_sluong_hp();
        }        
    });

    // Xóa tất cả học phần.
    $("#btn_xoa_all_hp").click(function (e) { 
        e.preventDefault();
        $(".tr_hp").remove();
        ds_hp = [];        
        $("#tr_no_hp").show(0);
    });

    // Hàm kiểm tra số lượng học phần còn lại và
    // hiển thị thông báo không còn học phần nếu xóa hết.
    function kiem_sluong_hp() {
        var rowCount = $('.tr_hp').length;
        if (rowCount == 0) {
            $("#tr_no_hp").show(0);
        }
    }
});