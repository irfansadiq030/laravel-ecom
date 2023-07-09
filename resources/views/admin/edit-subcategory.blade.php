@extends('admin.layout.layout')
@section('page_title','Add Category')

@section('content')

<div class="components-preview wide-md mx-auto">
    <div class="nk-block-head nk-block-head-lg wide-sm">
        <div class="nk-block-head-content">
            <div class="nk-block-head-sub"><a class="back-to" href="{{ url()->previous() }}"><em class="icon ni ni-arrow-left"></em><span>Sub Categories</span></a></div>
            <h3 class="nk-block-title fw-normal">Add New Sub Category</h3>
            <div class="nk-block-des">
                <p class="lead">Create a New Category to Organize and Categorize Your Content</p>
            </div>
        </div>
    </div><!-- .nk-block -->
    <div class="nk-block nk-block-lg">
        <!-- <a href="{{ url()->previous() }}" class="btn btn-info">Back</a> -->
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
                            <h5 class="card-title">Sub Category Info</h5>
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

                        <form action="{{ route('update-subcategory') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label class="form-label" for="full-name">Sub Category Title</label>
                                    <div class="form-control-wrap">
                                        <input name="subcategory_title" value="{{ $subcategory_data->title }}" type="text" class="form-control" id="subcategory_title">
                                        <input name="subcategory_id" type="text" value="{{ $subcategory_data->id }}">
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="form-label" for="cat_slug">Slug</label>
                                    <div class="form-control-wrap">
                                        <input name="slug" value="{{ $subcategory_data->slug }}" type="text" class="form-control" id="cat_slug">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label">Main Category</label>
                                        <div class="form-control-wrap">
                                            <select name="main_category_id" class="form-select select2-hidden-accessible">
                                                @if (count($category_data) >= 1)
                                                @foreach ($category_data as $category)
                                                <option {{ $category->id === $subcategory_data->main_category_id ? 'selected' :'' }} value="{{ $category->id }}">{{ $category->title }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label">Status</label>
                                        <div class="form-control-wrap">
                                            <select name="subcategory_status" class="form-select select2-hidden-accessible">
                                                <option {{ $subcategory_data->status==1 ? 'selected' : '' }} value="1">Active</option>
                                                <option {{ $subcategory_data->status==0 ? 'selected' : '' }} value="0">Draft</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="form-label" for="email-address">Description</label>
                                <div class="form-control-wrap">
                                    <textarea name="description" type="text" class="form-control" id="email-address" rows="1"> {{ $subcategory_data->description }}</textarea>
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
                                <input type="text" value="{{ $subcategory_data->img}}" id="temp_img_id" name="img_id">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary">Save Informations</button>
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

<script>
    $(document).ready(function() {
        $("#subcategory_title").change(function() {
            // alert($(this).val());
            // const element = $(this);
            $.ajax({
                url: "{{ route('get-slug')}}",
                type: 'get',
                data: {
                    category_title: $(this).val()
                },
                dataType: 'json',
                success: function(response) {
                    if (response['status']) {
                        $("#cat_slug").val(response['slug']);
                    } else {
                        alert();
                    }
                }

            });
        });

    })
</script>

@endsection