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
                <form id="edit-form" method="put"  enctype="multipart/form-data">        
                        @csrf
                            <input type="hidden" name="id" id="modal-edit-id" value="">
                            <input type="hidden" name="_method" value="PUT">
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
                                    <select id="modal-edit-group" name="group_id" value="" class="form-select" aria-label="Default select example">
                                    <option value="" disabled selected>select group</option>
                                        @foreach($groups as $group)
                                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Upload New Image</label>
                                <input id="modal-edit-image" accept="image/*" name="image" value="{{ old('image') }}" type="file" placeholder="Upload image" class="form-control">
                            </div>
                            <div class="mb-3 row">
                                <div class="col-6 row">
                                    <label for="" class="form-label">Previous Image</label>
                                    <img id="modal-previous-image" src="" alt="">    
                                </div>
                                <div class="col-6 row">
                                    <label for="" class="form-label">Preview Image</label>
                                    <img id="modal-preview-image" src="" alt="">    
                                </div>
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
                            <button type="submit" id="hidden-submit-btn" style="display:none;"></button>
                        </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">Close</button>
                    <button id="submit-btn" type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    