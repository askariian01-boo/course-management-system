<aside class="sidebar-nav-wrapper" style="background-color:rgb(237, 237, 239)">
    <div class="navbar-logo">
        <a href="{{ route('dashboard') }}">
            <img src="{{ asset('assets/logo.svg') }}" alt="LOGO" />
        </a>
    </div>

    <nav class="sidebar-nav">
        <span class="divider">
            <hr />
        </span>
        <ul style="margin-left:-15px;">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}">
                    <span class="icon">
                        <i class="fa-solid fa-gauge text-info"></i>
                    </span>
                    <span class="text" style="color:black ; font-weight:600;">Dashboard</span>
                </a>
            </li>
            @if (Auth::user()->can('employee_menu'))
                <li class="nav-item nav-item-has-children">
                    <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ddmenu_1"
                        aria-controls="ddmenu_1" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-user   text-info"></i>
                        <span class="text" style="margin-left:21px; color:black ; font-weight:600;">employee</span>
                    </a>
                    <ul id="ddmenu_1" class="collapse dropdown-nav">
                        @if (Auth::user()->can('employee_add'))
                        <li><a href="{{ route('staff_add') }}">employee add</a></li>
                        @endif
                        @if (Auth::user()->can('employee_list'))
                        <li><a href="{{ route('staff_list') }}">employee list</a></li>
                        @endif
                        @if (Auth::user()->can('employee_document_list'))
                        <li><a href="{{ route('staff_document') }}">employee document</a></li>
                        @endif
                        @if (Auth::user()->can('employee_attendance_list'))
                        <li><a href="{{ route('staff_attendance_list') }}">employee attendance</a></li>
                        @endif
                        @if (Auth::user()->can('employee_salary_list'))
                        <li><a href="{{ route('staff_salary_list') }}">employee salary</a></li>
                        @endif
                    </ul>
                </li>
            @endif
            @if (Auth::user()->can('teacher_menu'))
            <li class="nav-item nav-item-has-children">
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ddmenu_2"
                    aria-controls="ddmenu_2" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-solid fa-chalkboard-user  text-info"></i>
                    <span class="text" style="margin-left:17px; color:black ; font-weight:600;">teacher</span>
                </a>
                <ul id="ddmenu_2" class="collapse dropdown-nav">
                    @if (Auth::user()->can('teacher_add'))
                    <li><a href="{{ route('teacher_add') }}">teacher add</a></li>
                    @endif
                    @if (Auth::user()->can('teacher_list'))
                    <li><a href="{{ route('teacher_list') }}">teacher list</a></li>
                    @endif
                    @if (Auth::user()->can('teacher_document_list'))
                    <li><a href="{{ route('teacher_document') }}">teacher document</a></li>
                    @endif
                    @if (Auth::user()->can('teacher_attendance_list'))
                    <li><a href="{{ route('teacher_attendance_list') }}">teacher attendance</a></li>
                    @endif
                    @if (Auth::user()->can('teacher_salary_list'))
                    <li><a href="{{ route('teacher_salary_list') }}">teacher salary</a></li>
                    @endif
                </ul>
            </li>
            @endif
            @if (Auth::user()->can('student_menu'))
            <li class="nav-item nav-item-has-children">
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ddmenu_3"
                    aria-controls="ddmenu_3" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-solid fa-users  text-info"></i>
                    <span class="text" style="margin-left:17px; color:black ; font-weight:600;">students</span>
                </a>
                <ul id="ddmenu_3" class="collapse dropdown-nav">
                    @if (Auth::user()->can('student_add'))
                    <li><a href="{{ route('student_add') }}">student add</a></li>
                    @endif
                    @if (Auth::user()->can('student_list'))
                    <li><a href="{{ route('students') }}">student list</a></li>
                    @endif
                    @if (Auth::user()->can('student_document_list'))
                    <li><a href="{{ route('student_document') }}">student document</a></li>
                    @endif
                    @if (Auth::user()->can('student_attendance_list'))
                    <li><a href="{{ route('student_attendance_list') }}">student attendance</a></li>
                    @endif
                </ul>
            </li>
            @endif
            @if (Auth::user()->can('class & subject_menu'))
            <li class="nav-item nav-item-has-children">
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ddmenu_4"
                    aria-controls="ddmenu_4" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-solid fa-book  text-info"></i>
                    <span class="text" style="margin-left:17px; color:black ; font-weight:600;">class &
                        subject</span>
                </a>
                <ul id="ddmenu_4" class="collapse dropdown-nav">
                    @if (Auth::user()->can('class_add'))
                    <li><a href="{{ route('class_add') }}"> class add</a></li>
                    @endif
                    @if (Auth::user()->can('class_list'))
                    <li><a href="{{ route('classes') }}"> class list</a></li>
                    @endif
                    @if (Auth::user()->can('subject_list'))
                    <li><a href="{{ route('subjects') }}"> subject list</a></li>
                    @endif
                    @if (Auth::user()->can('subject_add'))
                    <li><a href="{{ route('subject_add') }}"> subject add</a></li>
                    @endif
                </ul>
            </li>
            @endif
            @if (Auth::user()->can('exam & score_menu'))
            <li class="nav-item nav-item-has-children">
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ddmenu_5"
                    aria-controls="ddmenu_5" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-solid fa-book  text-info"></i>
                    <span class="text" style="margin-left:17px; color:black ; font-weight:600;">exam & score</span>
                </a>
                <ul id="ddmenu_5" class="collapse dropdown-nav">
                    @if (Auth::user()->can('score_add'))
                    <li><a href="{{ route('score_add') }}"> score add</a></li>
                    @endif
                    @if (Auth::user()->can('score_list'))
                    <li><a href="{{ route('score_list') }}"> score list</a></li>
                    @endif
                    @if (Auth::user()->can('timetable_list'))
                    <li><a href="{{ route('timetable_list') }}"> time table </a></li>
                    @endif
                </ul>
            </li>
            @endif
            @if (Auth::user()->can('finance_menu'))
            <li class="nav-item nav-item-has-children">
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ddmenu_9"
                    aria-controls="ddmenu_9" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-user   text-info"></i>
                    <span class="text" style="margin-left:18px; color:black ; font-weight:600;">finance</span>
                </a>
                <ul id="ddmenu_9" class="collapse dropdown-nav">
                    @if (Auth::user()->can('employee_salary_payment'))
                    <li><a href="{{ route('employee_salary_payment') }}">emp_salary payment</a></li>
                    @endif
                    @if (Auth::user()->can('teacher_salary_payment'))
                    <li><a href="{{ route('teacher_salary_payment') }}">tea_salary payment</a></li>
                    @endif
                    @if (Auth::user()->can('income_list'))
                    <li><a href="{{ route('income_list') }}">cource income</a></li>
                    @endif
                    @if (Auth::user()->can('outcome_list'))
                    <li><a href="{{ route('outcome_list') }}">cource outcome</a></li>
                    @endif
                    @if (Auth::user()->can('student_fees_list'))
                    <li><a href="{{ route('student_fees_list') }}">student fees</a></li>
                    @endif
                </ul>
            </li>
            @endif
            @if (Auth::user()->can('users_menu'))
            <hr>
            <li class="nav-item nav-item-has-children">
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ddmenu_6"
                    aria-controls="ddmenu_6" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-solid fa-users  text-info"></i>
                    <span class="text" style="margin-left:17px; color:black ; font-weight:600;">users</span>
                </a>
                <ul id="ddmenu_6" class="collapse dropdown-nav">
                    @if (Auth::user()->can('user_list'))
                    <li><a href="{{ route('user_list') }}">employee users</a></li>
                    @endif
                    @if (Auth::user()->can('user_list'))
                    <li><a href="{{ route('teacher_user_list') }}">teacher users</a></li>
                    @endif
                </ul>
            </li>
            @endif
            @if (Auth::user()->can('roles & permission_menu'))
            <li class="nav-item nav-item-has-children">
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ddmenu_7"
                    aria-controls="ddmenu_7" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-solid fa-users  text-info"></i>
                    <span class="text" style="margin-left:17px; color:black ; font-weight:600;">rols &
                        permission</span>
                </a>
                <ul id="ddmenu_7" class="collapse dropdown-nav">
                    @if (Auth::user()->can('role_list'))
                    <li><a href="{{ route('roles') }}"> role list </a></li>
                    @endif
                    @if (Auth::user()->can('permission_list'))
                    <li><a href="{{ route('list_permission') }}"> permision list </a></li>
                    @endif
                    @if (Auth::user()->can('permissions_roles_list'))
                    <li><a href="{{ route('roles_permissions_list') }}"> roles_permission_list </a></li>
                    @endif
                </ul>
            </li>
            @endif
            <hr>
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item" style="font-weight: 600">
                        <i class="lni lni-exit text-info" style="font-weight: 600"></i>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Logout
                    </button>
                </form>
            </li>
        </ul>
    </nav>
</aside>
