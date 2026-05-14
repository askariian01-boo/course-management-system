@extends('dashboard.master')
@section('content')
    <div class="card p-4 bg-white rounded-3 mt-3 ml-3 mr-3">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">income List</h4>
            <div>
                <a href="{{ route('income_list') }}" class="btn btn-sm btn-secondary"
                    style="padding-top: 0.65rem; padding-bottom: 0.6rem; font-weight: 600;">
                    <i class="fa fa-arrow-left"></i> back
                </a>
                @if (Auth::user()->can('income_source_add'))
                    <a href="{{ route('income_source_add') }}" class="btn btn-sm btn-info"
                        style="padding-top: 0.65rem; padding-bottom: 0.6rem; font-weight: 600;">
                        <i class="fa fa-add"></i> add income source
                    </a>
                @endif
            </div>
        </div>
        {{-- جدول فیس  --}}
        <div class="table-responsive">
            <table class="table table-bordered text-center table-striped table-hover align-middle tableD" id="myTable">
                <thead class="table-light thead-light">
                    <tr>
                        <th>Source_id</th>
                        <th>Source_name</th>
                        @if (Auth::user()->can('income_source_edit'))
                            <th class="text-center">edit</th>
                        @endif
                        @if (Auth::user()->can('income_source_delete'))
                            <th class="text-center">delete</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($income_source as $income)
                        <tr>
                            <td>
                                <p>
                                    {{ $income->id }}

                                </p>
                            </td>
                            <td>
                                <p>{{ $income->source_name }}</p>
                            </td>
                            @if (Auth::user()->can('income_source_edit'))
                                <td>
                                    <a href="{{ route('income_source_edit', $income->id) }}"
                                        class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                </td>
                            @endif
                            @if (Auth::user()->can('income_source_delete'))
                                <td>
                                    <p>
                                    <form action="{{ route('income_source_delete', $income->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button" class="btn btn-danger btn-sm delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                    </p>
                                </td>
                            @endif
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- صفحه‌بندی --}}
    </div>
@endsection
