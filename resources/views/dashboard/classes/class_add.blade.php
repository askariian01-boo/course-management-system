@extends('dashboard.master')
@section('content') 
    <div class="card  mt-3 ml-3 mr-3">
     <div class="card-body">
        <h4 class="card-title">Create New classes </h4><br>
            <form class="form-sample" action="{{route('class_save')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                     <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">Class Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" pattern="^[A-Za-z _-]+$" title="Only English letters, spaces, hyphens (-), and underscore (_) are allowed!" placeholder="enter class name" required name="ClassName">
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
                            <input type="number" placeholder="enter class fees" class="form-control" required name="ClassFees">
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
                              <input type="text" placeholder="enter class description (optional)" class="form-control" required name="description">
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
                            <input type="number" placeholder="enter class capacity (optional)" class="form-control" required name="capacity">
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
                            <input type="file" placeholder="enter image URL (optional)" class="form-control" required name="image">
                             @error('image')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                      </div>
                    </div>
                    <input type="submit" class="btn btn-info" value="Save">
                </div>
            </form>
        </div>
      </div>
@endsection