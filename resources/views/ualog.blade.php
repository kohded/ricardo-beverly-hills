@extends('layouts.master')

@section('content')

  <div>

  <h1>UA LOG</h1>

  <div class="table-responsive">
    <table class="table table-hover table-condensed">
    <thead>
      <tr>
        <th>
          User
        </th>
        <th>
          Role
        </th>
        <th>
          Activated At
        </th>
        <th>
          Action
        </th>
        <th>
          Details
        </th>
      </tr>
    </thead>

    <tbody>
    @foreach($logs as $log)
      <tr>
        <td>
          {{ $log->username }}
        </td>
        <td>
          {{ str_replace(['"', '[', ']'], '', $log->user_role) }}
        </td>
        <td>
          {{ $log->created_at }}
        </td>
        <td>
          {{ $log->action }}
        </td>
        <td>
          <a href="{{ URL::route('ua-log-details', ['logId' => $log->id]) }}" class="btn btn-default">More Details</a>
        </td>
      </tr>
    @endforeach
    </tbody>
    </table>
  </div>

  <div class="row">
    <div class="col-xs-12 text-center">
      {{ $logs->links() }}
    </div>
  </div>

  <div>
@endsection