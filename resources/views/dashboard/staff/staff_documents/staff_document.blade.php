@extends('dashboard.master')
@section('content')
    <div class="col-lg-12 mt-3">
        <div class="card-style">
            <h4 class="mb-10"> Employee Documents
                @if (Auth::user()->can('employee_document_add'))
                    <a href="{{ route('staff_document_add') }}" class="btn btn-sm btn-primary fw-bold float-right"><i class="fa fa-plus"></i>add new
                        document</a>
                @endif
            </h4><br>
            <div class="table-wrapper table-bordered table-responsive">
                <table class="table table-bordered table-striped table-hover tableD" id="myTable">
                    <thead class="text-center thead-light">
                        <tr>
                            <th>
                                <h6 style="font-weight: bold;">employee</h6>
                            </th>
                            <th>
                                <h6 style="font-weight: bold;">document_name</h6>
                            </th>
                            <th>
                                <h6 style="font-weight: bold;">uplode_date</h6>
                            </th>
                            <th>
                                <h6 style="font-weight: bold;">document_file</h6>
                            </th>
                            @if (Auth::user()->can('employee_document_edit'))
                                <th>
                                    <h6 style="font-weight: bold;">edit</h6>
                                </th>
                            @endif
                            @if (Auth::user()->can('employee_document_delete'))
                                <th>
                                    <h6 style="font-weight: bold;">delete</h6>
                                </th>
                            @endif
                        </tr>
                        <!-- end table row-->
                    </thead>
                    <tbody class="text-center">
                        @foreach ($documents as $document)
                            <tr>
                                <td class="min-width">
                                    <p>{{ $document->staff->FirstName }} {{ $document->staff->LastName }}
                                    </p>
                                </td>
                                <td class="min-width">
                                    <p>{{ $document->document_name }}</p>
                                </td>
                                <td class="min-width">
                                    <p>{{ $document->uplode_date }}</p>
                                </td>
                                <td class="text-center">
                                    @php
                                        $ext = pathinfo($document->document_file, PATHINFO_EXTENSION);
                                        $icon = 'fa-file'; // پیش‌فرض
                                        if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                                            $icon = 'fa-file-image';
                                        } elseif ($ext == 'pdf') {
                                            $icon = 'fa-file-pdf';
                                        } elseif (in_array($ext, ['doc', 'docx'])) {
                                            $icon = 'fa-file-word';
                                        } elseif (in_array($ext, ['xls', 'xlsx'])) {
                                            $icon = 'fa-file-excel';
                                        }
                                    @endphp
                                    <a class="btn btn-sm btn-primary" style="margin-top:-15px;"
                                        href="{{ route('staff_document_download', $document->document_file) }}"
                                        class="text-decoration-none">
                                        <i class="fas {{ $icon }}"></i> <i class="fa fa-download"></i>
                                    </a>
                                </td>
                                @if (Auth::user()->can('employee_document_edit'))
                                    <td>
                                        <a href="{{ route('staff_document_edit', $document->id) }} "style="margin-top:-15px;"
                                            class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                    </td>
                                @endif
                                @if (Auth::user()->can('employee_attendance_delete'))
                                    <td>
                                        <form
                                            action="{{ route('staff_document_delete', $document->id) }}"style="margin-top:-15px;"
                                            style="display: inline;" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-danger delete"> <i
                                                    class="fa fa-trash"><i class="fa fa-trash"></i></i> </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        <!-- end table row -->
                    </tbody>
                </table>
                <!-- end table -->
            </div>
        </div>
        <!-- end card -->
    </div>
@endsection
