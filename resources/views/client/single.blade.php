@extends('client.layout.master')
@section('title')
    {{ $post->title }}
@endsection
@section('content')
    <section class="section single-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                    <div class="page-wrapper">
                        <div class="blog-title-area text-center">
                            <ol class="breadcrumb hidden-xs-down">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('category.post', ['slug' => $post->category->slug]) }}">{{ $post->category->name }}</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    {{ $post->title }}
                                </li>
                            </ol>

                            <span class="color-orange"><a
                                    href="{{ route('category.post', ['slug' => $post->category->slug]) }}"
                                    title="">{{ $post->category->name }}</a></span>

                            <h3>{{ $post->title }}</h3>

                            <div class="blog-meta big-meta">
                                <small>{{ \Carbon\Carbon::parse($post->created_at)->format('d-m-Y') }}</small>
                                <small>{{ $post->user->name }}</small>
                                <small><a href="#" title=""><i class="fa fa-eye"></i>
                                        {{ $post->view_counts }}</a></small>
                            </div><!-- end meta -->

                            <div class="post-sharing">
                                <ul class="list-inline">
                                    <li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i>
                                            <span class="down-mobile">Share on Facebook</span></a></li>
                                    <li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i>
                                            <span class="down-mobile">Tweet on Twitter</span></a></li>
                                    <li><a href="#" class="gp-button btn btn-primary"><i
                                                class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div><!-- end post-sharing -->
                        </div><!-- end title -->

                        <div class="single-post-media">
                            <img src="{{ asset('/public/images/' . $post->thumbnail) }}" alt="{{ $post->title }}"
                                class="img-fluid">
                        </div><!-- end media -->

                        <div class="blog-content">
                            {!! $post->content !!}
                        </div><!-- end content -->

                        <div class="blog-title-area">
                            <div class="post-sharing">
                                <ul class="list-inline">
                                    <li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i>
                                            <span class="down-mobile">Share on Facebook</span></a></li>
                                    <li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i>
                                            <span class="down-mobile">Tweet on Twitter</span></a></li>
                                    <li><a href="#" class="gp-button btn btn-primary"><i
                                                class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div><!-- end post-sharing -->
                        </div><!-- end title -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="banner-spot clearfix">
                                    <div class="banner-img">
                                        <img src="upload/banner_01.jpg" alt="" class="img-fluid">
                                    </div><!-- end banner-img -->
                                </div><!-- end banner -->
                            </div><!-- end col -->
                        </div><!-- end row -->

                        <hr class="invis1">

                        <div class="custombox prevnextpost clearfix">
                            <div class="row">
                                @if ($post->previous())
                                    <div class="col-lg-6">
                                        <div class="blog-list-widget">
                                            <div class="list-group">
                                                <a href="{{ route('single.post', ['slug' => $post->previous()->slug]) }}"
                                                    class="list-group-item list-group-item-action flex-column align-items-start">
                                                    <div class="w-100 justify-content-between text-right">
                                                        <img src="{{ asset('/public/images/' . $post->previous()->thumbnail) }}"
                                                            alt="" class="img-fluid float-right">
                                                        <h5 class="mb-1">{{ $post->previous()->title }}</h5>
                                                        <small>Prev Post</small>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div><!-- end col -->
                                @endif
                                @if ($post->next())
                                    <div class="col-lg-6">
                                        <div class="blog-list-widget">
                                            <div class="list-group">
                                                <a href="{{ route('single.post', ['slug' => $post->next()->slug]) }}"
                                                    class="list-group-item list-group-item-action flex-column align-items-start">
                                                    <div class="w-100 justify-content-between">
                                                        <img src="{{ asset('/public/images/' . $post->next()->thumbnail) }}"
                                                            alt="" class="img-fluid float-left">
                                                        <h5 class="mb-1">{{ $post->next()->title }}</h5>
                                                        <small>Next Post</small>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div><!-- end col -->
                                @endif
                            </div><!-- end row -->
                        </div><!-- end author-box -->

                        <hr class="invis1">
                        @if ($related)
                            <div class="custombox clearfix">
                                <h4 class="small-title">Bài viết liên quan</h4>
                                <div class="row">
                                    @foreach ($related as $post)
                                        <div class="col-lg-6">
                                            <div class="blog-box">
                                                <div class="post-media">
                                                    <a href="{{ route('single.post', ['slug' => $post->slug]) }}"
                                                        title="">
                                                        <img src="{{ asset('/public/images/' . $post->thumbnail) }}"
                                                            alt="" class="img-fluid">
                                                        <div class="hovereffect">
                                                            <span class=""></span>
                                                        </div><!-- end hover -->
                                                    </a>
                                                </div><!-- end media -->
                                                <div class="blog-meta">
                                                    <h4>
                                                        <a href="{{ route('single.post', ['slug' => $post->slug]) }}"
                                                            title="">
                                                            {{ $post->title }}
                                                        </a>
                                                    </h4>
                                                    <small><a href="blog-category-01.html"
                                                            title="">{{ $post->category->name }}</a></small>
                                                    <small>{{ \Carbon\Carbon::parse($post->created_at)->format('d-m-Y') }}</small>
                                                </div><!-- end meta -->
                                            </div><!-- end blog-box -->
                                        </div><!-- end col -->
                                    @endforeach
                                </div><!-- end row -->
                            </div><!-- end custom-box -->
                        @endif

                        <hr class="invis1">
                        @if (count($post->comments))
                            <div class="custombox clearfix">
                                <h4 class="small-title">{{ count($post->comments) }} Bình luận</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="comments-list">
                                            @foreach ($post->comments as $comment)
                                                <div class="display-comment">
                                                    <div class="media">
                                                        <a class="media-left" href="#">
                                                            <img src="{{ asset('/public/images/' . $comment->user->avatar) }}"
                                                                alt="" class="rounded-circle">
                                                        </a>
                                                        <div class="media-body">
                                                            <h4 class="media-heading user_name">
                                                                {{ $comment->user->name }}<small>{{ \Carbon\Carbon::parse($comment->created_at)->format('d-m-Y') }}</small>
                                                            </h4>
                                                            <p>{{ $comment->content }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div><!-- end col -->
                                </div><!-- end row -->
                            </div><!-- end custom-box -->
                        @endif

                        <hr class="invis1">
                        @if (Illuminate\Support\Facades\Auth::check())
                            <div class="custombox clearfix">
                                <h4 class="small-title">Leave a Reply</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form method="post" class="form-wrapper">
                                            @csrf
                                            <textarea class="form-control" name="content" placeholder="Nội dung"></textarea>
                                            @if (count($errors) > 0)
                                                <small class="text-danger">
                                                    @foreach ($errors->get('content') as $message)
                                                        {{ $message }} <br>
                                                    @endforeach
                                                </small>
                                            @endif
                                            <button type="submit" class="btn btn-primary">Gửi</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="custombox clearfix">
                                <h4 class="small-title">Vui lòng đăng nhập để bình luận</h4>
                                <a href="{{ route('login.client') }}" class="btn btn-primary">Đăng nhập</a>
                            </div>
                        @endif

                    </div><!-- end page-wrapper -->
                </div><!-- end col -->

                @include('client.layout.sidebar')
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
@endsection
