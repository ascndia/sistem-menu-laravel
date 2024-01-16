@extends('layouts.admin')
@section('title', 'Create Item')

@section('main-content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="container-fluid p-0">
        <h1 class="h3 mb-3"><strong>Add Item</strong></h1>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- {{ route('item.store') }} -->
                        <form method="post" action=" {{ route('item.store') }} "  enctype="multipart/form-data ">	
                        @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Item name</label>
                                <input name="name" value="{{ old('name') }}" type="text" placeholder="Item name" class="form-control">                                
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Item Description</label>
                                <input value="{{ old('description') }}"  name="description" type="text" placeholder="Item Description" class="form-control">
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="" class="form-label">Item Price</label>
                                    <input name="price" value="{{ old('price') }}" type="number" placeholder="Item Price" class="form-control">
                                </div>
                                <div class="col-6">
                                    <label for="" class="form-label">Item Group</label>
                                    <select name="group_id" value="{{ old('group_id') }}" class="form-select" aria-label="Default select example">
                                    <option value="" disabled selected>Select Category</option>
                                        @foreach($groups as $group)
                                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Upload Image</label>
                                <input name="image" value="{{ old('image') }}" type="file" placeholder="Upload image" class="form-control">
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="" class="form-label">Discount Nominal</label>
                                    <input value="{{ old('discount_nominal') }}" name="discount_nominal" type="number" value="0" placeholder="Discount Nominal" class="form-control">
                                </div>
                                <div class="col-6">
                                    <label for="" class="form-label">Discount Percentage</label>
                                    <input step="0.01" value="{{ old('discount_percentage') }}" name="discount_percentage" type="number" value="0" placeholder="Discount Percentage" class="form-control">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
