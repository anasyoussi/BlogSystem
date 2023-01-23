@extends('layouts.backend.app') 
@section('title', 'Edit Category')

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
                            Edit Category
                        </h2> 
                    </div>
                    <div class="body">
                        <form method="POST" action="{{ route('admin.category.update', $category->id) }}" enctype="multipart/form-data">
                            @csrf 
                            @method('PUT')
                            <label for="tag_name">Category Name</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="name" value="{{ $category->name }}" id="tag_name" class="form-control" placeholder="Enter your Tag name">
                                </div>
                            </div>
                           
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="file" name="image"  id="tag_name" class="form-control image">
                                </div>
                                <img src="{{ url('storage/category/'. $category->image ) }}" class="m-t-15 image-preview" style="width: 400px;" alt="Rounded Image">
                            </div>  
                            <br>
                            <a href="{{ route('admin.category.index') }}" class="btn btn-danger wave-effect">Back</a>
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
    <script src="{{ asset('assets/vanillaJS/app.js') }}"></script>
@endpush