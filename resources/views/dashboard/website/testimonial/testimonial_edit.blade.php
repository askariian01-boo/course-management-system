@extends('dashboard.master')
@section('content')
<div class="card mt-3 ml-3 mr-3">
     <div class="card-body">
        <h4 class="card-title"> edit student testimonials </h4><br>
            <form class="form-sample" action="{{ route('testimonial_update' , $testimonial->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                     <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">student name : </label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control"  placeholder="enter student name" required name="name" value="{{ $testimonial->name }}">
                             @error('name')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                           </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">positions : </label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control"  placeholder="enter student position" required name="position" value="{{ $testimonial->position }}">
                             @error('position')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                           </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">student message : </label>
                          <div class="col-sm-9">
                            <textarea name="message" class="form-control" id="" cols="30" rows="6">{{ $testimonial->message }}</textarea>
                             @error('message')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">student image : </label>
                          <div class="col-sm-9">
                            <input type="file" class="form-control" value="{{ $testimonial->image }}" name="image">
                             @error('image')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">testimonial reting : </label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control"  placeholder="Please rate the educational center from 1 to 10" required name="reting" min="1" max="10" value="{{ $testimonial->rating }}">
                             @error('reting')
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