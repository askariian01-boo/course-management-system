@extends('dashboard.master')

@section('content')
    <div class="container mt-4">
        <div class="row g-4">

            <!-- LEFT: Profile -->
            <div class="col-lg-4 col-md-5 col-12">
                <div class="card shadow">
                    <div class="card-body text-center">

                        <img src="/images/students/{{ $student->Image }}" class="rounded-circle p-1 bg-primary mb-3"
                            width="140" height="140">

                        <h5 class="mb-2">
                            {{ $student->FirstName }} {{ $student->LastName }}
                        </h5>

                        <p class="mb-1">{{ $student->Phone }}</p>
                        <p class="mb-3">{{ $student->Address }}</p>
                        @if (Auth::user()->can('student_edit'))
                            <a href="{{ route('student_edit', $student->id) }}" class="btn btn-primary btn-sm">
                                Edit
                            </a>
                        @endif
                        @if (Auth::user()->can('student_delete'))
                            <form action="{{ route('student_delete', $student->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button type="button" class="btn btn-danger btn-sm delete">
                                    Delete
                                </button>
                            </form>
                        @endif

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
                                    <td>Full Name</td>
                                    <td>{{ $student->FirstName }} {{ $student->LastName }}</td>
                                </tr>

                                <tr>
                                    <td>Father Name</td>
                                    <td>{{ $student->FatherName }}</td>
                                </tr>

                                <tr>
                                    <td>Phone</td>
                                    <td>{{ $student->Phone }}</td>
                                </tr>

                                <tr>
                                    <td>NIC</td>
                                    <td>{{ $student->NIC }}</td>
                                </tr>

                                <tr>
                                    <td>Address</td>
                                    <td>{{ $student->Address }}</td>
                                </tr>

                                <tr>
                                    <td>Gender</td>
                                    <td>{{ $student->Gender == 0 ? 'Male' : 'Female' }}</td>
                                </tr>

                                <tr>
                                    <td>Marital Status</td>
                                    <td>{{ $student->MaritalStatus == 0 ? 'Single' : 'Married' }}</td>
                                </tr>

                                <tr>
                                    <td>Birth Day</td>
                                    <td>{{ $student->BirthDay }}</td>
                                </tr>

                                <tr>
                                    <td>Reg Date</td>
                                    <td>{{ $student->RegDate }}</td>
                                </tr>
                                <tr>
                                    <td>class</td>
                                    <td>{{ $student->class->ClassName}}</td>
                                </tr>

                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
