@extends('layouts.admin')
@section('title', 'Create Item')

@section('main-content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3"><strong>Add Item</strong></h1>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('item.store') }}">
                            <div class="mb-3">
                                <label for="" class="form-label">Item name</label>
                                <input type="text" placeholder="Item name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Item Price</label>
                                <input type="number" placeholder="Item Price" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Upload Image</label>
                                <input type="file" placeholder="Upload image" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Item name</label>
                                <input type="text" placeholder="Item name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Item name</label>
                                <input type="text" placeholder="Item name" class="form-control">
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection