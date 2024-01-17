@extends('layouts.admin')
@section('title', 'Dashboard')

@section('main-content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3"><strong>Dashboard</strong></h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Total Items
                        </div>
                    </div>
                    <div class="card-body">
		    	
			<div class="d-flex justify-content-between align-items-center">
                                <h2 class="mb-0">{{ $item }}</h2>
				<span class="text-muted">Items</span>
			</div>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Total Groups
                        </div>
                    </div>
                    <div class="card-body">
		    	
			<div class="d-flex justify-content-between align-items-center">
           			<h2 class="mb-0">{{ $group }}</h2>
            			<span class="text-muted">Groups</span>
        		</div>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Visitors
                        </div>
                    </div>
                    <div class="card-body">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
