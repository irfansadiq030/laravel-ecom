@extends('admin.layout.layout')
@section('page_title','Add Slide')

@section('content')

<div class="components-preview wide-md mx-auto">
    <div class="nk-block-head nk-block-head-lg wide-sm">
        <div class="nk-block-head-content">
            <div class="nk-block-head-sub"><a class="back-to" href="categories"><em class="icon ni ni-arrow-left"></em><span>Categories</span></a></div>
            <h3 class="nk-block-title fw-normal">Add New Slide</h3>
            <div class="nk-block-des">
                <p class="lead">Add New Slide to Homepage</p>
            </div>
        </div>
    </div><!-- .nk-block -->
    <div class="nk-block nk-block-lg">
        <!-- <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h4 class="title nk-block-title">Edit Basic information</h4>
                <div class="nk-block-des">
                    <p>Below example helps you to build your own form nice way.</p>
                </div>
            </div>
        </div> -->
        <div class="row g-gs">
            <div class="col-lg-12">
                <div class="card h-100">
                    <div class="card-inner">
                        <div class="card-head">
                            <h5 class="card-title">Slide info</h5>
                        </div>
                        @if ($errors->any())
                        <div class="alert alert-pro alert-danger alert-dismissible">
                            <div class="alert-text">
                                <h6>Errors!</h6>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li class="text-danger">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <button class="close" data-dismiss="alert"></button>
                        </div>
                        @endif

                        <form action="{{ route('create-slider') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label class="form-label" for="full-name">Slide Title</label>
                                    <div class="form-control-wrap">
                                        <input name="slide_title" type="text" class="form-control" id="slide_title">
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="form-label" for="sub_heading">Sub Heading</label>
                                    <div class="form-control-wrap">
                                        <input name="sub_heading" type="text" class="form-control" id="sub_heading">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="cat_slug">Button Link</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon3">https://</span>
                                        </div>
                                        <input name="slide_btn_link" type="url" class="form-control" id="basic-url">
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="form-group">
                                        <label class="form-label">Status</label>
                                        <div class="form-control-wrap">
                                            <select name="status" class="form-select select2-hidden-accessible" data-select2-id="3" tabindex="-1" aria-hidden="true">
                                                <option value="1" data-select2-id="5">Active</option>
                                                <option value="0" data-select2-id="18">Draft</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="upload-zone">
                                    <div class="dz-message" data-dz-message>
                                        <span class="dz-message-text">Drag and drop file</span>
                                        <span class="dz-message-or">or</span>
                                        <button class="btn btn-primary">SELECT</button>
                                    </div>
                                </div>
                                <input type="hidden" id="temp_img_id" name="img_id">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary">Save Slide</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .nk-block -->

</div>

@endsection

@section('custom-js')


@endsection