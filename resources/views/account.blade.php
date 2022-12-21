<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from codervent.com/dashtremev3/pages-user-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 29 Jul 2020 09:42:03 GMT -->

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Account</title>
  <base href="{{ asset('') }}" />
  <!-- loader-->
  <link href="assets/css/pace.min.css" rel="stylesheet" />
  <!--favicon-->
  <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
  <!-- simplebar CSS-->
  <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
  <!-- Bootstrap core CSS-->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

  <!-- animate CSS-->
  <link href="assets/css/animate.css" rel="stylesheet" type="text/css" />
  <!-- Icons CSS-->
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
  <!-- Metismenu CSS-->
  <link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
  <!-- Custom Style-->
  <link href="assets/css/app-style.css" rel="stylesheet" />

</head>

<body class="bg-theme bg-theme1">

  <!-- Start wrapper-->
  <div id="wrapper">

    <!--Start sidebar-wrapper-->
    @include('layouts.sidebar')
    <!--End sidebar-wrapper-->

    <!--Start topbar header-->
    @include('layouts.header')
    <!--End topbar header-->

    <div class="clearfix"></div>

    <div class="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumb-->

        <!-- End Breadcrumb-->

        <div class="row">
          <div class="col-lg-12">
            @if(Session::has('error_message'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <i class="bi-check-circle-fill"></i>
              <strong>{{Session::get('error_message')}}</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @elseif(Session::has('success_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="bi-exclamation-triangle-fill"></i>
              <strong>{{Session::get('success_message')}}</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif
            <div class="card">
              <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
                  <li class="nav-item">
                    <a href="javascript:void();" data-target="#profile" data-toggle="pill" class="nav-link active"><i class="icon-user"></i> <span class="hidden-xs">Thông tin</span></a>
                  </li>
                </ul>
                <div class="tab-content p-3">
                  <div class="tab-pane active" id="edit">
                    <form action="{{url('/admin/account')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Email</label>
                        <div class="col-lg-9">
                          <input class="form-control" name="email" required type="email" value="{{Auth::guard('admin')->user()->email}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Họ và tên</label>
                        <div class="col-lg-9">
                          <input class="form-control" name="name" value="{{Auth::guard('admin')->user()->name}}" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Ảnh</label>
                        <div class="col-lg-9">
                          <input type="file" class="form-control" id="customFile" value="{{Auth::guard('admin')->user()->image}}" name="image" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Mật khẩu</label>
                        <div class="col-lg-9">
                          <input class="form-control" type="password" name="password">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Nhập lại mật khẩu</label>
                        <div class="col-lg-9">
                          <input class="form-control" type="password" name="confirm_password">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label"></label>
                        <div class="col-lg-9">
                          <input type="reset" class="btn btn-secondary" value="Xóa">
                          <input type="submit" class="btn btn-primary" value="Lưu">
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!--start overlay-->
        <div class="overlay"></div>
        <!--end overlay-->
      </div>
      <!-- End container-fluid-->
    </div>
    <!--End content-wrapper-->
    <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->

    <!--Start footer-->

    <!--End footer-->

    <!--start color switcher-->

    <!--end color switcher-->

  </div>
  <!--End wrapper-->


  <!-- Bootstrap core JavaScript-->

  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <!-- simplebar js -->
  <script src="assets/plugins/simplebar/js/simplebar.js"></script>
  <!-- Metismenu js -->
  <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>

  <!-- Custom scripts -->
  <script src="assets/js/app-script.js"></script>

</body>

<!-- Mirrored from codervent.com/dashtremev3/pages-user-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 29 Jul 2020 09:42:04 GMT -->

</html>