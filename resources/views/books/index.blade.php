@extends('layouts.table')
@section('content')

<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumb-->
    <div class="row pt-2 pb-2">
      <div class="col-sm-9">
        <h4 class="page-title">Dữ Liệu Bảng</h4>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="javaScript:void();">Trang Chủ</a></li>
          <li class="breadcrumb-item"><a href="javaScript:void();">Sách</a></li>
          <li class="breadcrumb-item active" aria-current="page">Quản lý sách</li>
        </ol>
      </div>
      <div class="col-sm-3">
        <div class="btn-group float-sm-right">
          <button type="submit" class="btn btn-facebook waves-effect waves-light delete-all" record="books"><i class="fa fa-minus mr-1"></i>Xóa
            Mục Chọn</button>
          <a role="button" href="{{ url('admin/create/book') }}" class="btn btn-light waves-effect waves-light"><i
              class="fa fa-plus mr-1"></i>
            Tạo</a>
        </div>
      </div>
    </div>
    @include('sweetalert::alert')
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header"><i class="fa fa-table"></i> Dữ Liệu Bảng Sách</div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="example" class="table table-bordered">
                <thead>
                  <tr>
                    <th><input type="checkbox" class="select-all"></th>
                    <th>#</th>
                    <th>Ảnh</th>
                    <th>Tiêu đề</th>
                    <th>Số lượng bán</th>
                    <th>Tình Trạng</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($books as $key => $book)
                  <tr>
                    <td><input type="checkbox" value="{{$book['id']}}" class="sub_ck" data-id="{{$book['id']}}"></td>
                    <td>{{ ++$key }}</td>
                    <td> <img src="{{$book['image']}}" width="100px" height="100px"></td>
                    <td>
                      {{ $book['title'] }}
                    </td>

                    
                    <td>{{ $book['sold'] }} đã bán</td>
                    <td style="font-size: 30px">
                      <center>
                      <a href="{{ url('admin/chapters/book/' . $book['id']) }}" style="color:aqua"
                          title="Xem các chương sách"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;&nbsp;
                        <a href="{{ url('admin/edit/book/' . $book['id']) }}" style="color:greenyellow"
                          title="Chỉnh sửa sách"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;
                        <a href="javascript:void(0)" style="color: red" class="confirmdelete" record="book" recordid="{{$book['id']}}"
                          title="Xóa sách"><i class="fa fa-trash"></i></a>
                      </center>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div><!-- End Row-->
    <!--start overlay-->
    <div class="overlay"></div>
    <!--end overlay-->
  </div>
  <!-- End container-fluid-->

</div>

@endsection