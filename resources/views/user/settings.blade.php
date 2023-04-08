@extends('layouts.backend.app') 

@section('title', 'Settings')

@push('css')  
@endpush 

@section('content') 
<section class="content">
    <div class="container-fluid"> 
        <!-- Tabs -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Profile Settings
                    </h2> 
                </div>
                <div class="body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#profile_with_icon_title" data-toggle="tab">
                                <i class="material-icons">manage_accounts</i> UPDATE PROFILE
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#password_with_icon_title" data-toggle="tab">
                                <i class="material-icons">password</i> PASSWORD
                            </a>
                        </li> 
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        @if(Session::has('error'))
                            <div class="alert alert-danger">
                            {{ Session::get('error')}}
                            </div>
                        @endif
                        <div role="tabpanel" class="tab-pane fade in active" id="profile_with_icon_title">
                            <!-- Start -->
                            <div class="body">
                                <form id="" action="{{ route('author.profile.updateProfile') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                    @csrf 
                                    @method('PUT')
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">Name</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" class="form-control" placeholder="Enter your Name">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="email">Email</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="email" name="email" value="{{ Auth::user()->email }}" class="form-control" placeholder="Enter your Name">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="profile_img">Profile Image</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="file" name="image" class="form-control-file" id="profile_img" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="about">About me</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <textarea rows="4" id='about' name="about" class="form-control no-resize" placeholder="Please type what you want...">{{ Auth::user()->about }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="row clearfix">
                                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
                                        </div>
                                    </div>
                                </form>
                            </div>  
                            <!-- End -->
                        </div>
                        <!-- Start -->
                        <div role="tabpanel" class="tab-pane fade" id="password_with_icon_title"> 
                            <form id="pwdVal" action="{{ route('author.password.updatePassword') }}" method="post">
                                @csrf 
                                @method('put')
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="old_pass">Old Password</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line"> 
                                                <input type="password" id="old_password" name="old_password" class="form-control" placeholder="Enter your Old Password">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password">New Password</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="password" id="password" name="password" class="form-control" placeholder="Enter your New Password">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_confirmation">Confirm Password</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Enter your New Password">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
                                    </div>
                                </div>

                            </form>
                        </div> 
                        <!-- End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- ./Tabs -->
    </div>
</section>
@endsection 


@push('js')  
@endpush