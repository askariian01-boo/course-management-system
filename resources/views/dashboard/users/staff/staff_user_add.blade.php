@extends('dashboard.master')
@section('content')
    <div class="card mt-3 ml-3 mr-3">
        <br>
        <div class="card-body">
            <h4 class="card-title" style="font-weight:600;">Create new employee user account</h4>
            <form class="form-sample" method="POST" action="{{ route('user_store') }}">
                @csrf
                <div class="row">
                   <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="font-weight: bold; margin-top:-6px;">user name
                                : </label>
                            <div class="col-sm-9">
                                <input type="text" name="user_name" pattern="^[A-Za-z _-]+$"
                                    title="Only English letters, spaces, hyphens (-), and underscore (_) are allowed!"
                                    required placeholder="enter your user name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="font-weight: bold; margin-top:-6px;">password
                                : </label>
                            <div class="col-sm-9">
                                <input type="password" name="password" required placeholder="enter your password"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" style="font-weight: bold; margin-top:-6px;">confirm
                                password : </label>
                            <div class="col-sm-8">
                                <input type="password" name="password_confirmation" required
                                    placeholder="confirmation password" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="font-weight:600;">role name :</label>
                            <div class="col-sm-9">
                                <select name="roles" id="" class="form-control form-select" required>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('roles')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" value="save" class="btn btn-info">
            </form>
        </div>
    </div>
@endsection
