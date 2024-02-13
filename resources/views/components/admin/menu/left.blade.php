<div class="card mb-3 mb-lg-0">
    <div class="card-body">
        <form method="GET">
            <div class="form-group">
                <label for="label">Label</label>
                <input type="text" class="form-control font-size-12" name="label" placeholder="Label/Name">
            </div>
            <div class="form-group">
                <label for="url">URL</label>
                <input type="text" class="form-control font-size-12" name="url" placeholder="#">
            </div>
            <div class="form-group">
                <label for="icon">Icon (Optional)</label>
                <input type="text" class="form-control font-size-12" id="iconHelp" name="icon" placeholder="Icon">
                <small id="iconHelp" class="form-text text-muted">
                    E.g: &lt;i class=&quot;bi bi-list&quot;&gt;&lt;/i&gt;
                </small>
            </div>
            <div class="form-group text-center mb-0">
                <button type="button" onclick="createItem(this)" 
                class="btn btn-primary btn-sm mr-2 mb-2 font-size-12 text-light">
                    Add Menu
                </button>
            </div>
        </form>
    </div>
</div>