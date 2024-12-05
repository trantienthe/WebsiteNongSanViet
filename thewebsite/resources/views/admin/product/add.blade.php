@extends('layouts.admin')

@section('title')
    <title>Add product</title>
@endsection

@section('css')
    <link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('adminn/product/add/add.css') }}" rel="stylesheet" />
@endsection


@section('content')

    <div class="content-wrapper">

    @include('partials.content-header', ['name' => 'product', 'key' => 'Add'])

    <div class="col-md-12">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors -> all() as $errors)
                        <li>{{ $errors }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action ="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Tên sản phẩm</label>
                        <input  type="text"
                                class="form-control" 
                                name = "name"
                                placeholder="Nhập tên sản phẩm"
                        >
                    </div>

                    <div class="form-group">
                        <label>Giá sản phẩm</label>
                        <input  type="text"
                                class="form-control" 
                                name = "price"
                                placeholder="Nhập giá sản phẩm"
                        >
                    </div>

                    <div class="form-group">
                        <label>Số lượng sản phẩm</label>
                        <input  type="text"
                                class="form-control" 
                                name = "product_quantity"
                                placeholder="Nhập số lượng sản phẩm"
                        >
                    </div>

                    <div class="form-group">
                        <label>Ảnh sản phẩm</label>
                        <input  type="file"
                                class="form-control-file" 
                                name = "feature_image_path"
                        >
                    </div>

                    <div class="form-group">
                        <label>Ảnh chi tiết</label>
                        <input  type="file"
                                multiple
                                class="form-control-file" 
                                name = "image_path[]"
                        >
                    </div>
                    
                    
                    <div class="form-group">
                        <label>Chọn danh mục</label>
                        <select class="form-control select2_init" name = "category_id">
                            <option value="">Chọn danh mục</option>
                            {!! $htmlOption !!}
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Nhập tags cho sản phẩm</label>
                        <select name = "tags[]" class="form-control tags_select_choose" multiple="multiple">
                            
                        </select>
                    </div>


                    <div class="form-group">
                        <label>Nhập nội dung</label>
                        <textarea name="contents" class="form-control tinymce_editor_init" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Thêm</button>
                </form>
            </div>
            
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')

    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script src="/path-to-your-tinymce/tinymce.min.js"></script>
    <script src="{{ asset('adminn/product/add/add.js') }}"></script>

@endsection