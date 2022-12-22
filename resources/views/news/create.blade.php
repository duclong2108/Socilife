@extends('layouts.create_edit')
@section('content')
<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumb-->
    <div class="row pt-2 pb-2">
      <div class="col-sm-9">
        <h4 class="page-title">Tạo</h4>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="javaScript:void();">Trang Chủ</a></li>
          <li class="breadcrumb-item"><a href="javaScript:void();">Cấu Hình</a></li>
          <li class="breadcrumb-item active" aria-current="page">Tạo tin tức</li>
        </ol>
      </div>

    </div>
    <!-- End Breadcrumb-->
    <form action="{{ url('admin/create/task') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header text-uppercase">Các Dữ Liệu Tin tức</div>
            <div class="card-body">
              <label>Tiêu Đề</label>
              <input type="text" name="title" required class="form-control">
              <hr>

              <label>Ảnh</label>
              <input name="image" onchange="loadfile(event)" type="file" class="form-control">
              <div id="preview"></div>
              <hr>
              <label>Mô Tả</label>
              <textarea id="edittor1" name="description">
                                    </textarea>
              <hr>
              <button type="submit" class="btn btn-gradient-primary">Tạo</button>
            </div>
          </div>
        </div>
      </div>
      <!--End Row-->
      <!--End Row-->


    </form>


    <!--End Row-->



    <!--End Row-->
    <!--start overlay-->
    <div class="overlay"></div>
    <!--end overlay-->
  </div>
  <!-- End container-fluid-->

</div>
@endsection