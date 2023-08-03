@extends('admin.layout.master')
@section('title')
    Edit Post
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Post
                        <small>Edit</small>
                    </h1>
                    @if (session('alert'))
                        <div class="alert alert-danger">
                            {{ session('alert') }}
                        </div>
                    @endif
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <label>Title</label>
                            <input class="form-control" name="title" placeholder="Please Enter Title"
                                value="{{ $post->title }}" />
                            @if (count($errors) > 0)
                                <small class="text-danger">
                                    @foreach ($errors->get('title') as $message)
                                        {{ $message }} <br>
                                    @endforeach
                                </small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" rows="3" name="desc">{{ $post->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Content</label>
                            <textarea class="form-control" id="content" rows="3" name="content">{{ $post->content }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Images</label>
                            <input type="file" name="thumbnail" class="dropify"
                                data-allowed-file-extensions="jpg png jpeg" data-max-file-size="2M"
                                data-default-file="{{ asset('/public/images/' . $post->thumbnail) }}">
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control" name="category_id">
                                <option value="0">Please Choose Category</option>
                                @foreach ($data_select as $key => $value)
                                    <option value="{{ $key }}" @if ($post->category_id == $key) selected @endif>
                                        {{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="highlight" id="highlight"
                                    value="1" @if ($post->highlight === 1) checked @endif>
                                <label class="form-check-label" for="highlight">
                                    Highlight
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="status" id="status" value="1"
                                    @if ($post->status === 1) checked @endif>
                                <label class="form-check-label" for="status">
                                    Status
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-default">Update</button>
                        <form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#content').summernote({
                height: 300,
            });
            $('.dropify').dropify({
                messages: {
                    'default': 'Drag and drop a file here or click',
                    'replace': 'Drag and drop or click to replace',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong happended.'
                },
                error: {
                    'fileSize': 'The file size is too big > 2M.',
                    'imageFormat': 'The image format is not allowed only jpg png jpeg.'
                }
            });
        });
    </script>
@endsection
