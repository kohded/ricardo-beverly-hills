@extends('layouts.master')

@section('content')
    <div id="repair-center-list">
        <div class="row">
            <div class="col-xs-12">
                <h1>Repair Centers</h1>

                {{--Delete repair center alertr--}}
                @if(Session::has('name'))
                    <p class="alert alert-danger">
                        {{ Session::get('name') }}
                    </p>
                @endif

                {{--Create button--}}
                <a href="{{ route('repair-center.create') }}"
                   class="btn btn-primary">Create Repair Center
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Contact Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($repairCenters as $repairCenter)
                            <tr>
                                <td>{{ $repairCenter->name }}</td>
                                <td>{{ $repairCenter->contact_name }}</td>
                                <td>{{ $repairCenter->phone }}</td>
                                <td>{{ $repairCenter->email }}</td>
                                <td>{{ $repairCenter->address }}</td>
                                <td>{{ $repairCenter->city }}</td>
                                <td>{{ $repairCenter->state }}</td>
                                <td>
                                    <a href="{{ route('repair-center.edit', [
                                        'id' => $repairCenter->id
                                        ]) }}" class="btn btn-success">Edit
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('repair-center.delete', [
                                            'id' => $repairCenter->id,
                                            'name' => $repairCenter->name
                                        ]) }}" class="btn btn-danger">Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 text-center">
                {{ $repairCenters->links() }}
            </div>
        </div>
    </div>
@endsection