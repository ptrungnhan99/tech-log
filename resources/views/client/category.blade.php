@extends('client.layout.master')
@section('title')
    Blogcar | {{ $category->name }}
@endsection
@section('content')
    <div class="page-title lb single-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <h2><i class="fa fa-star bg-orange"></i> {{ $category->name }} <small
                            class="hidden-xs-down hidden-sm-down">{{ $category->description }}</small></h2>
                </div><!-- end col -->
                <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Blog</a></li>
                        <li class="breadcrumb-item active"> {{ $category->name }}</li>
                    </ol>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end page-title -->

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                    <div class="page-wrapper">
                        <div class="blog-list clearfix">
                            @foreach ($posts as $post)
                                <div class="blog-box row">
                                    <div class="col-md-4">
                                        <div class="post-media">
                                            <a href="{{ route('single.post', ['slug' => $post->slug]) }}" title="">
                                                <img src="{{ asset('/public/images/' . $post->thumbnail) }}" alt=""
                                                    class="img-fluid">
                                                <div class="hovereffect"></div>
                                            </a>
                                        </div><!-- end media -->
                                    </div><!-- end col -->

                                    <div class="blog-meta big-meta col-md-8">
                                        <h4><a href="{{ route('single.post', ['slug' => $post->slug]) }}"
                                                title="">{{ $post->title }}</a></h4>
                                        <p>{{ $post->description }}</p>
                                        <small class="firstsmall"><a class="bg-orange"
                                                href="{{ route('category.post', ['slug' => $post->category->slug]) }}"
                                                title="">{{ $post->category->name }}</a></small>
                                        <small>21 July, 2017</small>
                                        <small>{{ \Carbon\Carbon::parse($post->created_at)->format('d-m-Y') }}</small>
                                        <small>{{ $post->user->name }}</small>
                                    </div><!-- end meta -->
                                </div><!-- end blog-box -->
                                <hr class="invis">
                            @endforeach
                        </div><!-- end blog-list -->
                    </div><!-- end page-wrapper -->

                    <hr class="invis">

                    <div class="row">
                        <div class="col-md-12">
                            {{ $posts->links() }}
                        </div><!-- end col -->
                    </div><!-- end row -->
                </div><!-- end col -->
                @include('client.layout.sidebar')
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
@endsection
