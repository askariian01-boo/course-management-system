@extends('dashboard.master')
@section('content')
    <div class="card mt-3 ml-3 mr-3">
        <div class="card-body">
            <h4 class="card-title">add permissions </h4><br>
            <form class="form-sample" action="{{ route('save_permission') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="font-weight:600;">name </label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" required
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
                                    <option value="employees">employees</option>
                                    <option value="employee_attendance">employee_attendance</option>
                                    <option value="employees_salary">employees_salary</option>
                                    <option value="employees_document">employees_document</option>
                                    <option value="teachers">teachers</option>
                                    <option value="teacher_attendance">teacher_attendance</option>
                                    <option value="teacher_salary">teacher_salary</option>
                                    <option value="teacher_document">teacher_document</option>
                                    <option value="students">students</option>
                                    <option value="student_attendance">student_attendance</option>
                                    <option value="student_document">student_document</option>
                                    <option value="class_subject">class & subject</option>
                                    <option value="exam_score">exam & score</option>
                                    <option value="finance">finance</option>
                                    <option value="users">users</option>
                                    <option value="role_permission">role & permission</option>
                                </select>
                                @error('group_name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn btn-info" value="Save">
            </form>
        </div> <!-- ✅ اینجا اضافه کردم -->
    </div>
@endsection
