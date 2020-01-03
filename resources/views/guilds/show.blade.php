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
                <a class="btn btn-primary" href="{{ route('guilds.edit', $guild->id) }}">Edit</a>
                <a class="btn btn-primary" href="{{ route('guilds.index') }}">Back</a>
            </div>
        </div>
    </div>
@endsection