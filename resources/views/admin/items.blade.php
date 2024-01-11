@extends('layouts.admin')

@section('title','Items')

@push('script-top')                                                              
@endpush

@push('css-top')
<link rel="preconnect" href="https://fonts.gstatic.com">
<link rel="shortcut icon" href="img/icons/icon-48x48.png" />
<link rel="canonical" href="https://demo-basic.adminkit.io/" />
@endpush


@push('css-top')                                                                 <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">                                                       
@endpush

@section('main-content')
    <div class="w-100 table-responsive">
        <table id="yourTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>nama item</th>
                    <th>harga</th>
                    <th>showing</th>
                    <th>gambar</th>
                    <th>nominal diskon</th>
                    <th>persenan diskon</th>
                    <th>grup</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@push('script-bot')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
@endpush

@push('script-bot')
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
                    { data: 'price', name: 'price' },
                    { data: 'showing', name: 'showing' },
                    { data: 'image', name: 'image' },
                    { data: 'discount_nominal', name: 'discount_nominal' },
                    { data: 'discount_percentage', name: 'discount_percentage' },
                    { data: 'group_id', name: 'group_id' },
                    // Define columns
                ]
            });

        });
    </script>
@endpush

@push('css-bot')
    <style>
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


