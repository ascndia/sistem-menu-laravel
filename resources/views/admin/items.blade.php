<x-app-layout>
    <div class="w-full px-6 py-3">
        <table id="yourTable" class="display min-w-full" style="width:100%">
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
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
    $(document).ready(function () {
        $('#yourTable').DataTable({
            searching:true,
            processing: true,
            serverSide: true,
            lengthMenu:[5,10,15,20,25,50,100],
            ajax: "{{ route('item.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'price', name: 'price'},
                {data: 'showing', name: 'showing'},
                {data: 'image', name: 'image'},
                {data: 'discount_nominal', name: 'discount_nominal'},
                {data: 'discount_percentage', name: 'discount_percentage'},
                {data: 'group_id', name: 'group_id'},
                // Define columns
            ]
        });

        $('#yourTable_length').addClass('w:40px')
    });
</script>

<style>
    #yourTable_length select {
        background-position: right center; /* Adjust the background position */
        padding-right: 25px; /* Add some padding on the right for the caret */
        /* Add any other styles as needed */
    }
    #yourTable td {
        text-align: center; /* Align content to center */
    }
</style>

</x-app-layout>
