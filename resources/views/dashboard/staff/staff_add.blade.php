@extends('dashboard.master')
@section('content')

    <div class="card mt-3 ml-3 mr-3">
        <div class="card-body">
            <h4 class="card-title">Create New Employee </h4><br>
            <form class="form-sample" action="{{ route('staff_save') }}" method="POST" enctype="multipart/form-data"
                data-all-required>
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="font-weight:600;">First Name</label>
                            <div class="col-sm-9">
                                <input type="text" pattern="^[A-Za-z _-]+$" title="Only English letters, spaces, hyphens (-), and underscore (_) are allowed!"
                                placeholder="enter first name" data-type="text" class="form-control" required name="FirstName">
                                @error('FirstName')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="font-weight:600;">last name</label>
                            <div class="col-sm-9">
                                <input type="text" pattern="^[A-Za-z _-]+$" title="Only English letters, spaces, hyphens (-), and underscore (_) are allowed!"
                                    placeholder="enter last name" data-type="text" class="form-control" required
                                    name="LastName">
                                @error('LastName')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="font-weight:600;">father name</label>
                            <div class="col-sm-9">
                                <input type="text" pattern="^[A-Za-z _-]+$" title="Only English letters, spaces, hyphens (-), and underscore (_) are allowed!" 
                                placeholder="enter father name" data-type="text" class="form-control" required name="FatherName">
                                @error('FatherName')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="font-weight:600;">gender</label>
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
                            <label class="col-sm-3 col-form-label" style="font-weight:600;">phone </label>
                            <div class="col-sm-9">
                                <input type="number" placeholder="enter phone number" pattern="^07[0-9]{8}$" title="The phone number must start with 07 and contain 10 digits" data-type="phone"
                                    class="form-control" required name="phone">
                                @error('phone')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="font-weight:600;">email </label>
                            <div class="col-sm-9">
                                <input type="email" placeholder="enter email"
                                    data-type="email" class="form-control" required
                                    name="Email">
                                @error('Email')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="font-weight:600;">nic cart</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="enter nic cart" data-type="nic" pattern="^[0-9-]+$" title="Only numbers and hyphens are allowed." class="form-control"
                                    required name="NIC">
                                @error('NIC')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="font-weight:600;">position</label>
                            <div class="col-sm-9">
                                <input type="text" pattern="^[A-Za-z _-]+$" title="Only English letters, spaces, hyphens (-), and underscore (_) are allowed!"
                                    placeholder="enter position" data-type="text" class="form-control" required
                                    name="Position">
                                @error('Position')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="font-weight:600;">address</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="enter your address" data-type="text"
                                    class="form-control" required name="Address">
                                @error('Address')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="font-weight:600;">gross salary</label>
                            <div class="col-sm-9">
                                <input type="number" placeholder="enter salary" data-type="number" class="form-control"
                                    required name="GrossSalary">
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
                                <input type="file" data-type="file" class="form-control" required name="Image">
                                @error('Image')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="font-weight:600;">reg date</label>
                            <div class="col-sm-9">
                                <input type="Date" class="form-control" required value="<?php echo Date('Y-m-d'); ?>"
                                    name="RegDate">
                                @error('RegDate')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="font-weight:600;">acount</label>
                            <div class="col-sm-9">
                                <select class="form-control form-select" name="user_id">
                                    <option>select acount</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->user_name }}</option>
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
    </div>
    </div>
@endsection
