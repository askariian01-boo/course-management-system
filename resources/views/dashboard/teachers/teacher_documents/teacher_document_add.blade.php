@extends('dashboard.master')
@section('content')
<div class="card mt-3 ml-3 mr-3">
     <div class="card-body">
        <h4 class="card-title">Create New Document </h4><br>
            <form class="form-sample" action="{{ route('teacher_document_save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                     <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">Doc Name</label>
                          <div class="col-sm-9">
                            <input type="text" pattern="^[A-Za-z _-]+$" title="Only English letters, spaces, hyphens (-), and underscore (_) are allowed!" placeholder="enter document name" class="form-control" required  name="document_name">
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
                            <input type="file" class="form-control" required name="document_file">
                             @error('document_file')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                      </div>
                        <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">Uploade_Date</label>
                          <div class="col-sm-9">
                            <input type="Date" value="{{ date('Y-m-d') }}" required  class="form-control" name="uploade_date">
                            @error('uplode_date')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">teacher</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="teacher_id">
                              @foreach($teachers as $teacher)
                                    <option value="{{$teacher->id}}">{{$teacher->FirstName}}  {{$teacher->LastName}}</option>
                                @endforeach
                            </select>
                             @error('teacher')
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
@endsection