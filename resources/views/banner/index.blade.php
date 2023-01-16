@extends('layouts.create_edit')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <h4 class="page-title">Cập Nhật</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javaScript:void();">Trang Chủ</a></li>
                    <li class="breadcrumb-item"><a href="javaScript:void();">Cấu Hình</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ảnh Bìa</li>
                </ol>
            </div>

        </div>
        @include('sweetalert::alert')
        <!-- End Breadcrumb-->
        <form action="{{ url('admin/banner') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header text-uppercase">Dữ Liệu Ảnh Bìa</div>
                        <div class="card-body">


                            <input type="hidden" value="{{count(explode("|||", $banner['banner_image']))}}" class="slg_banner">
                            @foreach(explode("|||", $banner['banner_image']) as $key=>$image)
                            @if($key==0)
                            <div class="row">
                                <div class="col-6">
                                    <label>Ảnh Bìa Trang Chủ</label>
                                    <div class="input-group">
                                        <a id="lfm{{$key}}" data-input="thumbnail{{$key}}" data-preview="holder{{$key}}" class="btn btn-primary text-white">
                                            <i class="fa fa-picture-o"></i> Choose Image
                                        </a>
                                        <input id="thumbnail{{$key}}" class="form-control" value="{{$image}}" type="text" name="banner_image[]" readonly required>
                                    </div>
                                    <div id="holder{{$key}}">
                                        <img src="{{$image}}" width="100" height="100">
                                    </div>
                                </div>
                                <div class="col-5">
                                    <label>Link</label>
                                    <input type="text" class="form-control" required name="banner_link[]" value="{{explode("|||", $banner['banner_link'])[$key]}}">
                                </div>
                                <div class="col-1">
                                    <a href="javascript:void(0)" style="position: relative;top:40%" class="create-banner"><i class="fa fa-3x fa-plus-circle"></i></a>
                                </div>
                            </div>

                            <hr>
                            @elseif($key>0)
                            <div class="newcreate">
                                <div class="row">
                                    <div class="col-6">
                                        <label>Ảnh Bìa Trang Chủ</label>
                                        <div class="input-group">
                                            <a id="lfm{{$key}}" data-input="thumbnail{{$key}}" data-preview="holder{{$key}}" class="btn btn-primary text-white">
                                                <i class="fa fa-picture-o"></i> Choose Image
                                            </a>
                                            <input id="thumbnail{{$key}}" class="form-control" value="{{$image}}" type="text" name="banner_image[]" readonly required>
                                        </div>
                                        <div id="holder{{$key}}">
                                            <img src="{{$image}}" width="100" height="100">
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <label>Link</label>
                                        <input type="text" class="form-control" required name="banner_link[]" value="{{explode("|||", $banner['banner_link'])[$key]}}">
                                    </div>
                                    <div class="col-1">
                                        <a href="javascript:void(0)" style="position: relative;top:40%" class="minus-banner"><i class="fa fa-3x fa-minus-circle"></i></a>
                                    </div>
                                </div>

                                <hr>
                            </div>
                            @endif

                            @endforeach
                            <div id="new-banner">

                            </div>
                            <button type="submit" class="btn btn-gradient-primary">Cập Nhật</button>
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
@push('scripts')
    <script>
        $(document).ready(function(){
            var sl=$('.slg_banner').val();
            for(i=0; i<sl; ++i){
                var lfm = function(id, type, options) {
            let button = document.getElementById(id);

            button.addEventListener('click', function() {
                var route_prefix = (options && options.prefix) ? options.prefix : 'admin/laravel-filemanager';
                var target_input = document.getElementById(button.getAttribute('data-input'));
                var target_preview = document.getElementById(button.getAttribute('data-preview'));

                window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=1200,height=600');
                window.SetUrl = function(items) {
                    var file_path = items.map(function(item) {
                        return item.url;
                    }).join(',');

                    // set the value of the desired input to image url
                    target_input.value = file_path;
                    target_input.dispatchEvent(new Event('change'));

                    // clear previous preview
                    target_preview.innerHtml = '';

                    // set or change the preview image src
                    items.forEach(function(item) {
                        let img = document.createElement('img')
                        img.setAttribute('style', 'height: 5rem')
                        img.setAttribute('src', item.thumb_url)
                        target_preview.appendChild(img);
                    });

                    // trigger change event
                    target_preview.dispatchEvent(new Event('change'));
                };
            });
        };

        lfm(`lfm`+i+``, 'file', {
            prefix: 'admin/laravel-filemanager'
        });
            }
        })
    </script>
@endpush