@extends('dashboard.master')
@section('content')
<div class="card mt-3 ml-3 mr-3">
     <div class="card-body">
        <h4 class="card-title">Create New Teacher </h4><br>
            <form class="form-sample" action="{{ route('teacher_save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                     <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">First Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" pattern="^[A-Za-z _-]+$" title="Only English letters, spaces, hyphens (-), and underscore (_) are allowed!" placeholder="enter first name" required  name="FirstName">
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
                            <input type="text" class="form-control" required pattern="^[A-Za-z _-]+$" title="Only English letters, spaces, hyphens (-), and underscore (_) are allowed!" placeholder="enter last name" name="LastName">
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
                            <input type="text" class="form-control" required pattern="^[A-Za-z _-]+$" title="Only English letters, spaces, hyphens (-), and underscore (_) are allowed!" placeholder="enter father name" name="FatherName">
                            @error('FatherName')
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
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">Marital_State</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="MaritalStatus">
                              <option value="0">Single</option>
                              <option value="1">Married</option>
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
                            <input type="number" required pattern="^07[0-9]{8}$" title="The phone number must start with 07 and contain 10 digits" placeholder="enter phone number" class="form-control" name="Phone">
                             @error('Phone')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">Birth_Day </label>
                          <div class="col-sm-9">
                            <input type="Date" class="form-control" placeholder="enter reg date" required  value="{{ Date('Y-m-d') }}" name="BirthDay">
                             @error('BirthDay')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                      </div>
                       <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">Email </label>
                          <div class="col-sm-9">
                            <input type="email" class="form-control" placeholder="enter email address " required  name="Email">
                             @error('Email')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                      </div>
                       <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">NIC Cart</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" pattern="^[0-9-]+$" title="Only numbers and hyphens are allowed." placeholder="enter nic cart" required  name="NIC">
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
                            <input type="text" class="form-control" placeholder="enter your address" required  name="Address">
                            @error('Address')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">Edu_Degree</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" required pattern="^[A-Za-z _-]+$" title="Only English letters, spaces, hyphens (-), and underscore (_) are allowed!" placeholder="enter education degree" name="EducationDegree">
                            @error('EducationDegree')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">University</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" pattern="^[A-Za-z _-]+$" title="Only English letters, spaces, hyphens (-), and underscore (_) are allowed!" placeholder="enter education university" required  name="EducationUniversity">
                            @error('EducationUniversity')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">Edu_Year</label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control" required placeholder="enter education year" name="EducationYear">
                            @error('EducationYear')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">Talnet_Score</label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control" placeholder="enter talnet score" required  name="TalnetScore">
                            @error('TalnetScore')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                      </div>
                       <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">Gross Salary</label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control" placeholder="enter gross salary" required  name="GrossSalary">
                            @error('GrossSalary')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">photo</label>
                          <div class="col-sm-9">
                            <input type="file" class="form-control" required  name="Image">
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
                            <input type="Date" placeholder="enter reg date" class="form-control" required  value="<?php echo Date('Y-m-d'); ?>" name="RegDate">
                            @error('RegDate')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                      </div>
                       <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">account</label>
                          <div class="col-sm-9">
                            <select class="form-control form-select" required name="user_id">
                              <option>choose acount</option>
                              @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->user_name}}</option>
                              @endforeach
                            </select>
                             @error('user_id')
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