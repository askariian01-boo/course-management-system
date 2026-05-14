@extends('dashboard.master')
@section('content')
<div class="card mt-3 ml-3 mr-3">
     <div class="card-body">
        <h4 class="card-title">Create New student </h4><br>
            <form class="form-sample" action="{{ route('student_save') }}" method="POST" enctype="multipart/form-data" data-all-required>
                @csrf
                <div class="row">
                     <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">First Name</label>
                          <div class="col-sm-9">
                            <input type="text" data-type="text" class="form-control"  pattern="^[A-Za-z _-]+$" title="Only English letters, spaces, hyphens (-), and underscore (_) are allowed!" placeholder="enter first name" required  name="FirstName">
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
                            <input type="text" data-type="text" class="form-control" required  pattern="^[A-Za-z _-]+$" title="Only English letters, spaces, hyphens (-), and underscore (_) are allowed!" placeholder="enter last name "  name="LastName">
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
                            <input type="text" data-type="text" class="form-control"  pattern="^[A-Za-z _-]+$" title="Only English letters, spaces, hyphens (-), and underscore (_) are allowed!" placeholder="enter father name" required  name="FatherName">
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
                            <input type="Date" class="form-control" required  value="01/01/2004" name="BirthDay">
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
                              <option value="0">Male</option>
                              <option value="1">Female</option>
                            </select>
                             @error('Gender')
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
                              <option value="0">Single</option>
                              <option value="1">Marreid</option>
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
                            <input type="number" data-type="phone" pattern="^07[0-9]{8}$" title="The phone number must start with 07 and contain 10 digits" placeholder="enter phone nmber" class="form-control" required  name="Phone">
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
                            <input type="text" data-type="nic" class="form-control" pattern="^[0-9-]+$" title="Only numbers and hyphens are allowed." placeholder="enter nic cart" required  name="NIC">
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
                            <input type="text" data-type="text" class="form-control" placeholder="enter your address" required  name="Address">
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
                            <input type="file" data-type="file" class="form-control" required  name="Image">
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
                            <input type="Date" class="form-control" required placeholder="enter reg date"  value="<?php echo Date('Y-m-d'); ?>" name="RegDate">
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
                    <input type="submit" class="btn btn-info" value="Save">
                </div>
            </form>
        </div>
@endsection