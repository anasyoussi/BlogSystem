@extends('layouts.backend.app') 
@section('title', 'Edit Post')

@push('css') 
<!-- Bootstrap Select Css -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
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
                            Edit Post {{ Illuminate\Support\Str::limit($post->title, 50) }}
                        </h2> 
                    </div>
                    <div class="body">
                        <form method="POST" action="{{ route('author.post.update', $post->id) }}" enctype="multipart/form-data">
                            @csrf  
                            @method('PUT')
                            <!-- Start -->
                            <div class="row clearfix">
                                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                                    <div class="card">
                                        <div class="header">
                                            <h2>
                                            Edit Post 
                                            </h2>
                                        </div>
                                        <div class="body">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" id="title" value="{{ $post->title }}" class="form-control" name="title">
                                                        <label class="form-label">Post Title</label>
                                                    </div>
                                                </div>
                
                                                <div class="form-group">
                                                    <label for="image">Featured Image</label>
                                                    <input type="file" name="image" class="form-control image">
                                                </div>
                                                
                                                <div class="form-group">
                                                    <img src="{{ url('storage/post/'. $post->image ) }}" class="m-t-15 image-preview" style="width: 400px;" alt="Rounded Image">
                                                </div>
                
                                            <div class="form-group"> <!-- try this checked($blog->status)-->
                                                <input type="checkbox" id="publish" class="filled-in" name="status" value="1" {{ $post->status==true ? 'checked' : '' }}>
                                                <label for="publish">Publish</label>
                                            </div>
                
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                    <div class="card">
                                        <div class="header">
                                            <h2>
                                                Categories and Tags
                                            </h2>
                                        </div>
                                        <div class="body">
                                            <div class="form-group form-float">
                                                <div class="form-line {{ $errors->has('categories') ? 'focused error' : '' }}">
                                                    <label for="category">Select Category</label> 
                                                    <!-- Select --> 
                                                    <select class="selectpicker form-control" name="categories[]" id="category" multiple> 
                                                        @foreach($categories as $category)
                                                            <option  
                                                                @foreach($post->categories as $postCategory)
                                                                    {{ $postCategory->id == $category->id ? 'selected' : '' }}
                                                                @endforeach
                                                                value="{{ $category->id }}"
                                                            >
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <!-- ./Select -->
                                                </div>
                                            </div>
                
                                            <div class="form-group form-float">
                                                <div class="form-line {{ $errors->has('tags') ? 'focused error' : '' }}">
                                                    <label for="tag">Select Tags</label>
                                                    <select name="tags[]" id="tag" class="form-control show-tick" multiple>
                                                        @foreach($tags as $tag)
                                                            <option 
                                                                value="{{ $tag->id }}"
                                                                @foreach($post->tags as $postTag)
                                                                    {{ $postTag->id == $tag->id ? 'selected' : '' }}
                                                                @endforeach
                                                            >
                                                                {{ $tag->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                
                                            <div class="row">  
                                                <a class="btn btn-danger m-t-15 waves-effect pull-left" href="{{ route('author.post.index') }}">
                                                    <i class="material-icons">arrow_back</i> BACK
                                                </a>
                                                <button type="submit" class="btn btn-primary m-t-15 waves-effect pull-right"><i class="material-icons">publish</i>SUBMIT</button> 
                                            </div>
                
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="card">
                                        <div class="header">
                                            <h2>
                                            BODY
                                            </h2>
                                        </div>
                                        <div class="body w-25">
                                            <textarea name="editor1">{{ $post->body }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End -->
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
<!-- Select Plugin Js -->
<script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
<!-- CKeditor 5 -->
<script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
 

<script>
        CKEDITOR.replace( 'editor1' );
</script>
 
 
<script src="{{ asset('assets/vanillaJS/app.js') }}"></script>
@endpush