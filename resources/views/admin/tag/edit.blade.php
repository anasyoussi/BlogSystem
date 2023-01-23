@extends('layouts.backend.app') 
@section('title', '')

@push('css') 
@endpush




@section('content') 
<section class="content">
    <div class="container-fluid">
        <!-- Vertical Layout -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Edit Tag
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <form method="POST" action="{{ route('admin.tag.update', $tag) }}">
                            @csrf 
                            @method('PUT')
                            <label for="tag_name">Tag Name</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="name" value="{{ $tag->name }}" id="tag_name" class="form-control" placeholder="Enter your Tag name">
                                </div>
                            </div>  
                            <br>
                            <a href="{{ route('admin.tag.index') }}" class="btn btn-danger wave-effect">Back</a>
                            <button type="submit" class="btn btn-primary waves-effect">Save</button> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Vertical Layout -->
    </div>
</section>
@endsection





@push('js') 
@endpush