@extends('admin.layout.master')
@section('title')
    Create User
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User
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
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Username</label>
                            <input class="form-control" name="name" placeholder="Please Enter Username" />
                            @if (count($errors) > 0)
                                <small class="text-danger">
                                    @foreach ($errors->get('name') as $message)
                                        {{ $message }} <br>
                                    @endforeach
                                </small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password"
                                placeholder="Please Enter Password" />
                            @if (count($errors) > 0)
                                <small class="text-danger">
                                    @foreach ($errors->get('password') as $message)
                                        {{ $message }} <br>
                                    @endforeach
                                </small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>RePassword</label>
                            <input type="password" class="form-control" name="repassword"
                                placeholder="Please Enter RePassword" />
                            @if (count($errors) > 0)
                                <small class="text-danger">
                                    @foreach ($errors->get('repassword') as $message)
                                        {{ $message }} <br>
                                    @endforeach
                                </small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Please Enter Email" />
                            @if (count($errors) > 0)
                                <small class="text-danger">
                                    @foreach ($errors->get('email') as $message)
                                        {{ $message }} <br>
                                    @endforeach
                                </small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Avartar</label>
                            <input type="file" name="avatar" class="dropify" data-allowed-file-extensions="jpg png jpeg"
                                data-max-file-size="2M">
                            @if (count($errors) > 0)
                                <small class="text-danger">
                                    @foreach ($errors->get('avatar') as $message)
                                        {{ $message }} <br>
                                    @endforeach
                                </small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <label class="radio-inline">
                                <input name="is_admin" value="1" type="radio">Admin
                            </label>
                            <label class="radio-inline">
                                <input name="is_admin" value="0" checked type="radio">User
                            </label>
                        </div>
                        <button type="submit" class="btn btn-default">User Add</button>
                        <button type="reset" class="btn btn-default">Reset</button>
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
