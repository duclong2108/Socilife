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
          <li class="breadcrumb-item"><a href="javaScript:void();">Tin tức</a></li>
          <li class="breadcrumb-item active" aria-current="page">Quản lý tin tức</li>
        </ol>
      </div>
      <div class="col-sm-3">
        <div class="btn-group float-sm-right">
          <button type="submit" class="btn btn-facebook waves-effect waves-light"><i class="fa fa-minus mr-1"></i>Xóa
            Mục Chọn</button>
          <a role="button" href="{{ url('admin/create/course') }}" class="btn btn-light waves-effect waves-light"><i
              class="fa fa-plus mr-1"></i>
            Tạo</a>
        </div>
      </div>
    </div>
    @if (Session::has('error_message'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>{{ Session::get('error_message') }}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @elseif(Session::has('success_message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>{{ Session::get('success_message') }}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header"><i class="fa fa-table"></i> Dữ Liệu Bảng Quảng Cáo</div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="example" class="table table-bordered">
                <thead>
                  <tr>
                    <th><input type="checkbox" class="select-all"></th>
                    <th>#</th>
                    <th>Tiêu đề</th>
                    <th>Ảnh</th>

                    <th>Ngày tạo</th>
                    <th>Tình Trạng</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($news as $key => $news)
                  <tr>
                    <td><input type="checkbox" value="{{$news['id']}}"></td>
                    <td>{{ ++$key }}</td>
                    <td>
                      {{ $news['title'] }}
                    </td>

                    <td> <img src="{{$news['image']}}" width="100px" height="100px"></td>

                    <td>{{ $news['created_at'] }}</td>
                    <td style="font-size: 20px">
                      <center>
                        <a href="{{ url('admin/edit/course/' . $news['id']) }}" style="color: antiquewhite"
                          title="Chỉnh sửa tin tức"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;
                        <a href="{{ url('admin/delete/course/' . $news['id']) }}" style="color: red"
                          title="Xóa tin tức"><i class="fa fa-trash"></i></a>
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