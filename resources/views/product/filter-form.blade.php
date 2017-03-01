<form class="form-inline form-group" action="{{ route('product') }}" method="get">
        <label for="search">Search:</label>
        <input type="text" class="form-control" name="search" placeholder="Search...">

        <label for="field">in:</label>
        <select class="form-control" name="field">
            <option value="" selected>All</option>
            <option value="style">Style</option>
            <option value="description">Description</option>
            <option value="warranty">Warranty</option>
            <option value="class">Class</option>
        </select>
        &nbsp;&nbsp;
        <label for="product">Brand:</label>
        <select class="form-control" name="brand">
            <option value="" selected>All</option>
            <option value="rbh">Ricardo Beverly Hills</option>
            <option value="skye">Skye</option>
        </select>
        &nbsp;&nbsp;
        <input type="submit" value="Filter" class="btn btn-primary" />
</form>