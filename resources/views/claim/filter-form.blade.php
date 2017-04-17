<form class="form-group" action="{{ route('claim-index') }}" method="get">       
    <div class="form-group form-inline">
        <label for="product">Product</label>
        <select class="form-control input-sm" name="product">
            <option value="" selected>All</option>
            @foreach ($products as $product)
                <option value="{{ $product->style }}">
                    {{ $product->style }}
                </option>
            @endforeach
        </select>

        &nbsp;
        <label for="rc">RC</label>
        <select class="form-control input-sm" name="rc">
            <option value="" selected>All</option>
            @foreach ($repair_centers as $rc)
                <option value="{{ $rc->id }}">
                    {{ $rc->name }}
                </option>
            @endforeach
        </select>

        &nbsp;
        <label for="status">Status</label>
        <select class="form-control input-sm" name="status">
            <option value="" selected>All</option>
            <option>Open</option>
            <option>Closed</option>
        </select>
    </div>


    <div class="form-group form-inline">
        <label for="search">
            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
        </label>
        <input type="text" class="form-control input-sm" name="search" placeholder="Search...">

        <label for="field">in</label>
        <select class="form-control input-sm" name="field">
            <option value="" selected>All</option>
            <option value="claim">Claim #</option>
            <option value="cust">Customer</option>
            <option value="rc">Repair Center</option>
            <option value="product">Product</option>
        </select>

        &nbsp;
        <button type="submit" class="btn btn-primary btn-sm">
            <span class="glyphicon glyphicon-filter" aria-hidden="true"></span>
            Filter
        </button>
    </div>
</form>