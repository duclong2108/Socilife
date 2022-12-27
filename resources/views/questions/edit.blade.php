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
                    <li class="breadcrumb-item active" aria-current="page">Chỉnh Sửa Câu Hỏi</li>
                </ol>
            </div>

        </div>
        @include('sweetalert::alert')
        <!-- End Breadcrumb-->
        <form action="{{ url('admin/edit/question/'.$question_id.'/survey/'.$id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header text-uppercase">Các Dữ Liệu Câu Hỏi</div>
                        <div class="card-body">
                            <label>Câu hỏi</label>
                            <input type="text" name="question" value="{{$question['question']}}" required class="form-control">
                            <hr>
                            <label>Ảnh</label>
                            <div class="input-group">
                                <a id="lfm2" data-input="thumbnail2" data-preview="holder2" class="btn btn-primary text-white">
                                    <i class="fa fa-picture-o"></i> Choose Image
                                </a>
                                <input id="thumbnail2" class="form-control" type="text" value="{{$question['image']}}" name="image" readonly required>
                            </div>
                            <div id="holder2">
                                <input type="image" src="{{$question['image']}}" width="100px" height="100px">
                            </div>
                            <hr>
                            @foreach(explode("|||", $question['answer']) as $key=>$answer)
                            @if($key==0)
                            <div class="row">
                                <div class="col-11">
                                    <label>Câu Trả Lời</label>
                                    <input type="text" required name="answer[]" value="{{$answer}}" class="form-control" required>
                                </div>
                            </div>
                            <hr>
                            @elseif($key==1)
                            <div class="row">
                                <div class="col-11">
                                    <label>Câu Trả Lời</label>
                                    <input type="text" required name="answer[]" value="{{$answer}}" class="form-control" required>
                                </div>
                                <div class="col-1">
                                    <a href="javascript:void(0)" style="position: relative;top:40%" class="create-question"><i class="fa fa-3x fa-plus-circle"></i></a>
                                </div>
                            </div>
                            <hr>
                            @elseif($key>1)
                            <!-- <div id="new-question"> -->
                                <div class="newcreate">
                                    <div class="row">
                                        <div class="col-11">
                                            <label>Câu Trả Lời</label>
                                            <input type="text" required name="answer[]" value="{{$answer}}" class="form-control" required>
                                        </div>
                                        <div class="col-1">
                                            <a href="javascript:void(0)" style="position: relative;top:40%" class="minus-question"><i class="fa fa-3x fa-minus-circle"></i></a>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            <!-- </div> -->
                            @endif
                            @endforeach
                            <div id="new-question">
                            </div>
                            <button type="submit" class="btn btn-gradient-primary">Chỉnh Sửa</button>
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