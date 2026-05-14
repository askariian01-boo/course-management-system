@extends('dashboard.master')

@section('content')
    <div class="container mt-4">
        <div class="row g-4">

            <!-- LEFT COLUMN (Profile + Education) -->
            <div class="col-lg-4 col-md-5 col-12">

                <!-- Profile Card -->
                <div class="card shadow mb-4">
                    <div class="card-body text-center">
                        <img src="/images/teachers/{{ $teacher->Image }}" class="rounded-circle p-1 bg-primary mb-3"
                            width="140">

                        <h5 class="mb-2">
                            {{ $teacher->FirstName }} {{ $teacher->LastName }}
                        </h5>

                        <p class="mb-1">{{ $teacher->Phone }}</p>
                        <p class="mb-1">{{ $teacher->Address }}</p>
                        <p class="mb-3">{{ $teacher->Email }}</p>
                        @if (Auth::user()->can('teacher_edit'))
                            <a href="{{ route('teacher_edit', $teacher->id) }}" class="btn btn-primary btn-sm">
                                Edit
                            </a>
                        @endif
                        @if (Auth::user()->can('teacher_delete'))
                            <form action="{{ route('teacher_delete', $teacher->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm delete">
                                    Delete
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                <!-- Education Card (NOW UNDER PROFILE) -->
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="mb-4">Education Information</h5>

                        <table class="table table-striped">
                            <tr>
                                <td>Degree</td>
                                <td>{{ $teacher->EducationDegree }}</td>
                            </tr>
                            <tr>
                                <td>University</td>
                                <td>{{ $teacher->EducationUniversity }}</td>
                            </tr>
                            <tr>
                                <td>Year</td>
                                <td>{{ $teacher->EducationYear }}</td>
                            </tr>
                            <tr>
                                <td>Talent Score</td>
                                <td>{{ $teacher->TalnetScore }}%</td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>

            <!-- RIGHT: Basic Info -->
            <div class="col-lg-8 col-md-7 col-12">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="mb-4">Basic Information</h5>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <td>full name</td>
                                    <td>{{ $teacher->FirstName }} {{ $teacher->LastName }}</td>
                                </tr>
                                <tr>
                                    <td>Father Name</td>
                                    <td>{{ $teacher->FatherName }}</td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td>{{ $teacher->Phone }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{ $teacher->Email }}</td>
                                </tr>
                                <tr>
                                    <td>NIC</td>
                                    <td>{{ $teacher->NIC }}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>{{ $teacher->Address }}</td>
                                </tr>
                                <tr>
                                    <td>Gender</td>
                                    <td>{{ $teacher->Gender == 0 ? 'Male' : 'Female' }}</td>
                                </tr>
                                <tr>
                                    <td>Marital Status</td>
                                    <td>{{ $teacher->MaritalStatus == 0 ? 'Single' : 'Married' }}</td>
                                </tr>
                                <tr>
                                    <td>Birth Day</td>
                                    <td>{{ $teacher->BirthDay }}</td>
                                </tr>
                                <tr>
                                    <td>Reg Date</td>
                                    <td>{{ $teacher->RegDate }}</td>
                                </tr>
                                <tr>
                                    <td>Salary</td>
                                    <td>{{ $teacher->GrossSalary }} AFG</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
