@extends('dashboard.master')
@section('content')
    <div class="card mt-3 ml-3 mr-3">
        <div class="card-body">
            <h4 class="card-title">Edit Teacher </h4><br>
            <form class="form-sample" action="{{ route('teacher_update', $teacher->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="font-weight:600;">First Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" required pattern="^[A-Za-z _-]+$"
                                    title="Only English letters, spaces, hyphens (-), and underscore (_) are allowed!"
                                    value="{{ $teacher->FirstName }}" name="FirstName">
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
                                <input type="text" class="form-control" pattern="^[A-Za-z _-]+$"
                                    title="Only English letters, spaces, hyphens (-), and underscore (_) are allowed!"
                                    required value="{{ $teacher->LastName }}" name="LastName">
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
                                <input type="text" class="form-control" required pattern="^[A-Za-z _-]+$"
                                    title="Only English letters, spaces, hyphens (-), and underscore (_) are allowed!"
                                    value="{{ $teacher->FatherName }}" name="FatherName">
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
                                    <option value="0"{{ $teacher->Gender == 0 ? 'selected' : '' }}>Male</option>
                                    <option value="1"{{ $teacher->Gender == 1 ? 'selected' : '' }}>Female</option>
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
                                    <option value="0" {{ $teacher->MaritalStatus == 0 ? 'selected' : '' }}>Single
                                    </option>
                                    <option value="1" {{ $teacher->MaritalStatus == 1 ? 'selected' : '' }}>Married
                                    </option>
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
                                <input type="number" class="form-control" pattern="^07[0-9]{8}$"
                                    title="The phone number must start with 07 and contain 10 digits" required
                                    value="{{ $teacher->Phone }}" name="Phone">
                                @error('phone')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="font-weight:600;">Birth_Day </label>
                            <div class="col-sm-9">
                                <input type="Date" class="form-control" required value="{{ $teacher->BirthDay }}"
                                    name="BirthDay">
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
                                <input type="email" class="form-control" required value="{{ $teacher->Email }}"
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
                                <input type="text" class="form-control" pattern="^[0-9-]+$"
                                    title="Only numbers and hyphens are allowed." required value="{{ $teacher->NIC }}"
                                    name="NIC">
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
                                <input type="text" class="form-control" required value="{{ $teacher->Address }}"
                                    name="Address">
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
                                <input type="text" pattern="^[A-Za-z _-]+$"
                                    title="Only English letters, spaces, hyphens (-), and underscore (_) are allowed!"
                                    class="form-control" required value="{{ $teacher->EducationDegree }}"
                                    name="EducationDegree">
                                @error('EducationDegree')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="font-weight:600;">EduUniversity</label>
                            <div class="col-sm-9">
                                <input type="text" pattern="^[A-Za-z _-]+$"
                                    title="Only English letters, spaces, hyphens (-), and underscore (_) are allowed!"
                                    class="form-control" required value="{{ $teacher->EducationUniversity }}"
                                    name="EducationUniversity">
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
                                <input type="number" class="form-control" required
                                    value="{{ $teacher->EducationYear }}" name="EducationYear">
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
                                <input type="number" class="form-control" required value="{{ $teacher->TalnetScore }}"
                                    name="TalnetScore">
                                @error('TalnetScore')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="font-weight:600;">Grass Salary</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" required value="{{ $teacher->GrossSalary }}"
                                    name="GrassSalary">
                                @error('GrassSalary')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="font-weight:600;">photo</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" required name="Image">
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
                                <input type="Date" class="form-control" required value="{{ $teacher->RegDate }}"
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
                                            {{ isset($teacher) && $user->id == $teacher->user_id ? 'selected' : '' }}>
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
                <a href="{{ route('teacher_list') }}" class="btn btn btn-sm btn-primary"><i
                        class="fa fa-arrow-left"></i>back</a>
        </div>
        </form>
    </div>
@endsection
