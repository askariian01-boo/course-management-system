@extends('dashboard.master')
@section('content')
    <div class="col-lg-12 mt-3">
        <div class="card-style">
            <h4 class="mb-10"> classes list
                @if (Auth::user()->can('class_add'))
                    <a href="{{ route('class_add') }}" class="btn btn-primary fw-bold float-right btn-sm"><i
                            class="fa fa-plus"></i>add class</a>
                @endif
            </h4><br>
            <div class="table-wrapper table-bordered table-striped table-hover table-responsive">
                <table class="table table-striped table-hover table-bordered tableD" id="myTable">
                    <thead class="text-center thead-light">
                        <tr>
                            <th>
                                <h6 style="font-weight: bold;" class="text-center">id</h6>
                            </th>
                            <th>
                                <h6 style="font-weight: bold;" class="text-center">class name</h6>
                            </th>
                            <th>
                                <h6 style="font-weight: bold;" class="text-center">class fees</h6>
                            </th>
                            <th>
                                <h6 style="font-weight: bold;" class="text-center">capacity</h6>
                            </th>

                            @if (Auth::user()->can('class_list'))
                                <th class="text-center">
                                    <h6 style="font-weight: bold;">Detail</h6>
                                </th>
                            @endif
                        </tr>
                        <!-- end table row-->
                    </thead>
                    <tbody class="text-center">
                        @foreach ($classes as $class)
                            <tr>
                                <td class="min-width">
                                    <p>{{ $class->id }}
                                    </p>
                                </td>
                                <td class="min-width">
                                    <p>{{ $class->ClassName }}</p>
                                </td>
                                <td class="min-width">
                                    <p>{{ $class->ClassFees }} AFG</p>
                                </td>
                                <td class="min-width text-center" >
                                    <p>{{ $class->capacity }} students</p>
                                </td>
                                @if (Auth::user()->can('class_list'))
                                    <td class="min-width text-center">
                                        <p class="text-white text-center">
                                            <a href="{{ route('class_detail', $class->id) }} " style="mragin-top:-20px;"
                                                class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                        </p>
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

{{-- @if (Auth::user()->can('student_class_list'))
                                <th>
                                    <h6 style="font-weight: bold;">students</h6>
                                </th>
                            @endif
                            @if (Auth::user()->can('subject_class_list'))
                                <th>
                                    <h6 style="font-weight: bold;">subjects</h6>
                                </th>
                            @endif --}}

                            {{-- @if (Auth::user()->can('student_class_list'))
                                    <td class="min-width">
                                        <p class="text-white">
                                            <a class="btn btn-sm btn-primary" style="mragin-top:-20px;"
                                                href="{{ route('student_class_list', $class->id) }}"
                                                class="text-decoration-none">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </p>
                                    </td>
                                @endif
                                @if (Auth::user()->can('subject_class_list'))
                                    <td class="min-width">
                                        <p class="text-white">
                                            <a class="btn btn-sm btn-primary" style="mragin-top:-20px;"
                                                href="{{ route('class_subject_list', $class->id) }}"
                                                class="text-decoration-none">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </p>
                                    </td>
                                @endif --}}


                                {{-- @if (Auth::user()->can('class_delete'))
                                <th>
                                    <h6 style="font-weight: bold;">delete</h6>
                                </th>
                            @endif --}}

                                {{-- @if (Auth::user()->can('class_delete'))
                                    <td class="min-width">
                                        <p class="text-white">
                                        <form action="{{ route('class_delete', $class->id) }}" style="mragin-top:-20px;"
                                            style="display: inline;" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-danger delete"> <i
                                                    class="fa fa-trash"><i class="fa fa-trash"></i></i> </button>
                                        </form>
                                        </p>
                                    </td>
                                @endif --}}
