@extends('dashboard.master')
@section('content')
    <div class="card-body mt-3 ml-3 mr-3 p-4 bg-white">
        <h4 class="mb-4 fw-bold"> Take Attendance</h4>

        {{-- پیام موفقیت --}}


        <form class="form-sample" action="{{ route('staff_attendance_save') }}" method="POST">
            @csrf

            <div class="row">
                {{-- انتخاب تاریخ حاضری --}}
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label fw-semibold">Current Date</label>
                        <div class="col-sm-9">
                            <input type="date" name="date" value="{{ date('Y-m-d') }}" class="form-control" required>
                            @error('date')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- انتخاب وضعیت عمومی (اختیاری برای راهنما) --}}
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label fw-semibold">Default Status</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="default_status">
                                <option value="present">Present</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="table-responsive" style="margin-top:-50px;">
                <table class="table table-bordered text-center tableD" id="myTable">
                    <thead class="" >
                        <tr>
                            <th>ID</th>
                            <th>full Name</th>
                            <th>Father Name</th>
                            <th>Status</th>
                            <th>Remark</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($staffs as $index => $staff)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $staff->FirstName }} {{ $staff->LastName }}</td>
                                <td>{{ $staff->FatherName }}</td>
                                <td>
                                    <div class="d-inline-flex align-items-center gap-3">

                                        <label class="mb-0 d-flex align-items-center gap-1">
                                            <input type="radio" name="attendance[{{ $staff->id }}]" value="present"
                                                checked>
                                            Present
                                        </label>

                                        <label class="mb-0 d-flex align-items-center gap-1 text-danger">
                                            <input type="radio" name="attendance[{{ $staff->id }}]" value="absent">
                                            Absent
                                        </label>

                                    </div>
                                </td>
                                <td>
                                    <input type="text" name="remark[{{ $staff->id }}]" class="form-control"
                                        placeholder="Remark (optional)">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-end mt-4">
                <input type="submit" class="btn btn-info px-4" value=" Save ">
            </div>
        </form>
    </div>
    </div>

    <style>
        /* Card */
        .card-body {
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
        }

        /* Table */
        .table {
            border-radius: none;
            overflow: hidden;
            background: #fff;
        }

        .table thead {
            background: linear-gradient(90deg, #d6deea, #d8dee8);
            color: rgb(4, 4, 4);
        }

        .table thead th {
            font-size: 14px;
            padding: 12px;
        }

        /* Hover row */
        .table tbody tr {
            transition: 0.2s;
        }

        .table tbody tr:hover {
            background: #f1f7ff;
            transform: scale(1.01);
        }

        /* Radio group */
        .d-flex.gap-3 {
            gap: 18px !important;
        }

        .form-check {
            padding: 6px 10px;
            border-radius: none;
            transition: 0.2s;
        }

        /* Present */
        .form-check:has(input[value="present"]) {
            background: #e8f5e9;
        }

        /* Absent */
        .form-check:has(input[value="absent"]) {
            background: #fdecea;
        }

        /* Inputs */
        .form-control {
            border-radius: none;
            padding: 8px;
        }

        /* Button */
        .btn-info {
            border-radius: none;
            padding: 8px 20px;
            font-weight: 500;
        }

        /* Header */
        h4.card-title {
            color: #0d6efd;
            font-weight: 700;
        }
    </style>
@endsection
