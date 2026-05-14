@extends('dashboard.master')
@section('content')

    <div class="col-lg-12 mt-3">
        <div class="card-style p-4 bg-white rounded">
            <h4 class="mb-4">Add Student Fee
                <a href="{{ route('student_fees_list') }}" class="btn btn-sm btn-secondary float-end">
                    <i class="bi bi-arrow-left-circle"></i> Back
                </a>
            </h4>

            {{-- پیام موفقیت --}}
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- پیام خطا --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- فرم --}}
            <form action="{{ route('student_fees_save') }}" method="POST">
                @csrf
                <div class="row">

                    {{-- انتخاب شاگرد --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold text-secondary">Select Student:</label>
                        <select name="student_id" id="student_id" class="form-control form-select border-primary shadow-sm" required>
                            <option value="">-- Choose Student --</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}">
                                    {{ $student->FirstName }} {{ $student->LastName }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- سال فیس --}}
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold text-secondary">Fees Year:</label>
                        <input type="number" name="fees_year" class="form-control border-primary shadow-sm"
                            value="{{ date('Y') }}" required>
                    </div>

                    {{-- ماه فیس --}}
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold text-secondary">Fees Month:</label>
                        <select name="fees_month" class="form-control form-select border-primary shadow-sm" required>
                            @for ($m = 1; $m <= 12; $m++)
                                <option value="{{ $m }}">{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                            @endfor
                        </select>
                    </div>

                    {{-- مقدار فیس --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold text-secondary">Fees Amount (AF):</label>
                        <input type="number" id="fees_amount" readonly name="fees_amount" class="form-control border-primary shadow-sm"
                            placeholder="Enter amount" required>
                    </div>

                    {{-- تاریخ پرداخت --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold text-secondary">Payment Date:</label>
                        <input type="date" name="payment_date" class="form-control border-primary shadow-sm"
                            value="{{ date('Y-m-d') }}" required>
                    </div>

                </div>

                {{-- دکمه ثبت --}}
                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-info px-4">
                        <i class="bi bi-save"></i> Save Fee
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        let baseUrl = "{{ url('/') }}";

        document.getElementById('student_id').addEventListener('change', function() {

            let studentId = this.value;

            if (studentId) {
                fetch(baseUrl + '/get-student-fee/' + studentId)
                    .then(res => res.json())
                    .then(data => {
                        document.getElementById('fees_amount').value = data.fee;
                    });
            }
        });
    </script>
@endsection
