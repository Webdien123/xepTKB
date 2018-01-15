// Hàm sắp xếp bảng dữ liệu học phần theo sỉ số (cột thứ 3)
function sortTable(){

    // Lấy DS các dòng.
    var rows = $('#tb_hp tbody tr').get();

    // Sắp xếp các dòng theo cột chỉ số thứ 2 (thứ tự thứ 3/sỉ sổ)
    rows.sort(function(a, b) {

        var A = Number($(a).children('td').eq(2).text());
        var B = Number($(b).children('td').eq(2).text());

        if(A < B) {
            return -1;
        }

        if(A > B) {
            return 1;
        }

        return 0;

    });

    // Lấy tất cả các dòng đã sắp xếp theo lần lượt vào bảng.
    $.each(rows, function(index, row) {
        $('#tb_hp').children('tbody').append(row);
    });
}

// Hàm tính màu cần tô.
function Tinh_Mau_Can_To() {
    for (let index = 1; index <= 15; index++) {
        ten_class = ".hp_" + index + "_bg";
        if ($(ten_class).length == 0) {
            return "hp_" + index + "_bg";
        }
    }
    return "";
}

// Thêm một buổi học lên thời khóa biểu minh họa.
function them_buoi_hoc(ma_hp, thu, tiet_bd, sotiet, tenhp, phong, mau_can_to) {
    tenhp_canthem = 
        '<span>' + 
            tenhp + '<br>(' +
            phong + 
        ')</span>';

    // Tính tiết đầu tiên cần điền HP dạng tr và tính tiết tr tiếp theo.
    tiet_dau_tien = $(".tr_tiet_hoc:eq("+ (tiet_bd - 1) + ")");
    tiet_tt = tiet_dau_tien.next('tr');

    // Tính tiết đầu tiên dạng td thêm nội dung và css cần thiết.
    tiet_dau_tien = tiet_dau_tien.find('td').eq(thu - 1);
    tiet_dau_tien.html(tenhp_canthem);
    tiet_dau_tien.addClass("vcenter");
    tiet_dau_tien.addClass(ma_hp);
    tiet_dau_tien.addClass(mau_can_to);
    tiet_dau_tien.attr('rowspan', sotiet);
    
    // Ẩn các cột bị thừa.
    for (let index = 0; index < sotiet - 1; index++) {
        tiet_tt.find('td').eq(thu - 1).addClass("hide " + ma_hp + "_hide");
        tiet_tt = tiet_tt.next('tr');
    }
}

// Xóa các buổi học đang hiển thị theo một mã HP.
function xoa_buoi_hoc(ma_hp) {

    // Xóa nội dung môn học trên thời khóa biểu.
    $("." + ma_hp).html("");
    $("." + ma_hp).attr('rowspan', 1);
    $("." + ma_hp).removeClass().addClass("text-center");

    // Tìm tất cả các tiết bị ẩn của HP trên TKB và hiển thị trở lại.
    $("." + ma_hp + "_hide").removeClass().addClass("text-center");    
}

// Xóa tất cả các buổi học trên TKB.
function xoa_all_buoi_hoc() {

    // Xóa tất cả nội dung môn học trên thời khóa biểu.
    $(".vcenter").html("");
    $(".vcenter").attr('rowspan', 1);
    $(".vcenter").removeClass().addClass("text-center");

    // Tìm tất cả các tiết bị ẩn trên TKB và hiển thị trở lại.
    $(".hide").removeClass().addClass("text-center");
}

function Doi_Ki_hieu(ma_hp, mau_can_to) {

    // Lấy kí hiệu nhóm HP đã chọn của HP vừa thêm.
    kihieu_nhom_hp = $('#sl_' + ma_hp).children(":selected").text();

    // Xóa các buổi học cũ đã hiển thị.
    xoa_buoi_hoc(ma_hp);

    // Điền lại buổi học theo kí hiệu mới.
    dien_tkb(ma_hp, kihieu_nhom_hp, mau_can_to);
}

// Điền thời gian học của HP lên thời khóa biểu.
function dien_tkb(ma_hp, kihieu, mau_can_to) {

    $.ajax({
        type: "POST",
        url: "/lay_tgian_hoc",
        data: {
            ma_hp: ma_hp,
            kihieu: kihieu,
            _token: token
        },
        success: function (response) {
            // console.log(response);
            if (response[0].THU != 0) {
                response.forEach(element => {
                    them_buoi_hoc(
                        element.MAHP,
                        element.THU, 
                        element.TIETBD, 
                        element.SOTIET, 
                        element.TENHP, 
                        element.PHONG,
                        mau_can_to
                    );
                });
            }
        },
        error: function(xhr,err){
            console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
        }
    });
}

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

        //======================================================================
        // Đoạn xử lý kí hiệu lớp học phần tạm thời.
        // 
        //======================================================================
        // 
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
        // 
        //==========================================================================

        // Lưu trữ html của tr chứa học phần cần thêm và dòng thông báo khi hp không có lịch.
        class_mau_can_to = "";
        mau_can_to = "";
        no_tkb = "";

        // Nếu HP không có lịch học thì không gán lớp "can_to_mau".
        if (hp_vua_them[0].THU == '0') {
            mau_can_to = '<tr class="tr_hp">';
            no_tkb = '</br><span class="text-danger">(Liên hệ GV để xếp lịch)</span>';
        } else {
            
            // Tính số màu đã tô.
            class_mau_can_to = Tinh_Mau_Can_To();

            mau_can_to = '<tr class="tr_hp can_to_mau ' + class_mau_can_to + '">';
        }

        // Tính html cho dòng học phần cần thêm.
        data_row =
            mau_can_to +
                '<td>' + hp_vua_them[0].MAHP + '</td>\
                <td>' + 
                    hp_vua_them[0].TENHP + 
                    no_tkb 
                + '</td>\
                <td>' + hp_vua_them[0].SISO + '</td>\
                <td>\
                    <select id="sl_'+ hp_vua_them[0].MAHP +'" onchange="Doi_Ki_hieu(\'' + hp_vua_them[0].MAHP + '\', \'' + class_mau_can_to + '\')">' +
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

        console.log(ds_hp);

        // Sắp xếp tăng dần theo sỉ sổ.
        sortTable();

        // Lấy kí hiệu nhóm HP đã chọn của HP vừa thêm.
        kihieu_nhom_hp = $('#sl_' + hp_vua_them[0].MAHP).children(":selected").text();

        // Điền HP lên thời khóa biểu theo kí hiệu đã chọn.
        dien_tkb(hp_vua_them[0].MAHP, kihieu_nhom_hp, class_mau_can_to);
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
    for (let index = 0; index < ds_hp.length; index++) {
        if (ds_hp[index][0].MAHP == hp_vua_them[0].MAHP) {
            ketqua = true;
            break;
        }
    }
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

            // Xóa HP trên bảng HP.
            tr_can_xoa.remove();

            // Xóa các buổi thọc đang hiển thị trên thời của khóa biểu của HP cần xóa.
            xoa_buoi_hoc(mahp_can_xoa);

            // Xóa HP trong mảng lưu toàn cục.
            ds_hp.forEach(function(item, index, object) {
                if (item[0].MAHP == mahp_can_xoa) {
                    object.splice(index, 1);
                }
            });
            
            // Kiểm tra số lượng HP còn lại.
            kiem_sluong_hp();
        }
        
        console.log(ds_hp);
    });

    // Xóa tất cả học phần.
    $("#btn_xoa_all_hp").click(function (e) { 
        e.preventDefault();
        $(".tr_hp").remove();
        ds_hp = [];        
        $("#tr_no_hp").show(0);

        // Xóa tất cả HP trên TKB.
        xoa_all_buoi_hoc();

        console.log(ds_hp);
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