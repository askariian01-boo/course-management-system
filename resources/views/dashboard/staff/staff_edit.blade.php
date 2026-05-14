@extends('dashboard.master')
@section('content')
    <div class="card mt-3 ml-3 mr-3">
            <div class="card-body">
                <h4 class="card-title">edit employee </h4><br>
                <form class="form-sample" action="{{ route('staff_update', $staff->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" style="font-weight:600;">First Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" required value="{{ $staff->FirstName }}"
                                        name="FirstName" pattern="^[A-Za-z _-]+$" title="Only English letters, spaces, hyphens (-), and underscore (_) are allowed!">
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
                                    <input type="text" class="form-control" required value="{{ $staff->LastName }}"
                                        name="LastName" pattern="^[A-Za-z _-]+$" title="Only English letters, spaces, hyphens (-), and underscore (_) are allowed!">
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
                                    <input type="text" class="form-control" required value="{{ $staff->FatherName }}"
                                        name="FatherName" pattern="^[A-Za-z _-]+$" title="Only English letters, spaces, hyphens (-), and underscore (_) are allowed!">
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
                                    <select class="form-control" name="gender">
                                        <option value="0"{{ $staff->Gender == 0 ? 'selected' : '' }}>Male</option>
                                        <option value="1"{{ $staff->Gender == 1 ? 'selected' : '' }}>Female</option>
                                    </select>
                                    @error('gender')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" style="font-weight:600;">Phone </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" pattern="^07[0-9]{8}$" title="The phone number must start with 07 and contain 10 digits" required value="{{ $staff->phone }}"
                                        name="phone">
                                    @error('phone')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" style="font-weight:600;">Email </label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" required value="{{ $staff->Email }}"
                                    name="Email">
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
                                    <input type="text" class="form-control" required value="{{ $staff->NIC }}"
                                        name="NIC" pattern="^[0-9-]+$" title="Only numbers and hyphens are allowed.">
                                    @error('NIC')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" style="font-weight:600;">Position</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" required value="{{ $staff->Position }}"
                                        name="Position" pattern="^[A-Za-z _-]+$" title="Only English letters, spaces, hyphens (-), and underscore (_) are allowed!">
                                    @error('Position')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" style="font-weight:600;">Address</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" required value="{{ $staff->Address }}"
                                        name="Address">
                                    @error('Address')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" style="font-weight:600;">Grass Salary</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" required
                                        value="{{ $staff->GrossSalary }}" name="GrossSalary">
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
                                    <input type="file" class="form-control" value="{{ $staff->Image }}"
                                        name="Image">
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
                                    <input type="Date" class="form-control" required value="{{ $staff->RegDate }}"
                                        name="RegDate">
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
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ isset($teacher) && $user->id == $staff->user_id ? 'selected' : '' }}>
                                            {{ $user->user_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    </div>
                    <input type="submit" class="btn btn-info btn-sm" value="Save">
                    <a href="{{ route('staff_list') }}" class="btn btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i>back</a>
            </div>
            </form>
        </div>
    </div>
    </div>
@endsection
