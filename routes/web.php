<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ContanctControllr;
use App\Http\Controllers\dashboard\StudentFeesController as DasboardStudentFeesController;
use App\Http\Controllers\dashboard\StudentFeesController;
use App\Http\Controllers\dashboard\AssignSubjectToClass;
use App\Http\Controllers\dashboard\ClassesController;
use App\Http\Controllers\dashboard\IncomeController;
use App\Http\Controllers\dashboard\IncomeSourceController;
use App\Http\Controllers\dashboard\OutcomeController;
use App\Http\Controllers\dashboard\OutcomSourceController;
use App\Http\Controllers\dashboard\PermissionController;
use App\Http\Controllers\dashboard\RoleController;
use App\Http\Controllers\dashboard\RolePermissionController;
use App\Http\Controllers\dashboard\ScoreController;
use App\Http\Controllers\dashboard\StaffAttendanceController;
use App\Http\Controllers\dashboard\StaffController;
use App\Http\Controllers\dashboard\StaffDocumentController;
use App\Http\Controllers\dashboard\StaffSalaryController;
use App\Http\Controllers\dashboard\StaffUserController;
use App\Http\Controllers\dashboard\StudentAttendanceController;
use App\Http\Controllers\dashboard\StudentController;
use App\Http\Controllers\dashboard\StudentDocumentController;
use App\Http\Controllers\dashboard\SubjectController;
use App\Http\Controllers\dashboard\teacherAttendanceController;
use App\Http\Controllers\dashboard\TeacherController;
use App\Http\Controllers\dashboard\TeacherDocumentController;
use App\Http\Controllers\dashboard\TeacherSalaryController;
use App\Http\Controllers\dashboard\TeacherUserController;
use App\Http\Controllers\dashboard\TimetableController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\website\AbouteController;
use App\Http\Controllers\website\ContactController;
use App\Http\Controllers\website\TestimonalController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

// ----------------------> Loign Route And Controllers And Setting <-------------------------- // 
Route::prefix('CMS')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    });
});


// ----------------------> Website Route And Controllers And Setting <-------------------------- // 

// Route::get('/', function () {
//     return view('welcome');
// })->name('website');

Route::get('/' , [WebsiteController::class , 'index'])->name('website');
Route::get('/website/about_us_page', [WebsiteController::class, 'aboutPage'])->name('about_page');
Route::get('/website/courses_page' , [WebsiteController::class , 'Courses'])->name('courses_page');
Route::get('/website/testimonials_pages' , [WebsiteController::class , 'TestimonialPage'])->name('tistimonials_page');
Route::get('/website/contact_us_page' , [WebsiteController::class , 'ContactPage'])->name('contact_page');


// ----------------------> Website Route And Controllers And Setting Where backend setting <-------------------------- // 
Route::middleware('auth')->group(function () {
    // abouts routes & controllers & setting

    Route::get('/abouts', [AbouteController::class, 'Abouts'])->name('abouts');
    Route::get('/about_add', [AbouteController::class, 'AboutAdd'])->name('about_add');
    Route::post('/about_save', [AbouteController::class, 'AboutSave'])->name('about_save');
    Route::get('/about_edit/{id}', [AbouteController::class, 'AboutEdit'])->name('about_edit');
    Route::put('/about_update/{id}', [AbouteController::class, 'AboutUpdate'])->name('about_update');
    Route::delete('/about_delete/{id}', [AbouteController::class, 'AboutDelete'])->name('about_delete');


    // testimonials routes & controllers & setting
    Route::get('/testimonials', [TestimonalController::class, 'Testimonial_list'])->name('testimonials');
    Route::get('/testimonial_add', [TestimonalController::class, 'TestimonialAdd'])->name('testimonial_add');
    Route::post('/testimonial_save', [TestimonalController::class, 'TestimonialSave'])->name('testimonial_save');
    Route::get('/testimonial_edit/{id}', [TestimonalController::class, 'TestimonialEdit'])->name('testimonial_edit');
    Route::put('/testimonial_update/{id}', [TestimonalController::class, 'TestimonialUpdate'])->name('testimonial_update');
    Route::delete('/testimonial_delete/{id}', [TestimonalController::class, 'TestimonialDelete'])->name('testimonial_delete');


    // contact_us routes & controllers & setting
    Route::get('/contact_us', [ContactController::class, 'ContactUs'])->name('contact_us');
    Route::get('/contact_add', [ContactController::class, 'ContactAdd'])->name('contact_add');
    Route::post('/contact_us_save', [ContactController::class, 'ContactSave'])->name('contact_us_save');
    Route::delete('/contact_delete/{id}', [ContactController::class, 'ContactDelete'])->name('contact_delete');
});



// ----------------------> Admin Dashboard Route And Controllers And Setting <-------------------------- // 

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // Staff Routs &controllers
    Route::get('/staff', [StaffController::class, 'index'])->name('staff_list')->middleware('permission:employee_list');
    Route::get('/staff_detail/{id}', [StaffController::class, 'StaffDetail'])->name('staff_detail')->middleware('permission:employee_detail');
    Route::get('/staff_add', [StaffController::class, 'StaffAdd'])->name('staff_add')->middleware('permission:employee_add');
    Route::post('/staff_save', [StaffController::class, 'StaffSave'])->name('staff_save')->middleware('permission:employee_add');
    Route::get('/staff_edit/{id}', [StaffController::class, 'StaffEdit'])->name('staff_edit')->middleware('permission:employee_edit');
    Route::put('/staff_update/{id}', [StaffController::class, 'StaffUpdate'])->name('staff_update')->middleware('permission:employee_edit');
    Route::delete('/staff_delete/{id}', [StaffController::class, 'StaffDelete'])->name('staff_delete')->middleware('permission:employee_delete');

    // staff document route &controllers
    Route::get('/staff_document', [StaffDocumentController::class, 'index'])->name('staff_document')->middleware('permission:employee_document_list');
    Route::get('/staff_document_add', [StaffDocumentController::class, 'DocumentAdd'])->name('staff_document_add')->middleware('permission:employee_document_add');
    Route::post('/staff_document_save', [StaffDocumentController::class, 'DocumentSave'])->name('staff_document_save')->middleware('permission:employee_document_add');
    Route::get('/staff_document_edit/{id}', [StaffDocumentController::class, 'DocumentEdit'])->name('staff_document_edit')->middleware('permission:employee_document_edit');
    Route::put('/staff_document_update/{id}', [StaffDocumentController::class, 'DocumentUpdate'])->name('staff_document_update')->middleware('permission:employee_document_edit');
    Route::delete('/staff_document_delete/{id}', [StaffDocumentController::class, 'DocumentDelete'])->name('staff_document_delete')->middleware('permission:employee_document_delete');
    Route::get('/staff_document/download/{filename}', [StaffDocumentController::class, 'download'])->name('staff_document_download')->middleware('permission:employee_document_list');


    // staff_attendance_routes &controllers 
    Route::get('/staff_attendance_list', [StaffAttendanceController::class, 'attendance_list'])->name('staff_attendance_list')->middleware('permission:employee_attendance_list');
    Route::get('/staff_attendance_add', [StaffAttendanceController::class, 'attendance_add'])->name('staff_attendance_add')->middleware('permission:employee_attendance_add');
    Route::post('/staff_attendance_save', [StaffAttendanceController::class, 'attendance_save'])->name('staff_attendance_save')->middleware('permission:employee_attendance_add');
    Route::get('/staff_attendance_detail/{id}', [StaffAttendanceController::class, 'attendance_detail'])->name('staff_attendance_detail')->middleware('permission:employee_attendance_detail');
    Route::delete('/staff_attendance_delete/{staff_id}/{date}', [StaffAttendanceController::class, 'attendance_delete'])->name('staff_attendance_delete')->middleware('permission:employee_attendance_delete');


    // staff_salary Routes &controllers
    Route::get('/staff_salary', [StaffSalaryController::class, 'salary_list'])->name('staff_salary_list')->middleware('permission:employee_salary_list');
    Route::get('/employee_salary_payment', [StaffSalaryController::class, 'payment_list'])->name('employee_salary_payment')->middleware('permission:employee_salary_payment');
    Route::get('/dashboard/get-absent-days/{staff_id}/{year}/{month}', [StaffSalaryController::class, 'getAbsentDays']);
    Route::get('/staff_salary_add', [StaffSalaryController::class, 'salary_add'])->name('staff_salary_add')->middleware('permission:employee_salary_add');
    Route::post('/staff_salary_save', [StaffSalaryController::class, 'salary_save'])->name('staff_salary_save')->middleware('permission:employee_salary_add');
    Route::delete('/staff_salary_delete/{staff_id}/{year}/{month}', [StaffSalaryController::class, 'salary_destroy'])->name('staff_salary_delete')->middleware('permission:employee_salary_delete');
    Route::get('/dashboard/staff-salary/mark-paid/{staff_id}/{salary_year}/{salary_month}', [StaffSalaryController::class, 'markPaid'])->name('staff_salary_mark_paid')->middleware('permission:employee_salary_payment');




    // Teachers Routs &controllers
    Route::get('/teachers', [TeacherController::class, 'index'])->name('teacher_list')->middleware('permission:teacher_list');
    Route::get('/teacher_detail/{id}', [TeacherController::class, 'TeacherDetail'])->name('teacher_detail')->middleware('permission:teacher_detail');
    Route::get('/teacher_add', [TeacherController::class, 'TeacherAdd'])->name('teacher_add')->middleware('permission:teacher_add');
    Route::post('/teacher_save', [TeacherController::class, 'TeacherSave'])->name('teacher_save')->middleware('permission:teacher_add');
    Route::get('/teacher_edit/{id}', [TeacherController::class, 'TeacherEdit'])->name('teacher_edit')->middleware('permission:teacher_edit');
    Route::put('/teacher_update/{id}', [TeacherController::class, 'TeacherUpdate'])->name('teacher_update')->middleware('permission:teacher_edit');
    Route::delete('/teacher_delete/{id}', [TeacherController::class, 'TeacherDelete'])->name('teacher_delete')->middleware('permission:teacher_delete');

    // Teacher Documents Routes &controllers
    Route::get('/teacher_document', [TeacherDocumentController::class, 'index'])->name('teacher_document')->middleware('permission:teacher_document_list');
    Route::get('/teacher_document_add', [TeacherDocumentController::class, 'DocumentAdd'])->name('teacher_document_add')->middleware('permission:teacher_document_add');
    Route::post('/teacher_document_save', [TeacherDocumentController::class, 'DocumentSave'])->name('teacher_document_save')->middleware('permission:teacher_document_add');
    Route::get('/teacher_document_edit/{id}', [TeacherDocumentController::class, 'DocumentEdit'])->name('teacher_document_edit')->middleware('permission:teacher_document_edit');
    Route::put('/teacher_document_update/{id}', [TeacherDocumentController::class, 'DocumentUpdate'])->name('teacher_document_update')->middleware('permission:teacher_document_edit');
    Route::delete('/teacher_document_delete/{id}', [TeacherDocumentController::class, 'DocumentDelete'])->name('teacher_document_delete')->middleware('permission:teacher_document_delete');
    Route::get('/teacher_document/download/{filename}', [TeacherDocumentController::class, 'download'])->name('teacher_documents_download')->middleware('permission:teacher_document_list');

    // Teacher Attendance Routes &controllers
    Route::get('/teacher_attendance_list', [teacherAttendanceController::class, 'attendance_list'])->name('teacher_attendance_list')->middleware('permission:teacher_attendance_list');
    Route::get('/teacher_attendance_add', [teacherAttendanceController::class, 'attendance_add'])->name('teacher_attendance_add')->middleware('permission:teacher_attendance_add');
    Route::post('/teacher_attendance_save', [teacherAttendanceController::class, 'attendance_save'])->name('teacher_attendance_save')->middleware('permission:teacher_attendance_add');
    Route::get('/teacher_attendance_detail/{id}', [teacherAttendanceController::class, 'attendance_detail'])->name('teacher_attendance_detail')->middleware('permission:teacher_attendance_detail');
    Route::delete('/teacher_attendance_delete/{teacher_id}/{date}', [teacherAttendanceController::class, 'attendance_delete'])->name('teacher_attendance_delete')->middleware('permission:teacher_attendance_delete');


    // Teachern Salary Routes &controllers
    Route::get('/teacher_salary', [TeacherSalaryController::class, 'salary_list'])->name('teacher_salary_list')->middleware('permission:teacher_salary_list');
    Route::get('/teacher_salary_payment', [TeacherSalaryController::class, 'payment_list'])->name('teacher_salary_payment')->middleware('permission:teacher_salary_payment');
    Route::get('/dashboard/get-absent-days/{teacher_id}/{year}/{month}', [TeacherSalaryController::class, 'getAbsentDays']);
    Route::get('/teacher_salary_add', [TeacherSalaryController::class, 'salary_add'])->name('teacher_salary_add')->middleware('permission:teacher_salary_add');
    Route::post('/teacher_salary_save', [TeacherSalaryController::class, 'salary_save'])->name('teacher_salary_save')->middleware('permission:teacher_salary_add');
    Route::delete('/teacher_salary_delete/{teacher_id}/{year}/{month}', [TeacherSalaryController::class, 'salary_destroy'])->name('teacher_salary_delete')->middleware('permission:teacher_salary_delete');
    Route::get('/dashboard/teacher-salary/mark-paid/{teacher_id}/{salary_year}/{salary_month}', [TeacherSalaryController::class, 'markPaid'])->name('teacher_salary_mark_paid')->middleware('permission:teacher_salary_payment');




    // students Routes &controllers
    route::get('/students', [StudentController::class, 'index'])->name('students')->middleware('permission:student_list');
    route::get('/student_detail/{id}', [StudentController::class, 'StudentDetail'])->name('student_detail')->middleware('permission:student_detail');
    route::get('/student_add', [StudentController::class, 'StudentAdd'])->name('student_add')->middleware('permission:student_add');
    route::post('/student_save', [StudentController::class, 'StudentSave'])->name('student_save')->middleware('permission:student_add');
    route::get('/student_edit/{id}', [StudentController::class, 'StudentEdit'])->name('student_edit')->middleware('permission:student_edit');
    route::put('/student_update/{id}', [StudentController::class, 'StudentUpdate'])->name('student_update')->middleware('permission:student_edit');
    route::delete('/student_delete/{id}', [StudentController::class, 'StudentDelete'])->name('student_delete')->middleware('permission:student_delete');


    // students documents routs &controllers
    route::get('/student_documents', [StudentDocumentController::class, 'StudentDocuments'])->name('student_document')->middleware('permission:student_document_list');
    route::get('/student_document_add', [StudentDocumentController::class, 'DocumentAdd'])->name('student_document_add')->middleware('permission:student_document_add');
    route::post('/student_document_save', [StudentDocumentController::class, 'DocumentSave'])->name('student_document_save')->middleware('permission:student_document_add');
    Route::get('/student_document_edit/{id}', [StudentDocumentController::class, 'DocumentEdit'])->name('student_document_edit')->middleware('permission:student_document_edit');
    Route::put('/student_document_update/{id}', [StudentDocumentController::class, 'DocumentUpdate'])->name('student_document_update')->middleware('permission:student_document_edit');
    Route::delete('/student_document_delete/{id}', [StudentDocumentController::class, 'DocumentDelete'])->name('student_document_delete')->middleware('permission:student_document_delete');
    Route::get('/student_document/download/{filename}', [StudentDocumentController::class, 'download'])->name('student_document_download')->middleware('permission:student_document_list');


    //student attendance &controllers
    Route::get('/student_attendance_list', [StudentAttendanceController::class, 'attendance_list'])->name('student_attendance_list')->middleware('permission:student_attendance_list');
    Route::get('/student_attendance_add', [StudentAttendanceController::class, 'attendance_add'])->name('student_attendance_add')->middleware('permission:student_attendance_add');
    Route::post('/student_attendance_save', [StudentAttendanceController::class, 'attendance_save'])->name('student_attendance_save')->middleware('permission:student_attendance_add');
    Route::get('/student_attendance_detail/{id}', [StudentAttendanceController::class, 'attendance_detail'])->name('student_attendance_detail')->middleware('permission:student_attendance_detail');
    Route::delete('/student_attendance_delete/{student_id}/{date}', [StudentAttendanceController::class, 'attendance_delete'])->name('student_attendance_delete')->middleware('permission:student_attendance_delete');



    // student fees routes &controllers
    Route::get('/student_fees_list', [StudentFeesController::class, 'fees_list'])->name('student_fees_list')->middleware('permission:student_fees_list');
    Route::get('/get-student-fee/{id}', [StudentFeesController::class, 'getStudentFee']);
    Route::get('/student_fees_add', [StudentFeesController::class, 'fees_add'])->name('student_fees_add')->middleware('permission:student_fees_add');
    Route::post('/student_fees_save', [StudentFeesController::class, 'fees_save'])->name('student_fees_save')->middleware('permission:student_fees_add');


    // classes Routes &controllers 
    Route::get('/classes', [ClassesController::class, 'index'])->name('classes')->middleware('permission:class_list');
    Route::get('/class_detail/{id}', [ClassesController::class, 'ClassDetail'])->name('class_detail')->middleware('permission:class_list');
    Route::get('/class_add', [ClassesController::class, 'ClassAdd'])->name('class_add')->middleware('permission:class_add');
    Route::post('/class_save', [ClassesController::class, 'ClassSave'])->name('class_save')->middleware('permission:class_add');
    Route::get('/class_edit/{id}', [ClassesController::class, 'ClassEdit'])->name('class_edit')->middleware('permission:class_edit');
    Route::put('/class_update/{id}', [ClassesController::class, 'ClassUpdate'])->name('class_update')->middleware('permission:class_edit');
    Route::delete('/class_delete/{id}', [ClassesController::class, 'ClassDelete'])->name('class_delete')->middleware('permission:class_delete');
    Route::get('/class_student_list/{id}', [ClassesController::class, 'StudentList'])->name('student_class_list')->middleware('permission:student_class_list');


    // assign subject to classes routes & controllers
    Route::get('/assign_subject_to_class_list/{id}', [AssignSubjectToClass::class, 'AssignSubjectList'])->name('class_subject_list')->middleware('permission:subject_class_list');
    Route::get('/assign_subject_to_class/{id}', [AssignSubjectToClass::class, 'AssignSubject'])->name('assign_subject')->middleware('permission:assign_subject_class');
    Route::post('/assign_subject_to_class_save', [AssignSubjectToClass::class, 'SaveAssignSubject'])->name('save_assign')->middleware('permission:assign_subject_class');
    Route::delete('/class_subject_delete/{class_id}/{subject_id}', [AssignSubjectToClass::class, 'DeleteAssignSubject'])->name('class_subject_delete')->middleware('permission:subject_class_delete');

    // Subjects Routes & controllers
    Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects')->middleware('permission:subject_list');
    Route::get('/subject_add', [SubjectController::class, 'SubjectAdd'])->name('subject_add')->middleware('permission:subject_add');
    Route::post('/subject_save', [SubjectController::class, 'SubjectSave'])->name('subject_save')->middleware('permission:subject_add');
    Route::get('/subject_edit/{id}', [SubjectController::class, 'SubjectEdit'])->name('subject_edit')->middleware('permission:subject_edit');
    Route::put('/subject_update/{id}', [SubjectController::class, 'SubjectUpdate'])->name('subject_update')->middleware('permission:subject_edit');
    Route::delete('/subject_delete/{id}', [SubjectController::class, 'SubjectDelete'])->name('subject_delete')->middleware('permission:subject_delete');
    Route::get('/subject_detail/{id}', [SubjectController::class, 'SubjectDetail'])->name('subject_detail')->middleware('permission:subject_list');


    // assign teacher in subject routes & controllers
    Route::get('/assign_teacher_to_subject/{id}', [SubjectController::class, 'AssignTeacher'])->name('assign_teacher')->middleware('permission:subject_list');
    Route::post('/assign_teacher_to_subject_save', [SubjectController::class, 'SaveAssignTeacher'])->name('save_assign_teacher')->middleware('permission:subject_list');
    Route::delete('/assign_teacher_to_subject_delete/{subject_id}/{teacher_id}', [SubjectController::class, 'DeleteAssignTeacher'])->name('subject_teacher_delete')->middleware('permission:subject_list');

    // Outcome Routes & Controllers
    Route::get('/outcome_list', [OutcomeController::class, 'OutcomeList'])->name('outcome_list')->middleware('permission:outcome_list');
    Route::get('/outcome_add', [OutcomeController::class, 'OutcomeAdd'])->name('outcome_add')->middleware('permission:outcome_add');
    Route::post('/outcome_save', [OutcomeController::class, 'OutcomeSave'])->name('outcome_save')->middleware('permission:outcome_add');
    Route::get('/outcome_edit/{id}', [OutcomeController::class, 'OutcomeEdit'])->name('outcome_edit')->middleware('permission:outcome_edit');
    Route::put('/outcome_update/{id}', [OutcomeController::class, 'OutcomeUpdate'])->name('outcome_update')->middleware('permission:outcome_edit');
    Route::delete('/outcome_delete/{id}', [OutcomeController::class, 'OutcomeDelete'])->name('outcome_delete')->middleware('permission:outcome_delete');



    // Outcome Source Routes & Controllers
    Route::get('/outcome_source_list', [OutcomSourceController::class, 'SourceList'])->name('outcome_source_list')->middleware('permission:outcome_source_list');
    Route::get('/outcome_source_add', [OutcomSourceController::class, 'SourceAdd'])->name('outcome_source_add')->middleware('permission:outcome_source_add');
    Route::post('/outcome_source_save', [OutcomSourceController::class, 'SourceSave'])->name('outcome_source_save')->middleware('permission:outcome_source_add');
    Route::get('/outcome_source_edit/{id}', [OutcomSourceController::class, 'SourceEdit'])->name('outcome_source_edit')->middleware('permission:outcome_source_edit');
    Route::put('/outcome_source_update/{id}', [OutcomSourceController::class, 'SourceUpdate'])->name('outcome_source_update')->middleware('permission:outcome_source_edit');
    Route::delete('/outcome_source_delete/{id}', [OutcomSourceController::class, 'SourceDelete'])->name('outcome_source_delete')->middleware('permission:outcome_source_delete');



    // Income Source Routes & Controllers
    Route::get('/income_source_list', [IncomeSourceController::class, 'SourceList'])->name('income_source_list')->middleware('permission:income_source_list');
    Route::get('/income_source_add', [IncomeSourceController::class, 'SourceAdd'])->name('income_source_add')->middleware('permission:income_source_add');
    Route::post('/income_source_save', [IncomeSourceController::class, 'SourceSave'])->name('income_source_save')->middleware('permission:income_source_add');
    Route::get('/income_source_edit/{id}', [IncomeSourceController::class, 'SourceEdit'])->name('income_source_edit')->middleware('permission:income_source_edit');
    Route::put('/income_source_update/{id}', [IncomeSourceController::class, 'SourceUpdate'])->name('income_source_update')->middleware('permission:income_source_edit');
    Route::delete('/income_source_delete/{id}', [IncomeSourceController::class, 'SourceDelete'])->name('income_source_delete')->middleware('permission:income_source_delete');



    // Income Routes & Controllers
    Route::get('/income_list', [IncomeController::class, 'IncomeList'])->name('income_list')->middleware('permission:income_list');
    Route::get('/income_add', [IncomeController::class, 'IncomeAdd'])->name('income_add')->middleware('permission:income_add');
    Route::post('/income_save', [IncomeController::class, 'IncomeSave'])->name('income_save')->middleware('permission:income_add');
    Route::get('/income_edit/{id}', [IncomeController::class, 'IncomeEdit'])->name('income_edit')->middleware('permission:income_edit');
    Route::put('/income_update/{id}', [IncomeController::class, 'IncomeUpdate'])->name('income_update')->middleware('permission:income_edit');
    Route::delete('/income_delete/{id}', [IncomeController::class, 'IncomeDelete'])->name('income_delete')->middleware('permission:income_delete');



    // score routes & controllers
    Route::get('/score_list', [ScoreController::class, 'ScoreList'])->name('score_list')->middleware('permission:score_list');
    Route::get('/score_add', [ScoreController::class, 'ScoreAdd'])->name('score_add')->middleware('permission:score_add');
    Route::get('/get-class-data/{id}', [ScoreController::class, 'getClassData']);
    Route::post('/score_save', [ScoreController::class, 'ScoreSave'])->name('score_save')->middleware('permission:score_add');
    Route::get('/score_edit/{id}', [ScoreController::class, 'ScoreEdit'])->name('score_edit')->middleware('permission:score_edit');
    Route::put('/score_update/{id}', [ScoreController::class, 'ScoreUpdate'])->name('score_update')->middleware('permission:score_edit');
    Route::delete('/score_delete/{id}', [ScoreController::class, 'ScoreDelete'])->name('score_delete')->middleware('permission:score_delete');


    // timetable routes & controllers
    Route::get('/timetable_list', [TimetableController::class, 'TimetableList'])->name('timetable_list')->middleware('permission:timetable_list');
    Route::get('/timetable_add', [TimetableController::class, 'TimetableAdd'])->name('timetable_add')->middleware('permission:timetable_add');
    Route::get('/get-subjects/{class_id}', [TimetableController::class, 'getSubjects']);
    Route::get('/get-teachers/{subject_id}', [TimetableController::class, 'getTeachers']);
    Route::post('/timetable_save', [TimetableController::class, 'TimetableSave'])->name('timetable_save')->middleware('permission:timetable_add');
    Route::get('/timetable_edit/{id}', [TimetableController::class, 'TimetableEdit'])->name('timetable_edit')->middleware('permission:timetable_edit');
    Route::put('/timetable_update/{id}', [TimetableController::class, 'TimetableUpdate'])->name('timetable_update')->middleware('permission:timetable_edit');
    Route::delete('/timetable_delete/{id}', [TimetableController::class, 'TimetableDelete'])->name('timetable_delete')->middleware('permission:timetable_delete');


    // staff user account routes & controllers
    Route::get('/staff_user_list', [StaffUserController::class, 'index'])->name('user_list')->middleware('permission:user_list');
    Route::get('/staff_user_add', [StaffUserController::class, 'create'])->name('user_add')->middleware('permission:user_add');
    Route::post('/staff_user_store', [StaffUserController::class, 'store'])->name('user_store')->middleware('permission:user_add');
    Route::get('/staff_user_edit/{id}', [StaffUserController::class, 'edit'])->name('user_edit')->middleware('permission:user_edit');
    Route::post('/staff_user_update/{id}', [StaffUserController::class, 'update'])->name('user_update')->middleware('permission:user_edit');
    Route::get('/staff_user_delete/{id}', [StaffUserController::class, 'destroy'])->name('user_delete')->middleware('permission:user_delete');


    // teacher user acount routes and Controllers and setting
    Route::get('/teacher_users', [TeacherUserController::class, 'index'])->name('teacher_user_list')->middleware('permission:user_list');
    Route::get('/teacher_user_add', [TeacherUserController::class, 'create'])->name('teacher_user_add')->middleware('permission:user_add');
    Route::post('/teacher_user_save', [TeacherUserController::class, 'store'])->name('teacher_user_save')->middleware('permission:user_add');
    Route::get('/teacher_user_edit/{id}', [TeacherUserController::class, 'edit'])->name('teacher_user_edit')->middleware('permission:user_edit');
    Route::post('/teacher_user_update/{id}', [TeacherUserController::class, 'update'])->name('teacher_user_update')->middleware('permission:user_edit');
    Route::get('/teacher_user_delete/{id}', [TeacherUserController::class, 'destroy'])->name('teacher_user_delete')->middleware('permission:user_delete');


    // Roles & Permissions
    // permissions Routes
    Route::get('/permissions', [PermissionController::class, 'permissions'])->name('list_permission')->middleware('permission:permission_list');
    Route::get('/permissions/add', [PermissionController::class, 'permission_add'])->name('add_permission')->middleware('permission:permission_add');
    Route::post('/permissions/save', [PermissionController::class, 'permission_save'])->name('save_permission')->middleware('permission:permission_add');
    Route::get('/permissions/edit/{id}', [PermissionController::class, 'permission_edit'])->name('edit_permission')->middleware('permission:permission_edit');
    Route::put('/permissions/update/{id}', [PermissionController::class, 'permission_update'])->name('update_permission')->middleware('permission:permission_edit');
    Route::delete('/permissions/delete/{id}', [PermissionController::class, 'permission_delete'])->name('delete_permission')->middleware('permission:permission_delete');


    // Roles Controllers
    Route::get('/roles', [RoleController::class, 'roles'])->name('roles')->middleware('permission:role_list');
    Route::get('/roles/add', [RoleController::class, 'role_add'])->name('add_roles')->middleware('permission:role_add');
    Route::post('/roles/save', [RoleController::class, 'role_save'])->name('save_roles')->middleware('permission:role_add');
    Route::get('/roles/edit/{id}', [RoleController::class, 'role_edit'])->name('edit_roles')->middleware('permission:role_edit');
    Route::put('/roles/update/{id}', [RoleController::class, 'role_update'])->name('update_roles')->middleware('permission:role_edit');
    Route::delete('/roles/delete/{id}', [RoleController::class, 'role_delete'])->name('delete_roles')->middleware('permission:role_delete');


    // role assign to permissions
    Route::get('/roles_permissions_list', [RolePermissionController::class, 'roles_permissions_list'])->name('roles_permissions_list')->middleware('permission:permissions_roles_list');
    Route::get('/roles_assign_permission', [RolePermissionController::class, 'assign_permission'])->name('roles_assign_permission')->middleware('permission:assign_permissions_roles');
    Route::post('/permission_roles_save', [RolePermissionController::class, 'save_permission_role'])->name('permission_roles_save')->middleware('permission:assign_permissions_roles');
    Route::get('/permission_roles_edit/{id}', [RolePermissionController::class, 'edit_permission_role'])->name('permission_roles_edit')->middleware('permission:edit_permissions_roles');
    Route::put('/permission_roles_update/{id}', [RolePermissionController::class, 'update_permission_role'])->name('update_permission_role')->middleware('permission:edit_permissions_roles');
    Route::get('/permission_roles_delete/{id}', [RolePermissionController::class, 'permission_roles_delete'])->name('permission_roles_delete')->middleware('permission:delete_permissions_roles');
});

require __DIR__ . '/auth.php';


// developer-hadi-askari
