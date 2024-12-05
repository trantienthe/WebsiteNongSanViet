@extends('layouts.admin')

@section('title')
    <title>Trang chủ</title>
@endsection

@section('content')

    <div class="content-wrapper">

    @include('partials.content-header', ['name' => 'menus', 'key' => 'Add'])

    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action ="{{ route('menus.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Tên Menu</label>
                        <input  type="text"
                                class="form-control" 
                                name = "name"
                                placeholder="Nhập tên menu"
                        >
                    </div>
                    
                    <div class="form-group">
                        <label>Chọn menu cha</label>
                        <select class="form-control" name = "parent_id">
                            <option value="0">Chọn menu cha</option>
                           {!! $optionSelect !!}
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Thêm</button>
                </form>
            </div>
            
        </div>
      </div>
    </div>
  </div>
@endsection

