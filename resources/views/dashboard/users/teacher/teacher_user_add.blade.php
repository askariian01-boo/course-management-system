@extends('dashboard.master')

@section('content')
<div class="card mt-3 ml-3 mr-3">
    <br>
    <div class="card-body">
        <h4 style="font-weight:600; font-size:22px;">Create new teacher user account</h4>
<br>
        <form class="form-sample" method="POST" action="{{ route('teacher_user_save') }}">
            @csrf

            <div class="row">

                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" style="font-weight: bold; margin-top:-6px;">
                            user name :
                        </label>

                        <div class="col-sm-9">
                            <input type="text" name="user_name"
                                pattern="^[A-Za-z _-]+$"
                                required
                                placeholder="enter your user name"
                                class="form-control">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" style="font-weight: bold; margin-top:-6px;">
                            password :
                        </label>

                        <div class="col-sm-9">
                            <input type="password" name="password"
                                required
                                placeholder="enter your password"
                                class="form-control">
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" style="font-weight: bold; margin-top:-6px;">
                            confirm password :
                        </label>

                        <div class="col-sm-8">
                            <input type="password" name="password_confirmation"
                                required
                                placeholder="confirm password"
                                class="form-control">
                        </div>
                    </div>
                </div>

            </div>

            <input type="submit" value="save" class="btn btn-info">
        </form>

    </div>
</div>
@endsection