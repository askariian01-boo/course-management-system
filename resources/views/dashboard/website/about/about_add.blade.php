@extends('dashboard.master')
@section('content')
<div class="card mt-3 ml-3 mr-3">
     <div class="card-body">
        <h4 class="card-title"> create abouts course </h4><br>
            <form class="form-sample" action="{{ route('about_save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                     <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label" style="font-weight:600;">about title : </label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control"  placeholder="enter about title" required name="title">
                             @error('title')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label" style="font-weight:600;">description : </label>
                          <div class="col-sm-10">
                            <textarea name="description" class="form-control" id="" cols="30" rows="10"></textarea>
                             @error('description')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label" style="font-weight:600;">about image : </label>
                          <div class="col-sm-10">
                            <input type="file" class="form-control" required name="image">
                             @error('image')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn btn-info" value="Save">
            </form>
        </div>
@endsection