{{--  Mở rộng cho trang admin  --}}
@extends('admin')

{{--  Đặt title webpage  --}}
@section('title', 'Xếp thời khóa biểu')

{{--  Phần nội dung sẽ dẫn vào trang admin  --}}
@section('noidung')
    <div class="container-fluid">
        
        <div class="row">
            
            {{--  Phần chọn lớp học phần  --}}
            <div class="col-xs-12 col-lg-4 col-lg-push-8">

                <h3>Học phần</h3>

                <div class="btn-group">
                        <button type="button" class="btn btn-success">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            Thêm HP
                        </button>
    
                        <button type="button" class="btn btn-primary">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            Lưu TKB
                        </button>
    
                        <button type="button" class="btn btn-danger">
                            <i class="fa fa-times" aria-hidden="true"></i>
                            Xóa tất cả HP
                        </button>                                      
                </div>
                
                
                {{--  Bảng chọn lớp học phần  --}}
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="info">
                                <th>Mã HP</th>
                                <th>Tên HP</th>
                                <th>Ký hiệu</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            {{--  Dòng hiển thị khi chưa có lớp học phần được chọn  --}}
                            <tr>
                                <td colspan="4" class="text-center"><b><i>
                                    Chưa có lớp HP nào được chọn
                                </i></b>                                    
                                </td>
                            </tr>

                            {{--  Dòng hiển thị khi đã có lớp học phần  --}}
                            <tr>
                                <td>
                                    NS114
                                </td>
                                <td>
                                    Kỹ thuật các quá trình sinh học trong chế biến thực phẩm
                                </td>
                                <td>
                                    <select name="" id="" required="required">
                                        <option value="" selected>01</option>
                                        <option value="">02</option>
                                        <option value="">03</option>
                                    </select>
                                    
                                </td>
                                <td>
                                    <button type="button" class="btn btn-large btn-block btn-danger">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
            </div>

            {{--  Phần minh họa thời khóa biểu khi thêm lớp học phần  --}}
            <div class="col-xs-12 col-lg-8 col-lg-pull-4">

                <h3 class="text-center">
                    Thời khóa biểu minh họa
                </h3>

                {{--  Bảng thể hiện thời khóa biểu  --}}
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-condensed">
                        <thead>
                            <tr class="info">
                                <th></th>
                                <th>Thứ 2</th>
                                <th>Thứ 3</th>
                                <th>Thứ 4</th>
                                <th>Thứ 5</th>
                                <th>Thứ 6</th>
                                <th>Thứ 7</th>                   
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    Kỹ thuật các quá trình sinh học trong chế biến thực phẩm (103/NN)
                                </td>
                                <td>Kỹ thuật các quá trình sinh học trong chế biến thực phẩm (103/NN)</td>
                                <td></td>
                                <td>Kỹ thuật các quá trình sinh học trong chế biến thực phẩm (103/NN)</td>
                                <td></td>
                                <td>Kỹ thuật các quá trình sinh học trong chế biến thực phẩm (103/NN)</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="7"></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="7"></td>
                            </tr>
                            <tr>
                                <td>11</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>12</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        
    </div>   
@endsection