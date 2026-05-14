@extends('dashboard.master')
@section('content')
    <div class="card mt-3 ml-3 mr-3">
        <div class="card-body">
            <h4 class="card-title">edit permissions </h4><br>
            <form class="form-sample" action="{{ route('update_permission' , $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="font-weight:600;">name </label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ $data->name }}" name="name" class="form-control" required
                                    placeholder="enter permission name">
                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="font-weight:600;">group name</label>
                            <div class="col-sm-9">
                                <select class="form-control form-select" name="group_name" required>
                                    <option value="" disabled selected>select group name</option>
                                    <option {{ $data->group_name =='employees' ? 'selected' : '' }} value="employees">employees</option>
                                    <option {{ $data->group_name =='employee_attendance' ? 'selected' : '' }} value="employee_attendance">employee_attendance</option>
                                    <option {{ $data->group_name =='employees_salary' ? 'selected' : '' }} value="employees_salary">employees_salary</option>
                                    <option {{ $data->group_name =='employees_document' ? 'selected' : '' }} value="employees_document">employees_document</option>
                                    <option {{ $data->group_name =='teachers' ? 'selected' : '' }} value="teachers">teachers</option>
                                    <option {{ $data->group_name =='teacher_attendance' ? 'selected' : '' }} value="teacher_attendance">teacher_attendance</option>
                                    <option {{ $data->group_name =='teacher_salary' ? 'selected' : '' }} value="teacher_salary">teacher_salary</option>
                                    <option {{ $data->group_name =='teacher_document' ? 'selected' : '' }} value="teacher_document">teacher_document</option>
                                    <option {{ $data->group_name =='students' ? 'selected' : '' }} value="students">students</option>
                                    <option {{ $data->group_name =='student_attendance' ? 'selected' : '' }} value="student_attendance">student_attendance</option>
                                    <option {{ $data->group_name =='student_document' ? 'selected' : '' }} value="student_document">student_document</option>
                                    <option {{ $data->group_name =='class_subject' ? 'selected' : '' }} value="class_subject">class & subject</option>
                                    <option {{ $data->group_name =='exam_score' ? 'selected' : '' }} value="exam_score">exam & score</option>
                                    <option {{ $data->group_name =='finance' ? 'selected' : '' }} value="finance">finance</option>
                                    <option {{ $data->group_name =='student_fees' ? 'selected' : '' }} value="student_fees">student_fees</option>
                                    <option {{ $data->group_name =='users' ? 'selected' : '' }} value="users">users</option>
                                    <option {{ $data->group_name =='role_permission' ? 'selected' : '' }} value="role_permission">role & permission</option>
                                </select>
                                @error('group_name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn btn-info btn-sm" value="Save">
                <a href="{{ route('list_permission') }}" class="btn btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i>back</a>
            </form>
        </div> <!-- ✅ اینجا اضافه کردم -->
    </div>
@endsection
