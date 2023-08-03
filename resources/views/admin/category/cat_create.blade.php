@extends('admin.layout.master')
@section('title')
    Create Category
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Category
                        <small>Add</small>
                    </h1>
                    @if (session('alert'))
                        <div class="alert alert-danger">
                            {{ session('alert') }}
                        </div>
                    @endif
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    <form action="" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Category Parent</label>
                            <select class="form-control" name="parent_id">
                                <option value="0">Please Choose Category</option>
                                @foreach ($data_select as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Category Name</label>
                            <input class="form-control" name="name" placeholder="Please Enter Category Name"
                                value="{{ old('name') }}" />
                            @if (count($errors) > 0)
                                <small class="text-danger">
                                    @foreach ($errors->get('name') as $message)
                                        {{ $message }} <br>
                                    @endforeach
                                </small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Category Description</label>
                            <textarea class="form-control" name="desc" value="{{ old('desc') }}" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Category Order</label>
                            <input type="number" class="form-control" name="cat_order" value="1000" min="0"
                                placeholder="Please Enter Category Order" />
                        </div>
                        <button type="submit" class="btn btn-default">Category Add</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
