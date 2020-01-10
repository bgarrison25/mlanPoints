@extends('layouts.app')

@section('content')
    <div class="card-header">Guilds</div>
    <div class="card-body">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        @can('create', App\Guild::class)
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('guilds.create') }}"> Create New Guild</a>
        </div>
        @endcan
        <table class="table table-sm table-bordered mt-2">
            <tr>
                <th>Name</th>
                <th>Points</th>
                @auth
                <th width="280px">Action</th>
                @endauth
            </tr>
            @forelse ($guilds as $guild)
            <tr>
                <td class="align-middle">{{ $guild->name }}</td>
                <td class="align-middle" id="guild-points-{{ $guild->id }}">{{ $guild->points }}</td>
                @auth
                <td class="align-middle">
                    <form action="{{ route('guilds.destroy',$guild->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        @can('view', $guild)
                        <a class="btn btn-sm btn-info" href="{{ route('guilds.show',$guild->id) }}">Show</a>
                        @endcan
                        @can('update', $guild)
                        <a class="btn btn-sm btn-primary" href="{{ route('guilds.edit',$guild->id) }}">Edit</a>
                        @endcan
                        @can('delete', $guild)
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        @endcan
                    </form>
                    @can('update', $guild)
                    <div id="point-buttons" class="mt-1">
                        <a class="btn btn-sm btn-info point-adder" data-amount="{{ $guild->points }}" data-change="1" data-guild="{{ $guild->id }}" data-guildName="{{ $guild->name }}">+1</a>
                        <a class="btn btn-sm btn-info point-adder" data-amount="{{ $guild->points }}" data-change="5" data-guild="{{ $guild->id }}" data-guildName="{{ $guild->name }}">+5</a>
                        <a class="btn btn-sm btn-info point-adder" data-amount="{{ $guild->points }}" data-change="10" data-guild="{{ $guild->id }}" data-guildName="{{ $guild->name }}">+10</a>
                        <a class="btn btn-sm btn-info point-adder" data-amount="{{ $guild->points }}" data-change="-1" data-guild="{{ $guild->id }}" data-guildName="{{ $guild->name }}">-1</a>
                        <a class="btn btn-sm btn-info point-adder" data-amount="{{ $guild->points }}" data-change="-5" data-guild="{{ $guild->id }}" data-guildName="{{ $guild->name }}">-5</a>
                        <a class="btn btn-sm btn-info point-adder" data-amount="{{ $guild->points }}" data-change="-10" data-guild="{{ $guild->id }}" data-guildName="{{ $guild->name }}">-10</a>
                    </div>
                    @endcan
                </td>
                @endauth
            </tr>
            @empty
            <tr>
                <td colspan="3">There are currently no guilds created</td>
            </tr>
            @endforelse
        </table>
        {{ $guilds->links() }}
        @include('modals.editPoints')
    </div>
@endsection
@push('js')
<script type="text/javascript">
$(document).ready(function() {
    $('.point-adder').click('#point-buttons', function(e) {
        var points = $(e.target).data('amount');
        var total = points + parseInt($(e.target).data('change'));
        $(e.target).data('amount', total);
        $('#exampleModal').modal('toggle', $(this));
    });
});
</script>
@endpush
