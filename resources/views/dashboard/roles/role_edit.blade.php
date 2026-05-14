@extends('dashboard.master')
@section('content')
    <div class="card mt-3 ml-3 mr-3">
        <div class="card-body">
            <h4 class="card-title">add roles </h4><br>
            <form class="form-sample" action="{{ route('update_roles' , $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="font-weight:600;">role name </label>
                            <div class="col-sm-9">
                                <input type="text" name="name" value="{{ $data->name }}" class="form-control" required
                                    placeholder="enter roles name">
                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn btn-info btn-sm" value="Save">
                <a href="{{ route('roles') }}" class="btn btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i>back</a>
            </form>
        </div> 
    </div>
@endsection
