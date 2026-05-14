@extends('dashboard.master')
@section('content')
<div class="card mt-3 ml-3 mr-3">
     <div class="card-body">
        <h4 class="card-title">Edit student </h4><br>
            <form class="form-sample" action="{{ route('student_update' , $student->id) }}" method="POST" enctype="multipart/form-data" data-all-required>
                @csrf
                @method('PUT')
                <div class="row">
                     <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">First Name</label>
                          <div class="col-sm-9">
                            <input type="text" data-type="text" pattern="^[A-Za-z _-]+$" title="Only English letters, spaces, hyphens (-), and underscore (_) are allowed!" value="{{$student->FirstName}}" class="form-control" required  name="FirstName">
                             @error('FirstName')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">Last Name</label>
                          <div class="col-sm-9">
                            <input type="text" data-type="text" pattern="^[A-Za-z _-]+$" title="Only English letters, spaces, hyphens (-), and underscore (_) are allowed!" value="{{$student->LastName}}" class="form-control" required  name="LastName">
                             @error('LastName')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                      </div>
                        <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">Father Name</label>
                          <div class="col-sm-9">
                            <input type="text" data-type="text" value="{{$student->FatherName}}" pattern="^[A-Za-z _-]+$" title="Only English letters, spaces, hyphens (-), and underscore (_) are allowed!" class="form-control" required  name="FatherName">
                            @error('FatherName')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                      </div>
                        <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">Birth Day</label>
                          <div class="col-sm-9">
                            <input type="Date" class="form-control" required value="{{$student->BirthDay}}" name="BirthDay">
                            @error('BirthDay')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                      </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">Gender</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="Gender">
                              <option value="0"{{ $student->Gender == 0 ? 'selected' : '' }}>Male</option>
                              <option value="1"{{ $student->Gender == 1 ? 'selected' : '' }}>Female</option>
                            </select>
                             @error('gender')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">maritalStatus</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="MaritalStatus">
                                <option value="0" {{ $student->MaritalStatus == 0 ? 'selected' : '' }}>Single</option>
                                <option value="1" {{ $student->MaritalStatus == 1 ? 'selected' : '' }}>Married</option>
                            </select>
                             @error('MaritalStatus')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                      </div>
                       <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">Phone </label>
                          <div class="col-sm-9">
                            <input type="text" data-type="phone"  value="{{$student->Phone}}" pattern="^07[0-9]{8}$" title="The phone number must start with 07 and contain 10 digits" class="form-control" required  name="Phone">
                             @error('Phone')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                      </div>
                       <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">NIC Cart</label>
                          <div class="col-sm-9">
                            <input type="text" data-type="nic" value="{{$student->NIC}}" pattern="^[0-9-]+$" title="Only numbers and hyphens are allowed." class="form-control" required  name="NIC">
                             @error('NIC')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">Address</label>
                          <div class="col-sm-9">
                            <input type="text" data-type="text" value="{{$student->Address}}" class="form-control" required  name="Address">
                            @error('Address')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">photo</label>
                          <div class="col-sm-9">
                            <input type="file" data-type="file" class="form-control" name="Image">
                            @error('Image')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">Reg Date</label>
                          <div class="col-sm-9">
                            <input type="Date" class="form-control" value="{{$student->RegDate}}" required  value="<?php echo Date('Y-m-d'); ?>" name="RegDate">
                            @error('RegDate')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">Class</label>
                          <div class="col-sm-9">
                            <select name="class_id" id=""  class="form-control form-select">
                                @foreach($classes as $class)
                                    <option value="{{$class->id}}">{{$class->ClassName}}</option>
                                @endforeach
                            </select>
                            @error('class_id')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                      </div>
                    </div>
                    <input type="submit" class="btn btn-info btn-sm" value="Save">
                    <a href="{{ route('students') }}" class="btn btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i>back</a>
                </div>
            </form>
        </div>
@endsection