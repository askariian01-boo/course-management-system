@extends('dashboard.master')
@section('content')


    <div class="col-lg-12 mt-3">
        <div class="card-style p-4 bg-white rounded">

            <h4 class="mb-4">
                Add Staff Salary
                <a href="{{ route('staff_salary_list') }}" class="btn btn-sm btn-secondary float-end">
                    <i class="bi bi-arrow-left-circle"></i> Back
                </a>
            </h4>

            {{-- success --}}
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('staff_salary_save') }}" method="POST" id="salaryForm">
                @csrf

                <div class="row">

                    {{-- Staff --}}
                    <div class="col-lg-6 col-md-6 col-12 mb-3">
                        <label class="form-label fw-semibold text-secondary">
                            Select Employee:
                        </label>
                        <select name="staff_id" id="staff_id"
                            class="form-control form-select border-primary shadow-sm @error('staff_id') is-invalid @enderror"
                            required>

                            <option value="">-- Choose Employee --</option>

                            @foreach ($staffs as $st)
                                <option value="{{ $st->id }}" data-gross="{{ $st->GrossSalary }}"
                                    {{ old('staff_id') == $st->id ? 'selected' : '' }}>

                                    {{ $st->FirstName }} {{ $st->LastName }} - {{ number_format($st->GrossSalary) }}
                                </option>
                            @endforeach
                        </select>

                        @error('staff_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Year --}}
                    <div class="col-lg-3 col-md-6 col-12 mb-3">
                        <label class="form-label fw-semibold text-secondary">Salary Year:</label>
                        <input type="number" name="salary_year" id="salary_year"
                            value="{{ old('salary_year', date('Y')) }}"
                            class="form-control border-primary shadow-sm @error('salary_year') is-invalid @enderror"
                            required>

                        @error('salary_year')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Month --}}
                    {{-- Month --}}
                    <div class="col-lg-3 col-md-6 col-12 mb-3">
                        <label class="form-label fw-semibold text-secondary">Salary Month:</label>

                        <select name="salary_month" id="salary_month"
                            class="form-control form-select border-primary shadow-sm @error('salary_month') is-invalid @enderror"
                            required>

                            @for ($m = 1; $m <= 12; $m++)
                                <option value="{{ $m }}"
                                    {{ old('salary_month', date('n')) == $m ? 'selected' : '' }}>

                                    {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                </option>
                            @endfor
                        </select>

                        @error('salary_month')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Absent Days --}}
                    <div class="col-lg-6 col-md-6 col-12 mb-3">
                        <label class="form-label fw-semibold text-secondary">Absent Days:</label>
                        <input type="number" name="absent_days" id="absent_days"
                            class="form-control border-primary shadow-sm" value="{{ old('absent_days', 0) }}" readonly>
                    </div>

                    {{-- Absent Amount --}}
                    <div class="col-lg-6 col-md-6 col-12 mb-3">
                        <label class="form-label fw-semibold text-secondary">Absent Amount:</label>
                        <input type="number" name="absent_amount" id="absent_amount"
                            class="form-control border-primary shadow-sm" value="{{ old('absent_amount', 0) }}" readonly>
                    </div>

                    {{-- Net Salary --}}
                    <div class="col-lg-6 col-md-6 col-12 mb-3">
                        <label class="form-label fw-semibold text-secondary">Net Salary:</label>
                        <input type="text" id="net_salary" class="form-control bg-light shadow-sm" readonly>
                    </div>

                    {{-- Pay Date --}}
                    <div class="col-lg-6 col-md-6 col-12 mb-3">
                        <label class="form-label fw-semibold text-secondary">Pay Date:</label>
                        <input type="date" name="pay_date" value="{{ old('pay_date', date('Y-m-d')) }}"
                            class="form-control border-primary shadow-sm">
                    </div>

                </div>

                {{-- buttons --}}
                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-info px-4">
                        <i class="bi bi-save"></i> Save Salary
                    </button>
                </div>

            </form>
        </div>
    </div>

    {{-- JS --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const staffSelect = document.getElementById('staff_id');
            const absentDaysInput = document.getElementById('absent_days');
            const absentAmountInput = document.getElementById('absent_amount');
            const netSalaryInput = document.getElementById('net_salary');

            staffSelect.addEventListener('change', loadAbsent);

            document.getElementById('salary_year').addEventListener('change', loadAbsent);
            document.getElementById('salary_month').addEventListener('change', loadAbsent);

            function loadAbsent() {
                const staffId = staffSelect.value;
                const year = document.getElementById('salary_year').value;
                const month = document.getElementById('salary_month').value;

                if (staffId) {
                    fetch(`/dashboard/get-absent-days/${staffId}/${year}/${month}`)
                        .then(res => res.json())
                        .then(data => {
                            absentDaysInput.value = data.absent_days;
                            absentAmountInput.value = data.absent_amount;
                            calculateNet();
                        });
                }
            }

            function calculateNet() {
                const gross = parseFloat(staffSelect.options[staffSelect.selectedIndex]?.dataset.gross || 0);
                const absentAmount = parseFloat(absentAmountInput.value || 0);
                netSalaryInput.value = (gross - absentAmount).toLocaleString();
            }

        });
    </script>

@endsection
