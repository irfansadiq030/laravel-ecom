@extends('admin.layout.layout')
@section('page_title','Add Product')

@section('content')

<div class="components-preview wide-md mx-auto">
    <div class="nk-block-head nk-block-head-lg wide-sm">
        <div class="nk-block-head-content">
            <div class="nk-block-head-sub"><a class="back-to" href="categories"><em class="icon ni ni-arrow-left"></em><span>Categories</span></a></div>
            <h4 class="nk-block-title fw-normal">Add New Product</h4>
            <div class="nk-block-des">
                <p class="lead">Add a New Product to Organize and Categorize Your Content</p>
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
            <div class="col-sm-8">
                <div class="card h-100">
                    <div class="card-inner">
                        <div class="card-head">
                            <h5 class="card-title">Product Info</h5>
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

                        <form action="{{ route('create-product') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label class="form-label" for="full-name">Product Title</label>
                                    <div class="form-control-wrap">
                                        <input name="product_title" type="text" class="form-control" id="category_title">
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="form-label" for="cat_slug">Slug</label>
                                    <div class="form-control-wrap">
                                        <input name="slug" type="text" class="form-control" id="cat_slug">
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="product_desc">Description</label>
                                    <div class="form-group">

                                        <div class="form-control-wrap">
                                            <textarea name="description" type="text" class="form-control" id="product_desc" rows="1"> </textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 mb-3">
                                    <div class="form-group">
                                        <label class="form-label">Size</label>
                                        <div class="form-control-wrap">
                                            <select name="size" class="form-select select2-hidden-accessible" data-select2-id="5" tabindex="-1" aria-hidden="true">
                                                <option value="1" data-select1-id="5">Medium</option>
                                                <option value="0" data-select1-id="18">Large</option>
                                                <option value="2" data-select1-id="2">Small</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="form-group">
                                        <label class="form-label">Color</label>
                                        <div class="form-control-wrap">
                                            <select name="color" class="form-select select2-hidden-accessible" data-select2-id="6" tabindex="-1" aria-hidden="true">
                                                <option value="red">Red</option>
                                                <option value="green">Green</option>
                                                <option value="blue">Blue</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="product_desc">Media</label>
                                <div class="upload-zone">
                                    <div class="dz-message" data-dz-message>
                                        <span class="dz-message-text">Drag and drop file</span>
                                        <span class="dz-message-or">or</span>
                                        <button class="btn btn-outline-primary">SELECT</button>
                                    </div>
                                </div>
                                <input type="hidden" id="temp_img_id" name="img_id">
                            </div>
                            <!-- <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary">Save Informations</button>
                            </div> -->
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card h-100">
                    <div class="card-inner">
                        <div class="card-head">
                            <h5 class="card-title">Product Info</h5>
                        </div>
                        <div class="row mb-3">

                            <div class="col-12 mb-3">
                                <label class="form-label" for="selling_price">Selling Price</label>
                                <div class="form-control-wrap">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">$</span>
                                        </div>
                                        <input name="selling_price" type="number" class="form-control" id="selling_price">
                                    </div>
                                </div>
                                <!-- <div class="form-control-wrap">
                                    <input name="selling_price" type="number" class="form-control" id="selling_price">
                                </div> -->
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label" for="quantity">Quantity</label>
                                <div class="form-control-wrap">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Qty</span>
                                        </div>
                                        <input name="quantity" type="number" class="form-control" id="quantity">
                                    </div>
                                </div>
                                <!-- <div class="form-control-wrap">
                                    <input name="quantity" type="number" class="form-control" id="quantity">
                                </div> -->
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Category</label>
                                    <div class="form-control-wrap">
                                        <select id="category" name="category" class="form-select select2-hidden-accessible" data-select2-id="12" tabindex="-1" aria-hidden="true">
                                            <option>Select Category</option>
                                            @if (count($categories) >= 1)
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Sub Category</label>
                                    <div class="form-control-wrap">
                                        <select id="subcategory" name="sub_category" class="form-select select2-hidden-accessible" data-select2-id="120" tabindex="-1" aria-hidden="true">

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <div class="form-control-wrap">
                                        <select name="product_status" class="form-select select2-hidden-accessible" data-select2-id="98" tabindex="-1" aria-hidden="true">
                                            <option value="active">Active</option>
                                            <option value="draft">Draft</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary">Save Product</button>
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
        $("#category_title").change(function() {
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

        // Category change
        $("#category").change(function() {

            let selectedCategory = $(this).val();
            $.ajax({
                url: 'fetch-sub-categories',
                method: 'post',
                data: {
                    'category_id': selectedCategory
                },
                dataType: 'Json',
                success: function(response) {
                    let subcategory = $('#subcategory');
                    if (response.data.length > 0) {
                        subcategory.empty();
                        response.data.forEach(function(item) {
                            // Access the properties of each item in the data array
                            var id = item.id;
                            var title = item.title;
                            var slug = item.slug;
                            var description = item.description;
                            console.log(item.title)

                            subcategory.append(`<option value="${item.id}">${item.title}</option>`);
                        });
                    } else {
                        subcategory.empty();
                    }
                }
            })
        })

        // Summernote Init
        $('#product_desc').summernote({
            placeholder: 'Write Product Description Here..',
            tabsize: 2,
            height: 250
        });

    })
</script>

@endsection