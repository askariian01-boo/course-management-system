@extends('dashboard.master')
@section('content')
<div class="card mt-3 ml-3 mr-3">
     <div class="card-body">
        <h4 class="card-title">Edit Documents </h4><br>
            <form class="form-sample" action="{{ route('staff_document_update' , $document->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                     <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">Doc Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" required pattern="^[A-Za-z _-]+$" title="Only English letters, spaces, hyphens (-), and underscore (_) are allowed!" value="{{$document -> document_name}}" name="document_name">
                             @error('document_name')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">Doc File</label>
                          <div class="col-sm-9">
                            <input type="file" class="form-control" required  name="document_file">
                             @error('document_file')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                      </div>
                        <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">uploadeDate</label>
                          <div class="col-sm-9">
                            <input type="Date"  required  value="{{ $document->uplode_date}}" class="form-control" name="uplode_date">
                            @error('uplode_date')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">Staff</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="staff_id">
                              @foreach($staffs as $staff)
                                    <option value="{{$staff->id}}">{{$staff->FirstName}}  {{$staff->LastName}}</option>
                                @endforeach
                            </select>
                             @error('staff')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                      </div>

                    </div>
                    <input type="submit" class="btn btn-info btn-sm " value="Save">
                    <a href="{{ route('staff_document') }}" class="btn btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i>back</a>
                </div>
            </form>
        </div>
@endsection