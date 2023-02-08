@extends('layouts.frontend.app') 
@section('title', 'Tags') 
@push('css')
    <link href="{{ asset('assets/frontend/layout-1/css/styles.css') }}" rel="stylesheet"> 
    <link href="{{ asset('assets/frontend/layout-1/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/LocalCSS/front.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front-page-category/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front-page-category/css/styles.css') }}" rel="stylesheet">
    <!-- jQuery Toast  -->
    <link rel="stylesheet" href="{{ asset('plugins/css/jquery.toast.min.css') }}"> 

    <style>
         .header-bg h1{
            color: white;
            text-transform: capitalize;
         }
    </style>
@endpush 
@section('content') 
<div class="slider header-bg">
    <div class="display-table center-text">
        <h1 class="title display-table-cell"><b>{{ $tag->name }}</b></h1>
    </div>
</div> <!-- slider -->

<section class="blog-area section">
    <div class="container">

        <div class="row">

            @foreach($posts as $post) 
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
        <a class="load-more-btn" href="#"><b>LOAD MORE</b></a> 
    </div><!-- container -->
</section><!-- section --> 
@endsection 


@push('js')   
    <!-- jQuery Toast -->
    <script src="{{ asset('plugins/js/jquery.toast.min.js') }}"></script> 
    <!-- Sweetalert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
@endpush