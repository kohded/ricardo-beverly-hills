<form class="form-inline form-group" action="{{ route('repair-center') }}" method="get">
        <label for="search">Search:</label>
        <input type="text" class="form-control" name="search" placeholder="Search...">

        <label for="field">in:</label>
        <select class="form-control" name="field">
            <option value="" selected>All</option>
            <option value="name">Name</option>
            <option value="contact">Contact</option>
            <option value="email">Email</option>
            <option value="address">Address</option>
            <option value="city">City</option>
            <option value="state">State</option>
        </select>

        &nbsp;&nbsp;
        <input type="submit" value="Filter" class="btn btn-primary" />
</form>