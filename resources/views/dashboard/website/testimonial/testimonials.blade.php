@extends('dashboard.master')
@section('content')
    <style>
        .tableD td {
            vertical-align: middle;
        }

        .testimonial-img {
            width: 90px;
            height: 70px;
            object-fit: cover;
            border-radius: 8px;
        }

        .description-box {
            max-width: 400px;
            white-space: normal;
            word-break: break-word;
            line-height: 1.8;
        }
    </style>
    <div class="col-lg-12 mt-3">
        <div class="card-style">
            <h4 class="mb-10">
                testimonial List
                <a href="{{ route('testimonial_add') }}" class="btn btn-primary fw-bold float-right btn-sm">
                    <i class="fa fa-plus"></i>
                    Add testimonial
                </a>
            </h4>
            <br>
            <div class="table-wrapper table-striped table-bordered table-responsive">
                <table class="table table-bordered table-striped table-hover tableD" id="myTable">
                    <thead class="thead-light">
                        <tr>
                            <th>
                                <h6 class="fw-bold">name</h6>
                            </th>
                            <th>
                                <h6 class="fw-bold">position</h6>
                            </th>
                            <th>
                                <h6 class="fw-bold">reting</h6>
                            </th>
                            <th width="45%">
                                <h6 class="fw-bold">message</h6>
                            </th>
                            <th>
                                <h6 class="fw-bold">Edit</h6>
                            </th>
                            <th>
                                <h6 class="fw-bold">Delete</h6>
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($testimonials as $testimonial)
                            <tr>
                                {{-- Title --}}
                                <td>
                                    {{ $testimonial->name }}
                                </td>
                                {{-- Description --}}
                                <td>
                                    {{ $testimonial->position }}
                                </td>
                                <td class="text-center">
                                    {{ $testimonial->rating }} <span class="text-primary">number</span>
                                </td>
                                <td>
                                    <div class="description-box">
                                        {{ $testimonial->message }}
                                    </div>
                                </td>
                                {{-- Edit --}}
                                <td>
                                    <a href="{{ route('testimonial_edit', $testimonial->id) }}"
                                        class="btn btn-sm btn-primary">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                                {{-- Delete --}}
                                <td>
                                    <p>
                                    <form action="{{ route('testimonial_delete', $testimonial->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button" class="btn btn-danger btn-sm delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                    </p>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
