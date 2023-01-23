@extends('layouts.backend.app') 
@section('title', 'Add new Category')

@push('css') 
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
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
                            Add new Category
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
                        <form action="{{ route('admin.category.store') }}" method="post" enctype="multipart/form-data">
                            @csrf 
                            @method('post')

                            <label for="cat_name">Category Name</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="name" id="cat_name" class="form-control image" placeholder="Enter your Tag name">
                                </div>
                            </div>  

                            <label for="image">Category Image</label>
                            <div class="form-group">
                                <input type="file" name="image" class="form-control-file image">
                            </div> 

                            <div class="form-group">
                                <div class="form-line">
                                    <img src="" class="m-t-15 image-preview" style="width: 400px;" alt="Rounded Image" onerror="this.style.display='none'" onload="this.style.display='block'">
                                </div>
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
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script src="{{ asset('assets/vanillaJS/app.js') }}"></script>
@endpush