@extends('dashboard.master')
@section('content')
    <div class="col-lg-12 mt-3  mr-3">
        <div class="card-style mb-30">
            <h4 class="mb-4">Employee Salary Payment</h4>

            {{-- <form method="GET" action="{{ route('staff_salary_list') }}"
                class="mb-4 p-3 rounded shadow-sm bg-light d-flex flex-wrap gap-3 align-items-end">

                {{-- فیلتر تاریخ --}}
            {{-- <div class="flex-grow-1" style="min-width: 180px;">
                    <label for="date" class="form-label fw-bold text-secondary"> ُSearch Year:</label>
                    <input type="number" name="year" value="{{ request('year') }}"
                        class="form-control border-primary shadow-sm">
                </div> --}}

            {{-- جستجو بر اساس نام / تخلص / نام پدر --}}
            {{-- <div class="flex-grow-1" style="min-width: 250px;">
                    <label for="search" class="form-label fw-bold text-secondary"> Search Employee:</label>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Type name or father name..." class="form-control border-primary shadow-sm">
                </div> --}}

            {{-- دکمه‌ها --}}
            {{-- <div class="mt-2">
                    <button type="submit" class="btn btn-info px-4">
                        <i class="bi bi-search"></i> Search
                    </button>
                    <a href="{{ route('staff_salary_list') }}" class="btn btn-primary px-4">
                        <i class="bi bi-eye"></i> View All
                    </a>
                </div>
            </form> --}}

            <table class="table table-bordered text-center table-striped table-hover align-middle tableD" id="myTable">
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
                                    {{ optional($salary->staff)->FirstName }}
                                    {{ optional($salary->staff)->LastName }}
                                </p>
                            </td>
                            <td>
                                <p>{{ $salary->salary_year }} - {{ $salary->salary_month }}</p>
                            </td>
                            <td>
                                <p>{{ $salary->staff->GrossSalary }} AFG </p>
                            </td>
                            <td>
                                <p>{{ $salary->net_salary }} AFG</p>
                            </td>
                            <td>
                                @if ($salary->status == 'unpaid')
                                    <a href="{{ route('staff_salary_mark_paid', [
                                        'staff_id' => $salary->staff_id,
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
