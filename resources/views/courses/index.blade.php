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
          <li class="breadcrumb-item"><a href="javaScript:void();">Khóa học</a></li>
          <li class="breadcrumb-item active" aria-current="page">Quản lý khóa học</li>
        </ol>
      </div>
      <div class="col-sm-3">
        <div class="btn-group float-sm-right">
          <button type="submit" class="btn btn-facebook waves-effect waves-light delete-all" record="courses"><i class="fa fa-minus mr-1"></i>Xóa
            Mục Chọn</button>
          <a role="button" href="{{ url('admin/create/course') }}" class="btn btn-light waves-effect waves-light"><i
              class="fa fa-plus mr-1"></i>
            Tạo</a>
        </div>
      </div>
    </div>
    @include('sweetalert::alert')
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
                    
                    <th>Ảnh</th>
                    <th>Tiêu đề</th>
                    <th>Số lượng bán</th>
                    <th>Ngày tạo</th>
                    <th>Tình Trạng</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($courses as $key => $course)
                  <tr>
                    <td><input type="checkbox" value="{{$course['id']}}" class="sub_ck" data-id="{{$course['id']}}"></td>
                    <td>{{ ++$key }}</td>
                    <td> <img src="{{$course['image']}}" width="100px" height="100px"></td>
                    <td>
                      {{ $course['title'] }}
                    </td>

                    
                    <td>{{ $course['sold'] }} đã bán</td>
                    <td>{{ date('d/m/Y', strtotime($course['created_at'])) }}</td>
                    <td style="font-size: 30px">
                      <center>
                        <a href="{{ url('admin/edit/course/' . $course['id']) }}" style="color:greenyellow"
                          title="Chỉnh sửa khóa học"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;
                        <a href="javascript:void(0)" style="color: red" class="confirmdelete" record="course" recordid="{{$course['id']}}"
                          title="Xóa khóa học"><i class="fa fa-trash"></i></a>
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