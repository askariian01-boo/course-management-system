@extends('dashboard.master')
@section('content')
    <div class="col-lg-12 mr-3 mt-3">
        <div class="card-style mb-30">
            <h4 class="mb-4">Teacher Salary Payment</h4>
            <table class="table table-bordered text-center table-hover table-striped align-middle tableD" id="myTable">
                <thead class="table-light thead-light">
                    <tr>
                        <th>employee</th>
                        <th>month</th>
                        <th>gross_salary</th>
                        <th>net_salary</th>
                        <th>payment</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($salaries as $salary)
                        <tr>
                            <td>
                                <p>
                                    {{ optional($salary->teacher)->FirstName }}
                                    {{ optional($salary->teacher)->LastName }}
                                </p>
                            </td>
                            <td>
                                <p>{{ $salary->salary_year }} - {{ $salary->salary_month }}</p>
                            </td>
                            <td>
                                <p>{{ $salary->teacher->GrossSalary }} AFG </p>
                            </td>
                            <td>
                                <p>{{ $salary->net_salary }} AFG</p>
                            </td>
                            <td>
                                @if ($salary->status == 'unpaid')
                                    <a href="{{ route('teacher_salary_mark_paid', [
                                        'teacher_id' => $salary->teacher_id,
                                        'salary_year' => $salary->salary_year,
                                        'salary_month' => $salary->salary_month,
                                    ]) }}"
                                        class="badge bg-danger text-decoration-none"
                                        onclick="return confirm('Are you sure you want to mark this salary as paid?');">
                                        Unpaid
                                    </a>
                                @else
                                    <span class="badge bg-success">Paid</span>
                                @endif
                            </td>


                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-muted">No salary records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
