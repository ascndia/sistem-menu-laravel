@extends('layouts.admin')

@section('title','Items')


@push('css-top')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">                                                       
<link rel="shortcut icon" href="img/icons/icon-48x48.png" />
<link rel="canonical" href="https://demo-basic.adminkit.io/" />
@endpush

@section('main-content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3"><strong>Item Management</strong></h1>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- <div class="row">
                            <div class="c col-end-auto">
                                <a href="{{ route('item.create') }}" class="btn btn-primary">Add New</a>
                                <a href="{{ route('item.create') }}" class="btn btn-primary">Manage Discount</a>
                                <a href="{{ route('item.create') }}" class="btn btn-primary">Manage Showing</a>
                            </div>
                        </div> -->
                        
                        <!-- Table Start -->
                        <div class="w-100 py-3 table-responsive">
                            <table id="yourTable" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>nama item</th>
                                        <th>deskripsi</th>
                                        <th>harga</th>
                                        <th>showing</th>
                                        <th>gambar</th>
                                        <th>nominal diskon</th>
                                        <th>persenan diskon</th>
                                        <th>grup</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <!-- Table End -->
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal section -->
    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Item</h5>
                    <button type="btn" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form method="post" action=" {{ route('item.store') }} "  enctype="multipart/form-data">	
                        @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Item name</label>
                                <input id="modal-edit-name" name="name" value="{{ old('name') }}" type="text" placeholder="Item name" class="form-control">                                
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Item Description</label>
                                <input id="modal-edit-description" value="{{ old('description') }}"  name="description" type="text" placeholder="Item Description" class="form-control">
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="" class="form-label">Item Price</label>
                                    <input id="modal-edit-price" name="price" value="{{ old('price') }}" type="number" placeholder="Item Price" class="form-control">
                                </div>
                                <div class="col-6">
                                    <label for="" class="form-label">Item Group</label>
                                    <select id="modal-edit-group" name="group_id" value="{{ old('group_id') }}" class="form-select" aria-label="Default select example">
                                    <option value="" disabled selected>select group</option>
                                        @foreach($groups as $group)
                                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Upload Image</label>
                                <input id="modal-edit-image" name="image" value="{{ old('image') }}" type="file" placeholder="Upload image" class="form-control">
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="" class="form-label">Discount Nominal</label>
                                    <input id="modal-edit-discount-nominal" value="{{ old('discount_nominal', 0) }}" name="discount_nominal" type="number" value="0" placeholder="Discount Nominal" class="form-control">
                                </div>
                                <div class="col-6">
                                    <label for="" class="form-label">Discount Percentage</label>
                                    <input id="modal-edit-discount-percentage" step="0.01" value="{{ old('discount_percentage', 0)  }}" name="discount_percentage" type="number" value="0" placeholder="Discount Percentage" class="form-control">
                                </div>
                            </div>
                        </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push("script-bot")
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
@endpush

@push("script-bot")
    <script>

        $(document).ready(function () {
            $('#yourTable').DataTable({
                searching: true,
                processing: true,
                serverSide: true,
                lengthMenu: [5, 10, 15, 20, 25, 50, 100],
                ajax: "{{ route('item.index') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'description', name: 'description' },
                    { data: 'price', name: 'price' },
                    { data: 'showing', name: 'showing' },
                    { data: 'image', name: 'image' },
                    { data: 'discount_nominal', name: 'discount_nominal' },
                    { data: 'discount_percentage', name: 'discount_percentage' },
                    { data: 'group_id', name: 'group_id' },
                    { data: 'action', name: 'action', orderable: false, searchable: false}
                    // Define columns
                ]
            });
            
        });

        $(document).on('click', '.action-edit', function($this){

	    let id = $(this).data('id')
	    let name = $(this).data('name'))
	    let price = $(this).data('price')
	    let description = $(this).data('description')
	    let dp = $(this).data('discount_percentage')
	    let dn = $(this).data('discount_nominal')
	    let gname = $(this).data('group-name')
	    let gid = $(this).data('group-id')
	    let image = $(this).data('image')

	    $('modal-edit-id').val(id)
	    $('modal-edit-name').val(name)
	    $('modal-edit-price').val(price)
	    $('modal-edit-description').val(description)
	    $('modal-edit-discount-nominal').val(dn)
	    $('modal-edit-discount-percentage').val(dp)
	    $('modal-edit-group').val(gid)
	    $('modal-edit-group').text(gname)
	    $('modal-edit-image').val(image)
		
            $('#edit-modal').modal('toggle');
        })
    </script>
@endpush

@push('css-bot')
    <style>
        .action-delete, .action-edit {
            cursor: pointer;    
        }

        #yourTable_length select {
            background-position: right center;
            padding-right: 0px;
        }

        #yourTable td {
            text-align: center;
        }

  	/* Add custom CSS for smaller screens */
  	@media screen and (max-width: 767px) {
  	}
    </style>
@endpush                                                      


