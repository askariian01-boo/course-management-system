@extends('dashboard.master')

@section('content')
    <div class="card mt-3 ml-3 mr-3">
        <div class="card-body">
            <h4 class="">
               update staff user account
            </h4><br>
            <form method="POST" action="{{ route('user_update', $user->id) }}">
                @csrf
                <div class="row">

                    <!-- USER NAME -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label fw-bold">User Name:</label>
                            <div class="col-sm-9">
                                <input type="text" name="user_name" pattern="^[A-Za-z0-9_-]+$" class="form-control"
                                    required value="{{ $user->user_name  }}">

                                @error('user_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="font-weight:600;">role name :</label>
                            <div class="col-sm-9">
                                <select name="roles" id="" class="form-control form-select" required>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }} >{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('roles')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <input type="submit" value="save" class="btn btn-info btn-sm">
                <a href="{{ route('user_list') }}" class="btn btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i>back</a>

            </form>
        </div>

    </div>
@endsection
