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

    <div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
        @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        {{ $error }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endforeach
        @endif
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

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
    @include('admin.component.edit', ['groups' => $groups ])
    @include('admin.component.delete')
    	
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
                    { data: 'image', name: 'image', render: function(data) {
                        var imageUrl = "{{ asset('storage/images/') }}/" + data;
                        return `<img src="${imageUrl}" width="20px">`;
                    } },
                    { data: 'discount_nominal', name: 'discount_nominal' },
                    { data: 'discount_percentage', name: 'discount_percentage' },
                    { data: 'group_id', name: 'group_id' },
                    { data: 'action', name: 'action', orderable: false, searchable: false}
                    // Define columns
                ]
            });

            $('#edit-modal').on('hide.bs.modal',function(){
                $('#modal-edit-image').val('')
                $('#modal-preview-image').attr('src','')
            })

    
            $('#modal-edit-image').change(function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#modal-preview-image').attr('src', e.target.result);
                        $('#modal-preview-image').show();
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            });

            $('#submit-btn').click(function(){
                $('#hidden-submit-btn').click()
            })

            $('#edit-form').submit(function(event){
                event.preventDefault();

                $('#submit-btn').prop('disabled', true).html(`
                <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                <span role="status">Loading...</span>
                `);
                
                const id = $('#modal-edit-id').val()

                $.ajax({
                    type: 'PUT',
                    url: '{{ url("admin/item") }}/' + id,
                    data: $(this).serialize(),
                    success: function( response ){

                        $('#submit-btn').prop('disabled', false).html(`Save Changes`);
                        $('#edit-modal').modal('hide')

                    },
                    error: function(error){

                        console.log(error)
                        $('#submit-btn').prop('disabled', false).html(`Save Changes`);
                    }

                })
            })
            
        });

        $(document).on('click', '.action-edit', function() {
            
            let id = $(this).data('id')
            let name = $(this).data('name')
            let price = $(this).data('price')
            let description = $(this).data('description')
            let dp = $(this).data('discount-percentage')
            let dn = $(this).data('discount-nominal')
            let gname = $(this).data('group-name')
            let gid = $(this).data('group-id')
            let image = $(this).data('image')

            $('#modal-edit-id').val(id)
            $('#modal-edit-name').val(name)
            $('#modal-edit-price').val(price)
            $('#modal-edit-description').val(description)
            $('#modal-edit-discount-nominal').val(dn)
            $('#modal-edit-discount-percentage').val(dp)
            
            $('#modal-edit-group').val(gid).change()
            $('#modal-previous-image').attr('src', "{{ asset('storage/images/') }}/" + image)
            
            $('#edit-modal').modal('toggle')
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


