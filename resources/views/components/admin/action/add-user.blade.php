<div class="modal fade" id="user-add" tabindex="-1" role="dialog" aria-labelledby="userModalLabel"
aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('admin.super.user.store') }}" method="POST">
            {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Add User</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body border-top border-bottom">
                    <div class="px-4 mb-4">
                        <div class="form-group mb-2">
                            <label for="name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="email" class="col-form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="level" class="col-form-label">Level:</label>
                            <select class="form-control" id="level" name="level">
                                <option value="1">SuperAdmin</option>
                                <option value="2">Admin</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="password" class="col-form-label">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="password_confirmation" class="col-form-label">Password Confirmation:</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
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