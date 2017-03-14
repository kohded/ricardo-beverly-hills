<form class="form-inline form-group" action="{{ route('claim-index') }}" method="get">
        <label for="search">Search:</label>
        <input type="text" class="form-control" name="search" placeholder="Search...">

        <label for="field">in:</label>
        <select class="form-control" name="field">
            <option value="" selected>All</option>
            <option value="claim">Claim #</option>
            <option value="cust">Customer</option>
            <option value="rc">Repair Center</option>
            <option value="product">Product</option>
        </select>
        &nbsp;&nbsp;
        <label for="product">Product:</label>
        <select class="form-control" name="product">
            <option value="" selected>All</option>
            @foreach ($products as $product)
                <option value="{{ $product->style }}">
                    {{ $product->style }}
                </option>
            @endforeach
        </select>
        &nbsp;&nbsp;
        <label for="rc">RC:</label>
        <select class="form-control" name="rc">
            <option value="" selected>All</option>
            @foreach ($repair_centers as $rc)
                <option value="{{ $rc->id }}">
                    {{ $rc->name }}
                </option>
            @endforeach
        </select>
        &nbsp;&nbsp;
        <label for="status">Status:</label>
        <select class="form-control" name="status">
            <option value="" selected>All</option>
            <option>Open</option>
            <option>Closed</option>
        </select>
        &nbsp;&nbsp;
        <input type="submit" value="Filter" class="btn btn-primary" />
</form>