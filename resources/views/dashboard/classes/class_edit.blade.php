@extends('dashboard.master')
@section('content')
  <div class="card  mt-3 ml-3 mr-3">
     <div class="card-body">
        <h4 class="card-title">Create New classes </h4><br>
            <form class="form-sample" action="{{route('class_update' , $class->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                     <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">Class Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" pattern="^[A-Za-z _-]+$" title="Only English letters, spaces, hyphens (-), and underscore (_) are allowed!" value="{{$class->ClassName}}" required name="ClassName">
                             @error('ClassName')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">Class Fees</label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control" value="{{$class->ClassFees}}" required name="ClassFees">
                             @error('ClassFees')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">Description</label>
                          <div class="col-sm-9">
                              <input type="text" placeholder="enter class description (optional)" value="{{ $class->description }}" class="form-control" name="description">
                              @error('description')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">Capacity</label>
                          <div class="col-sm-9">
                            <input type="number" placeholder="enter class capacity (optional)" value="{{ $class->capacity }}" class="form-control" name="capacity">
                             @error('capacity')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">Image</label>
                          <div class="col-sm-9">
                            <input type="file" placeholder="enter image URL (optional)" value="{{ $class->image }}" class="form-control" name="image">
                             @error('image')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                      </div>
                    </div>
                    <input type="submit" class="btn btn-info btn-sm" value="Save">
                    <a href="{{ route('classes') }}" class="btn btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i>back</a>
                </div>
            </form>
        </div>
        </div>
@endsection