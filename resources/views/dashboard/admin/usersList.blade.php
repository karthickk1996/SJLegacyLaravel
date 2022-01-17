@extends('dashboard.base')

@section('content')

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 ">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify pr-2"></i>{{ __('Users') }}</div>
                        <div class="card-body">
                            <table class="table table-responsive-sm table-striped">
                                <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>E-mail</th>
                                    <th>Roles</th>
                                    <th>Created at</th>
                                    <th>Actions</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->menuroles }}</td>
                                        <td>{{ $user->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ route('users.show', $user)}}"
                                               class="btn btn-block btn-primary">View</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('users.edit', $user) }}"
                                               class="btn btn-block btn-primary">Edit</a>
                                        </td>
                                        <td>
                                            @if( $you->id !== $user->id )
                                                <form action="{{ route('users.destroy', $user) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-block btn-danger">Delete User</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <hr>
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
                @if(session('success'))
                    <div class="alert alert-danger mt-3" id="alert-success"> {{ session('success') }}</div>
                @endif
            </div>
        </div>
    </div>

@endsection


@section('javascript')

@endsection

