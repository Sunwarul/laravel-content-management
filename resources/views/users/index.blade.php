@extends('layouts.app')

@section('title', 'All Users')

@push('css')

@endpush

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>All Users</h1>
        </div>
        <div class="card-body">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Avatar</th>
                        <th>Role</th>
                        <th>Change Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <img src="{{ Gravatar::src($user->email) }}" style="border-radius: 50%">
                        </td>
                        <td>{{ $user->role }}</td>
                        <td>
                            @if($user->role != 'admin')
                            <form action="{{ route('users.make-admin', $user->id) }}" method="POST">
                                @csrf
                                <input type="submit" class="btn btn-success" value="Make Admin">
                            </form>
                            @elseif(($user->id != 1))
                            <form action="{{ route('users.make-writer', $user->id) }}" method="POST">
                                @csrf
                                <input type="submit" class="btn btn-warning" value="Make Writer 🖊🖋">
                            </form>
                            @else
                            <em>Super Admin </em> ☕
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@push('js')

@endpush
