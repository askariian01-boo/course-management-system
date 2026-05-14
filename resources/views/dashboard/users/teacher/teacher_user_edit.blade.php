@extends('dashboard.master')

@section('content')
<div class="card mt-3 ml-3 mr-3">
    <br>
    <div class="card-body">
        <h4 class="card-title" style="font-weight:600;">Edit Teacher User Account</h4>

        <form class="form-sample" method="POST" action="{{ route('teacher_user_update', $user->id) }}">
            @csrf

            <div class="row">

                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" style="font-weight: bold; margin-top:-6px;">
                            user name :
                        </label>

                        <div class="col-sm-9">
                            <input type="text" name="user_name"
                                value="{{ $user->user_name }}"
                                pattern="^[A-Za-z _-]+$"
                                required
                                class="form-control">
                        </div>
                    </div>
                </div>

            </div>

            <input type="submit" value="update" class="btn btn-primary btn-sm">
            <a href="{{ route('teacher_user_list') }}" class="btn btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i>back</a>
        </form>

    </div>
</div>
@endsection