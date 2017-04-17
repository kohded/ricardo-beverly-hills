<form class="form-inline form-group" action="{{ route('repair-center') }}" method="get">
        <label for="search">
            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
        </label>
        <input type="text" class="form-control input-sm" name="search" placeholder="Search...">

        <label for="field">in</label>
        <select class="form-control input-sm" name="field">
            <option value="" selected>All</option>
            <option value="name">Name</option>
            <option value="contact">Contact</option>
            <option value="email">Email</option>
            <option value="address">Address</option>
            <option value="city">City</option>
            <option value="state">State</option>
        </select>

        &nbsp;
        <button type="submit" class="btn btn-primary btn-sm">
            <span class="glyphicon glyphicon-filter" aria-hidden="true"></span>
            Filter
        </button>
</form>