@extends('layouts.app')
@section('content')
    <div class="card-header">{{ ucfirst($guild->name) }}</div>
    <div class="card-body">
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    {{ $guild->name }}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-12">
                <div class="form-group">
                    <strong>Points:</strong>
                    {{ $guild->points }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-10 col-sm-10 col-md-10">
                @can('update', $guild)
                <a class="btn btn-primary" href="{{ route('guilds.edit', $guild->id) }}">Edit</a>
                @endcan
                <a class="btn btn-primary" href="{{ route('guilds.index') }}">Back</a>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-10 col-sm-10 col-md-10">
                <p class="h3 mt-2">Point Log</p>
                <table class="table table-sm table-bordered mt-2">
                    <tr>
                        <th>User</th>
                        <th>Amount</th>
                        <th>Reason</th>
                        <th>Date</th>
                    </tr>
                    @forelse ($guild->pointLogs->sortByDesc('created_at'); as $pointLog)
                    <tr>
                        <td class="align-middle">{{ $pointLog->user->name }} ({{ $pointLog->user->email }})</td>
                        <td class="align-middle">{{ $pointLog->amount }}</td>
                        <td class="align-middle">{{ $pointLog->reason }}</td>
                        <td class="align-middle">{{ $pointLog->created_at }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">There are currently no point changes for this guild</td>
                    </tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
@endsection