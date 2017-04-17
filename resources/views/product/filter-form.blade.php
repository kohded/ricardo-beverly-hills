<form class="form-inline form-group" action="{{ route('product') }}" method="get">
        <label for="search">
        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
        </label>
        <input type="text" class="form-control input-sm" name="search" placeholder="Search...">

        <label for="field">in</label>
        <select class="form-control input-sm" name="field">
            <option value="" selected>All</option>
            <option value="style">Style</option>
            <option value="description">Description</option>
            <option value="warranty">Warranty</option>
            <option value="class">Class</option>
        </select>
        &nbsp;&nbsp;
        <label for="product">Brand</label>
        <select class="form-control input-sm" name="brand">
            <option value="" selected>All</option>
            <option value="rbh">Ricardo Beverly Hills</option>
            <option value="skye">Skye</option>
        </select>
        
        &nbsp;
        <button type="submit" class="btn btn-primary btn-sm">
            <span class="glyphicon glyphicon-filter" aria-hidden="true"></span>
            Filter
        </button>
</form>