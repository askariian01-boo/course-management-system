@extends('dashboard.master')
@section('content')
    <div class="container mt-4">
        <div class="row g-4">

            <!-- LEFT COLUMN (Profile + Account) -->
            <div class="col-lg-4 col-md-5 col-12">

                <!-- Profile -->
                <div class="card shadow mb-4">
                    <div class="card-body text-center">

                        <img src="/images/staff/{{ $staff->Image }}" class="rounded-circle p-1 bg-primary mb-3" width="140"
                            height="140">

                        <h5 class="mb-2">
                            {{ $staff->FirstName }} {{ $staff->LastName }}
                        </h5>

                        <p class="mb-1">{{ $staff->phone }}</p>
                        <p class="mb-1">{{ $staff->Address }}</p>
                        <p class="mb-3">{{ $staff->Email }}</p>
                        @if (Auth::user()->can('employee_edit'))
                            <a href="{{ route('staff_edit', $staff->id) }}" class="btn btn-primary btn-sm">
                                Edit
                            </a>
                        @endif
                        @if (Auth::user()->can('employee_delete'))
                            <form action="{{ route('staff_delete', $staff->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button type="button" class="btn btn-danger btn-sm delete">
                                    Delete
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                <!-- Account Info (UNDER PROFILE) -->
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="mb-4">Account Information</h5>

                        <table class="table table-striped">
                            <tr>
                                <td>Position</td>
                                <td>{{ $staff->Position }}</td>
                            </tr>
                            <tr>
                                <td>Username</td>
                                <td>{{ $staff->User->user_name }}</td>
                            </tr>
                            <tr>
                                <td>Role</td>
                                <td>{{ $staff->User->role }}</td>
                            </tr>
                            <tr>
                                <td>Reg Date</td>
                                <td>{{ $staff->RegDate }}</td>
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
                                    <td>First Name</td>
                                    <td>{{ $staff->FirstName }}</td>
                                </tr>
                                <tr>
                                    <td>Last Name</td>
                                    <td>{{ $staff->LastName }}</td>
                                </tr>
                                <tr>
                                    <td>Father Name</td>
                                    <td>{{ $staff->FatherName }}</td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td>{{ $staff->phone }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{ $staff->Email }}</td>
                                </tr>
                                <tr>
                                    <td>NIC</td>
                                    <td>{{ $staff->NIC }}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>{{ $staff->Address }}</td>
                                </tr>
                                <tr>
                                    <td>Gender</td>
                                    <td>{{ $staff->Gender == 0 ? 'Male' : 'Female' }}</td>
                                </tr>
                                <tr>
                                    <td>Reg Date</td>
                                    <td>{{ $staff->RegDate }}</td>
                                </tr>
                                <tr>
                                    <td>Position</td>
                                    <td>{{ $staff->Position }}</td>
                                </tr>
                                <tr>
                                    <td>Salary</td>
                                    <td>{{ $staff->GrossSalary }} AFG</td>
                                </tr>

                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
