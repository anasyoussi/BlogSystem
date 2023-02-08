@extends('layouts.backend.app') 
@section('title', 'Posts List')

@push('css')
    <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
@endpush

@section('content') 
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <a href="{{ route('admin.post.create') }}" class="btn btn-primary waves-effect" >
                <i class="material-icons">add</i><span>Add new Post</span>
            </a>
        </div>
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            ALL Posts 
                            <span class="badge bg-blue">{{ $posts->count() }}</span> in database
                        </h2> 
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="dt-buttons"><a class="dt-button buttons-copy buttons-html5" tabindex="0" aria-controls="DataTables_Table_1" href="#"><span>Copy</span></a><a class="dt-button buttons-csv buttons-html5" tabindex="0" aria-controls="DataTables_Table_1" href="#"><span>CSV</span></a><a class="dt-button buttons-excel buttons-html5" tabindex="0" aria-controls="DataTables_Table_1" href="#"><span>Excel</span></a><a class="dt-button buttons-pdf buttons-html5" tabindex="0" aria-controls="DataTables_Table_1" href="#"><span>PDF</span></a><a class="dt-button buttons-print" tabindex="0" aria-controls="DataTables_Table_1" href="#"><span>Print</span></a></div><div id="DataTables_Table_1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="DataTables_Table_1"></label></div>
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="DataTables_Table_1" role="grid" aria-describedby="DataTables_Table_1_info">
                                <thead>
                                    <tr role="row">
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th><i class="material-icons">visibility</i></th>
                                        <th>Is Approved</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Author</th>  
                                        <th><i class="material-icons">visibility</i></th> 
                                        <th>Is Approved</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>  
                                    @forelse($posts as $post)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">{{ $loop->index + 1}}</td>
                                            <td>{{ \Illuminate\Support\Str::limit($post->title, 15) }}</td> 
                                            <td>{{ $post->user->name }}</td>
                                            <td>{{ $post->view_count }}</td>
                                            <!-- -->
                                            <td>
                                                @if($post->is_approved == true) 
                                                    <span class="badge bg-blue">Approved</span>
                                                @else 
                                                    <span class="badge bg-pink">Pending</span>
                                                @endif
                                            </td>
                                            <!-- -->
                                            <td>
                                                @if($post->status == true) 
                                                    <span class="badge bg-blue">Published</span>
                                                @else 
                                                    <span class="badge bg-pink">Refused</span>
                                                @endif
                                            </td> 
                                            <td>{{ $post->created_at->diffForHumans() }}</td>
                                            <td>{{ $post->updated_at->diffForHumans() }}</td> 
                                            <td class="text-center">
                                                 
                                                <a href="{{ route('admin.post.show', $post) }}" class="btn btn-success   waves-effect">
                                                    <i class="material-icons">visibility</i>
                                                </a>  

                                                <a href="{{ route('admin.post.edit', $post) }}" class="btn btn-primary  waves-effect">
                                                    <i class="material-icons">edit</i>
                                                </a>  

                                                <button class="btn btn-danger waves-effect  " type="button"
                                                    onclick="deletePost({{ $post->id }})"
                                                >
                                                    <i class="material-icons">delete</i>
                                                </button>

                                                <form id="delete-form-{{ $post->id }}" method="post" action="{{ route('admin.post.destroy', $post) }}" style="display: none;">
                                                    @csrf 
                                                    @method('delete')
                                                </form>
                                                 
                                            </td>
                                        </tr>
                                    @empty 
                                        <tr class="text-center">
                                            <td colspan="9">No data available in table</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table><div class="dataTables_info" id="DataTables_Table_1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div><div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_1_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="DataTables_Table_1_previous"><a href="#" aria-controls="DataTables_Table_1" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button active"><a href="#" aria-controls="DataTables_Table_1" data-dt-idx="1" tabindex="0">1</a></li><li class="paginate_button "><a href="#" aria-controls="DataTables_Table_1" data-dt-idx="2" tabindex="0">2</a></li><li class="paginate_button "><a href="#" aria-controls="DataTables_Table_1" data-dt-idx="3" tabindex="0">3</a></li><li class="paginate_button "><a href="#" aria-controls="DataTables_Table_1" data-dt-idx="4" tabindex="0">4</a></li><li class="paginate_button "><a href="#" aria-controls="DataTables_Table_1" data-dt-idx="5" tabindex="0">5</a></li><li class="paginate_button "><a href="#" aria-controls="DataTables_Table_1" data-dt-idx="6" tabindex="0">6</a></li><li class="paginate_button next" id="DataTables_Table_1_next"><a href="#" aria-controls="DataTables_Table_1" data-dt-idx="7" tabindex="0">Next</a></li></ul></div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
</section>
@endsection



@push('js')
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>
    <script type="text/javascript">
        function deletePost(id){ 
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.preventDefault(); 
                    document.getElementById('delete-form-'+id).submit(); 
                }
            }) 
        }
    </script>

@endpush