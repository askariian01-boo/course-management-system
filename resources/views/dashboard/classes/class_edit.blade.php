@extends('dashboard.master')
@section('content')
  <div class="card  mt-3 ml-3 mr-3">
     <div class="card-body">
        <h4 class="card-title">Create New classes </h4><br>
            <form class="form-sample" action="{{route('class_update' , $class->id)}}" method="POST">
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
                    </div>
                    <input type="submit" class="btn btn-info btn-sm" value="Save">
                    <a href="{{ route('classes') }}" class="btn btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i>back</a>
                </div>
            </form>
        </div>
        </div>
@endsection