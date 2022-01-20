@extends('dashboard.base')

@section('content')

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 ">
                    <div class="card">
                        <div class="card-body p-4">
                            <h5 class="card-title">Add New User</h5>
                            <hr/>
                            <form method="POST" action="{{ route('users.store') }}">
                                @csrf
                                <div class="form-body mt-3">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class=" py-3 rounded">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Name</label>
                                                    <input id="name" class="form-control" type="text"
                                                           name="name" value="{{ old("name") }} ">
                                                    @error('name')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input id="email" class="form-control" type="email"
                                                           name="email" value="{{ old("email") }}">
                                                    @error('email')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input id="password" class="form-control" type="password"
                                                           name="password">
                                                    @error('password')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="role" class="form-label">Role</label>
                                                    <br>
                                                    <select class="form-control" name="role_name">
                                                        @foreach( $roles as  $role )
                                                            <option value="{{ $role }}">{{ $role }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('password')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <button class="btn btn-primary" type="submit">Add User</button>
                                            </div>
                                        </div>
                                    </div><!--end row-->
                                </div>
                            </form>
                            @if(session('success'))
                                <div class="alert alert-info mt-3" id="alert-success"> {{ session('success') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('javascript')

@endsection

