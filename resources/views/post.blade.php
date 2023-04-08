@extends('layouts.frontend.app')

@section('title',  $post->title)   
 
@push('css') 
    <!-- Stylesheets --> 
    <link href="{{ asset('assets/common-css/bootstrap.css') }}" rel="stylesheet"> 
    <link href="{{ asset('assets/common-css/ionicons.css') }}" rel="stylesheet"> 
    <link href="{{ asset('assets/single-post-1/css/styles.css') }}" rel="stylesheet"> 
    <link href="{{ asset('assets/single-post-1/css/responsive.css') }}" rel="stylesheet">
     <!-- jQuery Toast  -->
    <link rel="stylesheet" href="{{ asset('plugins/css/jquery.toast.min.css') }}">
    <style>
        .favorite_posts{
            color: blueviolet;
        }
        .header-bg{
            height: 400px;
            width: 100%;
            background-size: cover;
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),  url('{{ Storage::disk("public")->url("post/".$postImage) }}'); 
        } 
    </style>
@endpush   
 

@section('content')  

<div class="slider header-bg">
    <div class="display-table center-text">
        <h1 class="title display-table-cell"><b> {{ $postTitle }}</b></h1>
    </div>
</div> 

<section class="post-area section">
    <div class="container">  
        <div class="row"> 
            <div class="col-lg-8 col-md-12 no-right-padding"> 
                <div class="main-post"> 
                    <div class="blog-post-inner"> 
                        <div class="post-info"> 
                            <div class="left-area">
                                <a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('profile/'. $post->user->image) }}" alt="Profile Image"></a>
                            </div>

                            <div class="middle-area">
                                <a class="name" href="#"><b>{{ $post->user->name }}</b></a>
                                <h6 class="date">{{ $post->created_at->diffForHumans() }}</h6>
                            </div>

                        </div><!-- post-info -->

                        <!-- <h3 class="title"><a href="#"><b>How Did Van Gogh's Turbulent Mind Depict One of the Most Complex Concepts in Physics?</b></a></h3> -->

                        <!-- <p class="para">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
                        ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                        nulla pariatur. Excepteur sint
                        occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p> -->

                        <div class="post-image"><img src="{{ Storage::disk('public')->url('post/'.$post->image) }}" alt="Blog Image"></div>

                        <p class="para">{!! html_entity_decode($postBody) !!}</p>

                        <ul class="tags"> 
                            @foreach($postTags as $tag) 
                                <li><a href="{{ route('tag.posts', $tag->slug) }}">{{ $tag->name }}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- blog-post-inner -->

                    <div class="post-icons-area">
                        <ul class="post-icons">
                            <li><i class="ion-heart"></i> {{ $post->favorite_to_user()->count() }}</li>
                            <li><i class="ion-chatbubble"></i> {{ $post->comments()->count() }}  </li>
                            <li><i class="ion-eye"></i> {{ $post->view_count }}</li>
                        </ul>

                        <ul class="icons">
                            <li>SHARE : </li>
                            <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                            <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                            <li><a href="#"><i class="ion-social-pinterest"></i></a></li>
                        </ul>
                    </div>

                    <!-- <div class="post-footer post-info">

                         <div class="left-area">
                            <a class="avatar" href="#"><img src="images/avatar-1-120x120.jpg" alt="Profile Image"></a>
                        </div> 

                          <div class="middle-area">
                            <a class="name" href="#"><b>Katy Liu</b></a>
                            <h6 class="date">on Sep 29, 2017 at 9:48 am</h6>
                        </div> 

                    </div>--><!-- post-info -->
                

                </div><!-- main-post -->
            </div><!-- col-lg-8 col-md-12 -->

            <div class="col-lg-4 col-md-12 no-left-padding">

                <div class="single-post info-area">

                    <!-- <div class="sidebar-area about-area">
                        <h4 class="title"><b>ABOUT BONA</b></h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                            ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur
                            Ut enim ad minim veniam</p>
                    </div> -->

                    <div class="sidebar-area subscribe-area">

                        <h4 class="title"><b>SUBSCRIBE</b></h4>
                        <div class="input-area">
                            <form method="POST" action="{{ route('subscriber.store') }}">
                                @csrf
                                <input class="email-input" name="email" type="text" placeholder="Enter your email">
                                <button class="submit-btn" type="submit"><i class="icon ion-ios-email-outline"></i></button>
                            </form>
                        </div>

                    </div><!-- subscribe-area -->

                    <div class="tag-area">

                        <h4 class="title"><b>TAG CLOUD</b></h4>
                        <ul> 
                           @foreach($postCategories as $category)
                                <li><a href="">{{ $category->name }}</a></li>
                           @endforeach
                        </ul>

                    </div><!-- subscribe-area -->

                </div><!-- info-area -->

            </div><!-- col-lg-4 col-md-12 -->

        </div><!-- row -->

    </div><!-- container -->
</section><!-- post-area -->


<section class="recomended-area section">
    <div class="container">
        <div class="row">  
            @foreach($randomposts as $post) 
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        <div class="single-post post-style-1"> 
                            <div class="blog-image"><img src="{{ Storage::disk('public')->url('post/'.$post->image) }}" alt="Blog Image"></div> 
                            <a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('profile/' . $post->user->image) }}" alt="Profile Image"></a> 
                            <div class="blog-info"> 
                                <h4 class="title"><a href="{{ route('post.details', $post->slug) }}"><b>{{ $post->title }}</b></a></h4> 
                                <ul class="post-footer">
                                   
                                    <li> 
                                        @guest
                                            <a 
                                                href="javascript:void(0);" 
                                                onclick="
                                                    Swal.fire({
                                                            title: 'Login !',
                                                            icon: 'info', 
                                                            html:'to like post you need to login first',
                                                            scrollbarPadding: false,
                                                            // optional
                                                            heightAuto: false, 
                                                        })    
                                                "
                                            >
                                                <i class="ion-heart"></i>{{ $post->favorite_to_user->count() }}
                                            </a>
                                        @else 
                                            <a 
                                                href="javascript:void(0);" 
                                                onclick="document.getElementById('favorite-form-{{ $post->id }}').submit()"
                                                class="{{ !Auth::user()->favorite_posts->where('pivot.post_id', $post->id)->count() == 0 ? 'favorite_posts' : '' }}"
                                            >
                                                <i class="ion-heart"></i>{{ $post->favorite_to_user->count() }}
                                            </a>

                                            <form id="favorite-form-{{ $post->id }}" action="{{ route('post.favorite', $post->id) }}" method="POST" style="display: none;">
                                                @csrf  
                                            </form>
                                        @endguest
                                         
                                    </li>
                                    <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                    <li><a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
                                </ul> 
                            </div><!-- blog-info -->
                        </div><!-- single-post -->
                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 --> 
            @endforeach  
        </div><!-- row -->

    </div><!-- container -->
</section>

<section class="comment-section">
    <div class="container">
        <h4><b>POST COMMENT</b></h4>
        <div class="row">

            <div class="col-lg-8 col-md-12">
                <div class="comment-form">
                    @guest 
                    <p>
                        <a href="{{ route('login') }}"><b>Login</b></a> first to add comment
                    </p>
                    @else 
                    <form action="{{ route('comment.store', $postID) }}" method="post" >
                        @csrf
                        @method('post')
                        <div class="row">  
                            <div class="col-sm-12">
                                <textarea name="comment" rows="2" class="text-area-messge form-control" placeholder="Enter your comment" aria-required="true" aria-invalid="false"></textarea>
                            </div><!-- col-sm-12 -->
                            <div class="col-sm-12">
                                <button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
                            </div><!-- col-sm-12 --> 
                        </div><!-- row -->
                    </form>
                    @endguest
                </div><!-- comment-form -->

                <h4><b>COMMENTS ({{ $commentCount }})</b></h4>
                @if($commentCount > 0)
                    @foreach($comments as $comment)
                    <div class="commnets-area ">

                        <div class="comment">

                            <div class="post-info">

                                <div class="left-area">
                                    <a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('profile/'.$comment->user->image) }}" alt="Profile Image"></a>
                                </div>

                                <div class="middle-area">
                                    <a class="name" href="#"><b>{{ $comment->user->name }}</b></a>
                                    <h6 class="date">on {{ $comment->created_at->diffForHumans() }}</h6>
                                </div> 

                            </div><!-- post-info -->

                            <p>{{ $comment->comment }}</p>

                        </div>

                    </div><!-- commnets-area -->
                    @endforeach
                    <a class="more-comment-btn" href="#"><b>VIEW MORE COMMENTS</a>
                @else 
                    <div class="commnets-area">
                        <div class="comment"> 
                            <p>No comment yet be the first.</p> 
                        </div>
                    </div>
                @endif
                 

            </div><!-- col-lg-8 col-md-12 -->

        </div><!-- row -->

    </div><!-- container -->
</section>
@endsection

@push('js')   
    <!-- jQuery Toast -->
    <script src="{{ asset('plugins/js/jquery.toast.min.js') }}"></script> 
    <!-- Sweetalert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
@endpush