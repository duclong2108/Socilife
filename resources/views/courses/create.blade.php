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
                    <li class="breadcrumb-item active" aria-current="page">Tạo Khóa Học</li>
                </ol>
            </div>

        </div>
        @include('sweetalert::alert')
        <!-- End Breadcrumb-->
        <form action="{{ url('admin/create/course') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header text-uppercase">Các Dữ Liệu Khóa Học</div>
                        <div class="card-body">
                            <label>Tiêu Đề</label>
                            <input type="text" name="title" required class="form-control">
                            <hr>
                            <label>Ảnh</label>
                            <div class="input-group">
                                <a id="lfm2" data-input="thumbnail2" data-preview="holder2" class="btn btn-primary text-white">
                                    <i class="fa fa-picture-o"></i> Choose Image
                                </a>
                                <input id="thumbnail2" class="form-control" type="text" name="image" readonly required>
                            </div>
                            <div id="holder2"></div>
                            <hr>
                            <label>Video</label>
                            <div class="input-group">
                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                                    <i class="fa fa-file-video-o"></i> Choose Video
                                </a>
                                <input id="thumbnail" class="form-control" type="text" name="video[]" multiple readonly>
                            </div>
                            <div id="holder"></div>
                            <hr>
                            <label>Mô Tả</label>
                            <textarea id="editor" name="description" required>
                                    </textarea>
                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <label>Tiền (VND)</label>
                                    <input type="number" min="1" class="form-control price_original" required name="price">
                                </div>
                                <div class="col-6">
                                    <label>Tiền sau giảm giá (VND)</label>
                                    <input type="number" readonly min="1" class="form-control price_reduce" name="price_reduce">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <label>Tiền (Xu)</label>
                                    <input type="number" min="1" class="form-control coin_original" required name="coin">
                                </div>
                                <div class="col-6">
                                    <label>Tiền sau giảm giá (Xu)</label>
                                    <input type="number" min="1" class="form-control coin_reduce" readonly name="coin_reduce">
                                </div>
                            </div>
                            <hr>
                            <label>Giảm giá (%)</label>
                            <input type="text" class="form-control discount" name="discount">
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