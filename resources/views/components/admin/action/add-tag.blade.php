<div class="modal fade" id="tag-add" tabindex="-1" role="dialog" aria-labelledby="tagModalLabel"
aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('admin.tag.store') }}" method="POST">
            {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tagModalLabel">Add Tag</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body border-top">
                    <div class="px-5 pb-5 pt-4">
                        <div class="form-group mb-3">
                            <label for="name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-sm px-3"><i class="bi bi-plus mr-2"></i> Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>