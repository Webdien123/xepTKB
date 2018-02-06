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

// Hàm kiểm tra 2 buổi học có trùng lịch nhau không.
function KiemTra_TrungLich(bhoc1, bhoc2) {

    // Nếu thứ học trùng nhau.
    if (bhoc1.THU == bhoc2.THU) {

        // Nếu giờ học trùng nhau.
        if (
            (parseInt(bhoc1.TIETBD) + parseInt(bhoc1.SOTIET) - 1) >= (parseInt(bhoc2.TIETBD))
             && 
            (parseInt(bhoc2.TIETBD) + parseInt(bhoc2.SOTIET) - 1) >= (parseInt(bhoc1.TIETBD))){

            // Kiểm tra tuần học.
            for (let i = 0; i < 18; i++) {

                // Nếu tuần học trùng nhau.
                if (bhoc1.TUANHOC[i] == bhoc2.TUANHOC[i] && bhoc1.TUANHOC[i] != '*') {
                    return true;
                }
            }
        }
    }
    return false;
}

// Hàm tính nhóm không trùng lịch cho học phần vừa thêm tại kí hiệu cần xét.
// (nếu kí hiệu không trùng các HP đã có trả về chính kí hiệu đó, ngược lại trả về chuỗi rỗng)
function Kiem_Tra_Nhom_Trung_Lich(kihieu) {

    // Giả sử kí hiệu đang xét không bị trùng.
    ketqua = '';

    for (let i = 0; i < hp_vua_them.length; i++) {
        for (let j = 0; j < ds_hp_can_luu.length; j++) {
            
            // Nếu học phần đang xét khác môn đang có và có kí hiệu tương ứng.
            if (hp_vua_them[i].KIHIEU == kihieu && hp_vua_them[i].MAHP != ds_hp_can_luu[j].MAHP) {

                // Kiểm tra có trùng lịch hay không.
                trung_lich = KiemTra_TrungLich(hp_vua_them[i], ds_hp_can_luu[j]);

                // Nếu có gán tạm kí hiệu này là kết quả.
                if (trung_lich == false) {
                    ketqua = hp_vua_them[i].KIHIEU;                    
                }
                // Nếu không trùng nhưng kí hiệu này đã bị trùng trước đó thì lấy kết quả là rỗng.
                else {
                    if (ketqua == hp_vua_them[i].KIHIEU) {
                        ketqua = '';

                        return ketqua;
                    }                    
                }
            }
        }
    }
    return ketqua;
}

// Thêm một buổi học lên thời khóa biểu minh họa.
function them_buoi_hoc(ma_hp, thu, tiet_bd, sotiet, tenhp, phong, tuanhoc, mau_can_to, siso) {

    // Cập nhật sỉ số lên bảng học phần.
    $("#no_tkb_" + ma_hp).closest('td').next().text(siso);

    // Tính số tuần học của HP.
    var so_tuan_hoc = 18 - (tuanhoc.match(/[*]/g) || []).length;
    if (so_tuan_hoc == 15 && hki_hientai < 3 || so_tuan_hoc == 5 && hki_hientai == 3 ||
     tuanhoc[0] == '*') {
        $(".tr_tuanhoc_" + ma_hp).remove();
    }
    else{
        // Lấy màu đã tô.
        ten_class = $("#no_tkb_" + ma_hp).closest('tr').attr('class');    
        ten_class = ten_class.split(' ');
        mau_can_to = ten_class[2];
        
        if ($(".tr_tuanhoc_" + ma_hp).length == 0) {
            $('\
                <tr class="tr_th tr_tuanhoc_'+ ma_hp +' '+ mau_can_to +'">\
                <td>Tuần học</td>\
                <td colspan="4">'+ tuanhoc +'</td>\
                <td class="hide">'+ siso +'</td>\
                <td class="hide">'+ siso +'</td>\
                </tr>'
            ).insertAfter($("#sl_" + ma_hp).closest('.tr_hp'));
        }
    }

    tenhp_canthem = 
        '<span>' + 
            tenhp + '</br>(' +
            phong + ')'
        '</span>';

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

    // Sắp xếp lại bảng học phần.
    sortTable();
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

// Hàm tính HP bị trùng lịch với học phần cần chuyển nhóm.
// (Kết quả trả về là Mã HP bị trùng đầu tiên hoặc chuỗi rỗng nếu không trùng tất cả HP trước đó)
function Kiem_Tra_Nhom_Bi_Trung(ma_hp ,kihieu) {

    // Giả sử không trùng với bất kì HP nào trước đó.
    ketqua = '';

    // Lấy lịch học của nhóm HP tương ứng.
    
    var lich_hoc = [];

    for (let i = 0; i < ds_hp.length; i++) {

        // Tìm học phần cần điền
        if (ds_hp[i][0].MAHP == ma_hp) {

            // Tìm kí hiệu cần điền.
            for (let j = 0; j < ds_hp[i].length; j++) {
                if (ds_hp[i][j].KIHIEU == kihieu) {
                    lich_hoc.push(ds_hp[i][j]);
                }
            }
        }
    }

    // console.log(ds_hp_can_luu);

    // Kiểm tra trùng lịch cho các buổi học vừa tính.
    for (let i = 0; i < lich_hoc.length; i++) {
        for (let j = 0; j < ds_hp_can_luu.length; j++) {
            
            if (lich_hoc[i].MAHP != ds_hp_can_luu[j].MAHP) {
                
                trung_lich = KiemTra_TrungLich(lich_hoc[i], ds_hp_can_luu[j]);

                if (trung_lich) {
                    ketqua = ds_hp_can_luu[j];
                    break;
                }
            }
        }
    }

    return ketqua;
}

// Tính kí hiệu cũ trước đó đã chọn của HP.
function Lay_Ki_Hieu_Cu(ma_hp) {
    for (let i = 0; i < ds_hp_can_luu.length; i++) {
        if (ds_hp_can_luu[i].MAHP == ma_hp) {
            return ds_hp_can_luu[i].KIHIEU;
        }
    }
}

// Thay cập nhật thời gian học của một HP khi chọn kí hiệu khác.
function Doi_Ki_hieu(ma_hp) {

    // Bỏ màu cho các buổi học bị trùng trước đó.
    $(".trung_buoi_hoc").removeClass("trung_buoi_hoc");

    // Lấy kí hiệu nhóm HP đã chọn của HP vừa thêm.
    kihieu_nhom_hp = $('#sl_' + ma_hp).children(":selected").text();

    // Nếu kí hiệu vừa chọn trùng lịch với các học phần trước đó.
    mon_bi_trung = Kiem_Tra_Nhom_Bi_Trung(ma_hp, kihieu_nhom_hp);

    if (mon_bi_trung != '') {

        // Hiện thông báo trùng học phần và thông báo cho người dùng.
        $("#bao_trung_hp").show();
        $("#bao_trung_hp").text("Nhóm " + kihieu_nhom_hp + " trùng lịch " + mon_bi_trung.MAHP + " nhóm " + mon_bi_trung.KIHIEU);    

        buoi_hocs = $("td." + mon_bi_trung.MAHP);

        for (let i = 0; i < buoi_hocs.length; i++) {
            
            // Tính tiết học.
            tiet_hoc = buoi_hocs.eq(i).parent('.tr_tiet_hoc').index() + 1;

            if (tiet_hoc > 10) tiet_hoc = tiet_hoc - 2;
            else if (tiet_hoc > 5) tiet_hoc = tiet_hoc - 1;

            // Tính thứ.
            thu_hoc = buoi_hocs.eq(i).index() + 1;

            if (tiet_hoc == mon_bi_trung.TIETBD && thu_hoc == mon_bi_trung.THU) {
                buoi_hocs.eq(i).addClass("trung_buoi_hoc");
                break;
            }
        }

        // Tính và trả lại kí hiệu đã chọn trước đó.
        // ki_hieu_cu = Lay_Ki_Hieu_Cu(ma_hp);

        // $("#sl_" + ma_hp + " option[text=" + ki_hieu_cu + "]").attr('selected', true);

        // $("#sl_" + ma_hp).val(ki_hieu_cu);
    }
    else{
        // Ẩn thông báo trùng học phần.
        $("#bao_trung_hp").hide();

        // Xóa các buổi học cũ đã hiển thị.
        xoa_buoi_hoc(ma_hp);

        // Tính thông tin HP đã được tô màu chưa.
        da_to_mau = $("#no_tkb_" + ma_hp).closest('tr').hasClass("can_to_mau").toString();

        // Nếu HP chưa tô màu.
        if (da_to_mau == "false"){

            // Tính màu mới và điền lên tkb.
            $("#no_tkb_" + ma_hp).closest('tr').addClass("can_to_mau");
            mau_can_to = Tinh_Mau_Can_To();
            $("#no_tkb_" + ma_hp).closest('tr').addClass(mau_can_to);
            dien_tkb(ma_hp, kihieu_nhom_hp, mau_can_to);
        }
        // Nếu HP đã có màu trước đó.
        else{
            // Lấy màu đã tô.
            ten_class = $("#no_tkb_" + ma_hp).closest('tr').attr('class');    
            ten_class = ten_class.split(' ');
            mau_can_to = ten_class[2];

            // Điền lại buổi học theo kí hiệu mới.
            dien_tkb(ma_hp, kihieu_nhom_hp, mau_can_to);
        }
    }    
}

// Điền thời gian học của HP lên thời khóa biểu.
function dien_tkb(ma_hp, kihieu, mau_can_to) {

    // Xóa thông tin của lớp HP theo kí hiệu cũ.
    for (let index = 0; index < ds_hp_can_luu.length; index++) {
        if (ds_hp_can_luu[index].MAHP == ma_hp) {
            ds_hp_can_luu.splice(index, 1);
            index--;
        }        
    }

    // Xết tất cả phần tử trong mảng HP tổng hợp.
    for (let i = 0; i < ds_hp.length; i++) {

        // Tìm học phần cần điền
        if (ds_hp[i][0].MAHP == ma_hp) {

            // Tìm kí hiệu cần điền.
            for (let j = 0; j < ds_hp[i].length; j++) {
                if (ds_hp[i][j].KIHIEU == kihieu) {

                    // Nếu HP cần điền có lịch học.
                    if (ds_hp[i][j].THU != 0) {

                        // Nếu kí hiệu đã chọn trước đó không có lịch học.
                        if($("#no_tkb_" + ds_hp[i][j].MAHP).text() != ""){

                            // Điều chỉnh về có lịch học.
                            $("#no_tkb_" + ds_hp[i][j].MAHP).text("");
                        }

                        // Điền giờ học lên TKB.
                        them_buoi_hoc(
                            ds_hp[i][j].MAHP,
                            ds_hp[i][j].THU,
                            ds_hp[i][j].TIETBD, 
                            ds_hp[i][j].SOTIET, 
                            ds_hp[i][j].TENHP, 
                            ds_hp[i][j].PHONG,
                            ds_hp[i][j].TUANHOC,
                            mau_can_to,
                            ds_hp[i][j].SISO
                        );
                    }
                    // Nếu HP cần điền không có lịch học.
                    else{
                        // Điều chỉnh thông báo sang không có lịch học.
                        $("#no_tkb_" + ds_hp[i][j].MAHP).text("(Liên hệ GV để xếp lịch)");

                        // Xóa màu HP đang dùng.
                        $("#no_tkb_" + ds_hp[i][j].MAHP).closest('tr').removeClass().addClass("tr_hp");
                    }

                    // Thêm thông tin theo HP mới.
                    ds_hp_can_luu.push(ds_hp[i][j]);
                }
            }
        }
    }
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

        // Đã chọn được nhóm không trùng các HP trước đó.
        var da_chon_nhom = false;

        // Nếu kí hiệu vừa chọn trùng lịch với các học phần trước đó.
        var mon_bi_trung = [];
        

        // Tính danh sách kí hiệu lớp học phần.
        $.each(hp_vua_them, function(i, el){
            if($.inArray(el.KIHIEU, ds_kihieu) === -1) {
                ds_kihieu.push(el.KIHIEU);

                if ($(".tr_hp").length != 0) {

                    if (da_chon_nhom == false) {

                        // Tính nhóm cần thêm mà không bị trùng các HP trước đó.
                        // (nếu nhóm không trùng trả về chính kí hiệu đó, ngược lại trả về chuỗi rỗng)
                        nhom_can_them = Kiem_Tra_Nhom_Trung_Lich(ds_kihieu[ds_kihieu.length-1]);                        
    
                        if (nhom_can_them != '') {
                            option_kihieu += '<option value="'+ ds_kihieu[ds_kihieu.length-1] +'" selected>' + ds_kihieu[ds_kihieu.length-1] + '</option>';
                            da_chon_nhom = true;
                        }
                        else{
                            // mon_bi_trung.push(Kiem_Tra_Nhom_Bi_Trung(hp_vua_them[0].MAHP, ds_kihieu[ds_kihieu.length-1]));
                            option_kihieu += '<option value="'+ ds_kihieu[ds_kihieu.length-1] +'">' + ds_kihieu[ds_kihieu.length-1] + '</option>';
                        }
                    }
                    else{
                        option_kihieu += '<option value="'+ ds_kihieu[ds_kihieu.length-1] +'">' + ds_kihieu[ds_kihieu.length-1] + '</option>';
                    }
                }
                else{
                    if (ds_kihieu.length == 1) {
                        option_kihieu += '<option value="'+ ds_kihieu[ds_kihieu.length-1] +'" selected>' + ds_kihieu[ds_kihieu.length-1] + '</option>';
                    }
                    else{
                        option_kihieu += '<option value="'+ ds_kihieu[ds_kihieu.length-1] +'">' + ds_kihieu[ds_kihieu.length-1] + '</option>';
                    }
                }    
            }
        });

        if (da_chon_nhom == false && $(".tr_hp").length != 0) {
            
            // console.log("Thêm đại vì éo chọn được nhóm");
            // console.log(mon_bdfsdfi_trung);
        }
        else{
            // Lưu trữ html của tr chứa học phần cần thêm và dòng thông báo khi hp không có lịch.
            class_mau_can_to = "";
            mau_can_to = "";
            no_tkb = "";

            // Nếu HP không có lịch học thì không gán lớp "can_to_mau".
            if (hp_vua_them[0].THU == '0') {
                mau_can_to = '<tr class="tr_hp">';
                no_tkb = '</br><span id="no_tkb_' + hp_vua_them[0].MAHP + '" class="text-danger">(Liên hệ GV để xếp lịch)</span>'
            } else {
                
                // Tính số màu đã tô.
                class_mau_can_to = Tinh_Mau_Can_To();

                mau_can_to = '<tr class="tr_hp can_to_mau ' + class_mau_can_to + '">';

                no_tkb = '</br><span id="no_tkb_' + hp_vua_them[0].MAHP + '" class="text-danger"></span>'
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
                        <select id="sl_'+ hp_vua_them[0].MAHP +'" onchange="Doi_Ki_hieu(\'' + hp_vua_them[0].MAHP + '\')">' +
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

            // Lấy kí hiệu nhóm HP đã chọn của HP vừa thêm.
            kihieu_nhom_hp = $('#sl_' + hp_vua_them[0].MAHP).children(":selected").text();

            // Điền HP lên thời khóa biểu theo kí hiệu đã chọn.
            dien_tkb(hp_vua_them[0].MAHP, kihieu_nhom_hp, class_mau_can_to);

            // Sắp xếp tăng dần theo sỉ sổ.
            // sortTable();
        }        
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

    for (let index = 0; index < ds_hp_can_luu.length; index++) {
        if (ds_hp_can_luu[index].MAHP == hp_vua_them[0].MAHP) {
            ketqua = true;
            break;
        }
    }
    return ketqua;
}

// Hàm lấy học kì hiện tại.
function LayHKiHienTai() {
    $.ajax({
        type: "POST",
        url: "/lay_hocki_hientai",
        data: {
            _token: token
        },
        success: function (response) {
            hki_hientai = response[0].HOCKI;
            $("#hocki_ht").text(hki_hientai);
        },
        error: function(xhr,err){
            console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
        }
    });
}

// Hàm lấy năm học hiện tại.
function LayNamHocHienTai() {
    $.ajax({
        type: "POST",
        url: "/lay_namhoc_hientai",
        data: {
            _token: token
        },
        success: function (response) {
            namhoc_hientai = response[0].NAMHOC;
            namhoc_array = namhoc_hientai.split('-');
            $("#namhoc_ht").text('20' + namhoc_array[0] + '-20' + namhoc_array[1]);
        },
        error: function(xhr,err){
            console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
        }
    });
}

// Tính thời gian học theo số tiết.
function Tinh_TGian_Hoc(tiet_hoc) {
    switch (tiet_hoc) {
        case "1":
            return "7h 00 sáng";
            break;
        
        case "2":
            return "7h 50 sáng";
            break;

        case "3":
            return "8h 50 sáng";
            break;
        
        case "4":
            return "9h 50 sáng";
            break;

        case "5":
            return "10h 40 sáng";
            break;
        
        case "6":
            return "1h 30 chiều";
            break;

        case "7":
            return "2h 20 chiều";
            break;
        
        case "8":
            return "3h 20 chiều";
            break;
        
        case "9":
            return "4h 10 chiều";
            break;

        case "11":
            return "6h 20 tối";
            break;
        
        case "12":
            return "7h 10 tối";
            break;

        default:
            return "";
            break;
    }
}

function TinhLichCoVan() {
    $.ajax({
        type: "POST",
        url: "/lay_lich_co_van",
        data: {
            _token: token,
            malop: malop_login
        },
        success: function (response) {

            if (response.length != 0) {
                // console.log(response);
                giohoc = Tinh_TGian_Hoc(response[0].TIETBD);
                $("#lich_co_van").text(
                    "Lịch họp cố vấn vào lúc " + giohoc + 
                    " thứ " + response[0].THU + 
                    " tuần " + response[0].TUANHOC);
            }
            else{
                // console.log(response);
                $("#lich_co_van").text("Không có lịch họp cố vấn.");
            }
        },
        error: function(xhr,err){
            console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
        }
    });
}

// Xử lý khi trang tạo tkb vừa load xong.
$(document).ready(function () {

    // Tính học kì và năm học hiện tại, lưu trữ vào biến toàn cục.
    LayHKiHienTai();
    LayNamHocHienTai();

    // Tính và hiển thị lịch họp cố vấn.
    TinhLichCoVan();

    $("#bao_trung_hp").hide();

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

            // Xóa tuần học của học phần.
            $(".tr_tuanhoc_" + mahp_can_xoa).remove();

            // Xóa các buổi thọc đang hiển thị trên thời của khóa biểu của HP cần xóa.
            xoa_buoi_hoc(mahp_can_xoa);

            // Xóa HP trong mảng lưu toàn cục.
            ds_hp.forEach(function(item, index, object) {
                if (item[0].MAHP == mahp_can_xoa) {
                    object.splice(index, 1);
                }
            });

            // Xóa thông tin của lớp HP trong ds HP cần lưu.
            for (let index = 0; index < ds_hp_can_luu.length; index++) {
                if (ds_hp_can_luu[index].MAHP == mahp_can_xoa) {
                    ds_hp_can_luu.splice(index, 1);
                    index--;
                }        
            }
            
            // Kiểm tra số lượng HP còn lại.
            kiem_sluong_hp();
        }
    });

    // Xóa tất cả học phần.
    $("#btn_xoa_all_hp").click(function (e) { 
        e.preventDefault();
        $(".tr_hp").remove();

        // Xóa tuần học của tất cả học phần.
        $(".tr_th").remove();

        ds_hp = [];    
        ds_hp_can_luu = [];
        $("#tr_no_hp").show(0);

        // Xóa tất cả HP trên TKB.
        xoa_all_buoi_hoc();

        // Ẩn thông báo trùng học phần.
        $("#bao_trung_hp").hide();
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