@extends('dashboard.master')
@section('content')
    <div class="card mt-3 ml-3 mr-3">
        <div class="col-lg-12">
            <div class="card-style">
                <h4 class="mb-10">Employee user account list
                    @if (Auth::user()->can('user_add'))
                        <a href="{{ route('user_add') }}" class="btn btn-primary float-right btn-sm fw-bold"><i
                                class="fa fa-plus fw-bold"></i>add_staff_user_account</a>
                    @endif
                </h4>

                <br>
                <div class="table-wrapper table-responsive">
                    <table class="table table-striped table-bordered  table-hover tableD" id="myTable">
                        <thead class="thead-light">
                            <tr>
                                <th style="padding:16px;" class="text-center">
                                    <h6 style="font-weight: bold;">id</h6>
                                </th>
                                <th style="padding:16px;" class="text-center">
                                    <h6 style="font-weight: bold;">full name</h6>
                                </th>
                                <th style="padding:16px;" class="text-center">
                                    <h6 style="font-weight: bold;">user name</h6>
                                </th>
                                <th style="padding:16px;" class="text-center">
                                    <h6 style="font-weight: bold;">roles name</h6>
                                </th>
                                @if (Auth::user()->can('user_edit'))
                                    <th style="padding:16px;" class="text-center">
                                        <h6 style="font-weight: bold;">edit</h6>
                                    </th>
                                @endif
                                @if (Auth::user()->can('user_delete'))
                                    <th style="padding:16px;" class="text-center">
                                        <h6 style="font-weight: bold;">delete</h6>
                                    </th>
                                @endif
                            </tr>
                            <!-- end table row-->
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                                <tr>
                                    <td style="padding:10px;" class="text-center">
                                        <p>{{ $key + 1 }}</p>
                                    </td>
                                    <td style="padding:10px;" class="text-center">
                                        <p>{{ $user->Staff->FirstName }} - {{ $user->Staff->LastName }}</p>
                                    </td>
                                    <td style="padding:10px;" class="text-center">
                                        <p>{{ $user->user_name }}</p>
                                    </td>
                                    <td style="padding:10px;" class="text-center">
                                        @foreach ($user->roles as $role)
                                            <p class="text-info fw-600">{{ $role->name }}</p>
                                        @endforeach
                                    </td>
                                    @if (Auth::user()->can('user_edit'))
                                        <td>
                                            <div class="action" style="padding:10px;">
                                                <button class="text-danger">
                                                    <a href="{{ route('user_edit', $user->id) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </button>
                                            </div>
                                        </td>
                                    @endif
                                    @if (Auth::user()->can('user_delete'))
                                        <td>
                                            <div class="action" style="padding:10px;">
                                                <button type="button" class="text-danger delete">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
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
    </div>
@endsection
