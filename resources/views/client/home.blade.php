@extends('client.layout.master')
@section('title')
    BlogCar | Tin tức xe
@endsection
@section('content')
    <section class="section first-section">
        <div class="container-fluid">
            <div class="masonry-blog clearfix">
                @foreach ($highlights as $key => $post)
                    @if ($key == 0)
                        <div class="first-slot">
                        @elseif($key == 1)
                            <div class="second-slot">
                            @elseif($key == 2)
                                <div class="last-slot">
                    @endif
                    <div class="masonry-box post-media">
                        <img src="{{ asset('/public/images/' . $post->thumbnail) }}" alt="" class="img-fluid">
                        <div class="shadoweffect">
                            <div class="shadow-desc">
                                <div class="blog-meta">
                                    <span class="bg-orange"><a
                                            href="{{ route('category.post', ['slug' => $post->category->slug]) }}"
                                            title="">{{ $post->category->name }}</a></span>
                                    <h4><a href="{{ route('single.post', ['slug' => $post->slug]) }}"
                                            title="">{{ $post->title }}</a></h4>
                                    <small>{{ \Carbon\Carbon::parse($post->created_at)->format('d-m-Y') }}</small>
                                    <small>{{ $post->user->name }}</small>
                                </div><!-- end meta -->
                            </div><!-- end shadow-desc -->
                        </div><!-- end shadow -->
                    </div><!-- end post-media -->
            </div><!-- end first-side -->
            @endforeach
        </div><!-- end masonry -->
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                    <div class="page-wrapper">
                        <div class="blog-top clearfix">
                            <h4 class="pull-left">Recent News <a href="#"><i class="fa fa-rss"></i></a>
                            </h4>
                        </div><!-- end blog-top -->

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
                                        <small>{{ \Carbon\Carbon::parse($post->created_at)->format('d-m-Y') }}</small>
                                        <small>{{ $post->user->name }}</small>
                                        <small><i class="fa fa-eye"></i> {{ $post->view_counts }}</small>
                                    </div><!-- end meta -->
                                </div><!-- end blog-box -->

                                <hr class="invis">
                            @endforeach

                        </div><!-- end blog-list -->
                    </div><!-- end page-wrapper -->
                </div><!-- end col -->
                @include('client.layout.sidebar')
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
@endsection
