@extends('client.layout.master')
@section('content')
    <div class="page-title lb single-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <h2><i class="fa fa-envelope-open-o bg-orange"></i> Liên hệ<small
                            class="hidden-xs-down hidden-sm-down">Liên hệ</small>
                    </h2>
                </div><!-- end col -->
                <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">Liên hệ</li>
                    </ol>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end page-title -->

    <section class="section wb">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if (session('success'))
                        <div class="alert alert-success">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif
                    <div class="page-wrapper">
                        <div class="row">
                            <div class="col-lg-7">
                                <form method="post" class="form-wrapper form-custom">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" placeholder="Tên của bạn">
                                        @if (count($errors) > 0)
                                            <small class="text-danger">
                                                @foreach ($errors->get('name') as $message)
                                                    {{ $message }} <br>
                                                @endforeach
                                            </small>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="address" placeholder="Địa chỉ">
                                        @if (count($errors) > 0)
                                            <small class="text-danger">
                                                @foreach ($errors->get('address') as $message)
                                                    {{ $message }} <br>
                                                @endforeach
                                            </small>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="phone"
                                            placeholder="Số điện thoại">
                                        @if (count($errors) > 0)
                                            <small class="text-danger">
                                                @foreach ($errors->get('phone') as $message)
                                                    {{ $message }} <br>
                                                @endforeach
                                            </small>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="subject" placeholder="Tiêu đề">
                                        @if (count($errors) > 0)
                                            <small class="text-danger">
                                                @foreach ($errors->get('subject') as $message)
                                                    {{ $message }} <br>
                                                @endforeach
                                            </small>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" name="message" placeholder="Nội dung"></textarea>
                                        @if (count($errors) > 0)
                                            <small class="text-danger">
                                                @foreach ($errors->get('message') as $message)
                                                    {{ $message }} <br>
                                                @endforeach
                                            </small>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary">Gửi <i
                                            class="fa fa-envelope-open-o"></i></button>
                                </form>
                            </div>
                        </div>
                    </div><!-- end page-wrapper -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
@endsection
