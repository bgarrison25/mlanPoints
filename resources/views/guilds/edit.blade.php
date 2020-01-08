@extends('layouts.app')

@section('content')
    <div class="card-header">Edit Guild (<a href="{{ route('guilds.show', $guild->id) }}">logs</a>)</div>
    <div class="card-body">
        <p class="alert alert-success success-message" style="display: none"> </p>
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
                        <input type="text" name="data[name]" value="{{ $guild->name }}" class="form-control" placeholder="Name" />
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Points:</strong>
                        <input id="points" type="number" name="data[points]" value="{{ $guild->points }}" class="form-control" />
                    </div>
                </div>
                <div id="buttons" class="col-xs-12 col-sm-12 col-md-12 text-right">
                    <a class="btn btn-primary" href="{{ route('guilds.index') }}"> Back</a>
                    <button type="submit" id="points-submit" class="btn btn-primary" data-amount="{{ $guild->points }}" data-guild="{{ $guild->id }}" data-guildName="{{ $guild->name }}">Submit</button>
                </div>
            </div>
        </form>
        @include('modals.editPoints')
@endsection
@push('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('#points').on('change', function(e) {
            $('#points-submit').data('amount', $(e.target).val()).addClass('point-adder');
        })
    });

    $('#buttons').on('click', '.point-adder', function(e) {
        e.preventDefault();
        $('#exampleModal').modal('toggle', $(this));
    });
</script>
@endpush