@extends('layouts.admin')
@section('title', 'Create Item')

@push('css-top')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
        <h1 class="h3 mb-3"><strong>Add Item</strong></h1>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- {{ route('item.store') }} -->
                        <form method="post" action=" {{ route('item.store') }} "  enctype="multipart/form-data">	
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
                                    <option value="" disabled selected>select group</option>
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
                                    <input value="{{ old('discount_nominal', 0) }}" name="discount_nominal" type="number" value="0" placeholder="Discount Nominal" class="form-control">
                                </div>
                                <div class="col-6">
                                    <label for="" class="form-label">Discount Percentage</label>
                                    <input step="0.01" value="{{ old('discount_percentage', 0)  }}" name="discount_percentage" type="number" value="0" placeholder="Discount Percentage" class="form-control">
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
