@extends('layouts.app')

@section('content')
    <div class="card-header">Edit Guild</div>
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

        <form action="{{ route('guilds.update',$guild->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        <input type="text" name="name" value="{{ $guild->name }}" class="form-control" placeholder="Name">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Points:</strong>
                        {{ $guild->points }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                <a class="btn btn-primary" href="{{ route('guilds.index') }}"> Back</a>
                <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
@endsection