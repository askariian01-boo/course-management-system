<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // ======================================================
        // PERMISSIONS WITH GROUP NAME
        // ======================================================

        $permissions = [

            // ================= Employees =================

            ['name' => 'employee_add', 'group_name' => 'employees'],
            ['name' => 'employee_edit', 'group_name' => 'employees'],
            ['name' => 'employee_delete', 'group_name' => 'employees'],
            ['name' => 'employee_list', 'group_name' => 'employees'],
            ['name' => 'employee_detail', 'group_name' => 'employees'],
            ['name' => 'employee_menu', 'group_name' => 'employees'],

            // ================= Employee Attendance =================

            ['name' => 'employee_attendance_add', 'group_name' => 'employee_attendance'],
            ['name' => 'employee_attendance_delete', 'group_name' => 'employee_attendance'],
            ['name' => 'employee_attendance_list', 'group_name' => 'employee_attendance'],
            ['name' => 'employee_attendance_detail', 'group_name' => 'employee_attendance'],

            // ================= Employee Salary =================

            ['name' => 'employee_salary_add', 'group_name' => 'employees_salary'],
            ['name' => 'employee_salary_delete', 'group_name' => 'employees_salary'],
            ['name' => 'employee_salary_list', 'group_name' => 'employees_salary'],

            // ================= Employee Document =================

            ['name' => 'employee_document_add', 'group_name' => 'employees_document'],
            ['name' => 'employee_document_edit', 'group_name' => 'employees_document'],
            ['name' => 'employee_document_delete', 'group_name' => 'employees_document'],
            ['name' => 'employee_document_list', 'group_name' => 'employees_document'],

            // ================= Teachers =================

            ['name' => 'teacher_add', 'group_name' => 'teachers'],
            ['name' => 'teacher_edit', 'group_name' => 'teachers'],
            ['name' => 'teacher_delete', 'group_name' => 'teachers'],
            ['name' => 'teacher_list', 'group_name' => 'teachers'],
            ['name' => 'teacher_detail', 'group_name' => 'teachers'],
            ['name' => 'teacher_menu', 'group_name' => 'teachers'],

            // ================= Teacher Attendance =================

            ['name' => 'teacher_attendance_add', 'group_name' => 'teacher_attendance'],
            ['name' => 'teacher_attendance_delete', 'group_name' => 'teacher_attendance'],
            ['name' => 'teacher_attendance_list', 'group_name' => 'teacher_attendance'],
            ['name' => 'teacher_attendance_detail', 'group_name' => 'teacher_attendance'],

            // ================= Teacher Salary =================

            ['name' => 'teacher_salary_add', 'group_name' => 'teacher_salary'],
            ['name' => 'teacher_salary_delete', 'group_name' => 'teacher_salary'],
            ['name' => 'teacher_salary_list', 'group_name' => 'teacher_salary'],

            // ================= Teacher Document =================

            ['name' => 'teacher_document_add', 'group_name' => 'teacher_document'],
            ['name' => 'teacher_document_edit', 'group_name' => 'teacher_document'],
            ['name' => 'teacher_document_delete', 'group_name' => 'teacher_document'],
            ['name' => 'teacher_document_list', 'group_name' => 'teacher_document'],

            // ================= Students =================

            ['name' => 'student_add', 'group_name' => 'students'],
            ['name' => 'student_edit', 'group_name' => 'students'],
            ['name' => 'student_delete', 'group_name' => 'students'],
            ['name' => 'student_list', 'group_name' => 'students'],
            ['name' => 'student_detail', 'group_name' => 'students'],
            ['name' => 'student_menu', 'group_name' => 'students'],
            ['name' => 'students_detail', 'group_name' => 'students'],            

            // ================= Student Attendance =================

            ['name' => 'student_attendance_add', 'group_name' => 'student_attendance'],
            ['name' => 'student_attendance_delete', 'group_name' => 'student_attendance'],
            ['name' => 'student_attendance_list', 'group_name' => 'student_attendance'],
            ['name' => 'student_attendance_detail', 'group_name' => 'student_attendance'],

            // ================= Student Document =================

            ['name' => 'student_document_add', 'group_name' => 'student_document'],
            ['name' => 'student_document_edit', 'group_name' => 'student_document'],
            ['name' => 'student_document_delete', 'group_name' => 'student_document'],
            ['name' => 'student_document_list', 'group_name' => 'student_document'],

            // ================= Class & Subject =================

            ['name' => 'class_add', 'group_name' => 'class_subject'],
            ['name' => 'class_edit', 'group_name' => 'class_subject'],
            ['name' => 'class_delete', 'group_name' => 'class_subject'],
            ['name' => 'class_list', 'group_name' => 'class_subject'],

            ['name' => 'subject_add', 'group_name' => 'class_subject'],
            ['name' => 'subject_edit', 'group_name' => 'class_subject'],
            ['name' => 'subject_delete', 'group_name' => 'class_subject'],
            ['name' => 'subject_list', 'group_name' => 'class_subject'],

            ['name' => 'assign_subject_class', 'group_name' => 'class_subject'],
            ['name' => 'subject_class_list', 'group_name' => 'class_subject'],
            ['name' => 'subject_class_delete', 'group_name' => 'class_subject'],
            ['name' => 'class & subject_menu', 'group_name' => 'class_subject'],

            ['name' => 'student_assign_class', 'group_name' => 'class_subject'],
            ['name' => 'student_class_list', 'group_name' => 'class_subject'],

            // ================= Exam & Score =================

            ['name' => 'score_add', 'group_name' => 'exam_score'],
            ['name' => 'score_edit', 'group_name' => 'exam_score'],
            ['name' => 'score_delete', 'group_name' => 'exam_score'],
            ['name' => 'score_list', 'group_name' => 'exam_score'],
            ['name' => 'exam & score_menu', 'group_name' => 'exam_score'],

            ['name' => 'timetable_add', 'group_name' => 'exam_score'],
            ['name' => 'timetable_edit', 'group_name' => 'exam_score'],
            ['name' => 'timetable_delete', 'group_name' => 'exam_score'],
            ['name' => 'timetable_list', 'group_name' => 'exam_score'],

            // ================= Finance =================

            ['name' => 'income_add', 'group_name' => 'finance'],
            ['name' => 'income_edit', 'group_name' => 'finance'],
            ['name' => 'income_delete', 'group_name' => 'finance'],
            ['name' => 'income_list', 'group_name' => 'finance'],

            ['name' => 'income_source_add', 'group_name' => 'finance'],
            ['name' => 'income_source_edit', 'group_name' => 'finance'],
            ['name' => 'income_source_delete', 'group_name' => 'finance'],
            ['name' => 'income_source_list', 'group_name' => 'finance'],

            ['name' => 'outcome_add', 'group_name' => 'finance'],
            ['name' => 'outcome_edit', 'group_name' => 'finance'],
            ['name' => 'outcome_delete', 'group_name' => 'finance'],
            ['name' => 'outcome_list', 'group_name' => 'finance'],

            ['name' => 'outcome_source_add', 'group_name' => 'finance'],
            ['name' => 'outcome_source_edit', 'group_name' => 'finance'],
            ['name' => 'outcome_source_delete', 'group_name' => 'finance'],
            ['name' => 'outcome_source_list', 'group_name' => 'finance'],

            ['name' => 'student_fees_add', 'group_name' => 'finance'],
            ['name' => 'student_fees_delete', 'group_name' => 'finance'],
            ['name' => 'student_fees_list', 'group_name' => 'finance'],

            ['name' => 'teacher_salary_payment', 'group_name' => 'finance'],
            ['name' => 'employee_salary_payment', 'group_name' => 'finance'],

            ['name' => 'finance_menu', 'group_name' => 'finance'],

            // ================= Users =================

            ['name' => 'user_add', 'group_name' => 'users'],
            ['name' => 'user_edit', 'group_name' => 'users'],
            ['name' => 'user_delete', 'group_name' => 'users'],
            ['name' => 'user_list', 'group_name' => 'users'],
            ['name' => 'users_menu', 'group_name' => 'users'],

            // ================= Role & Permission =================

            ['name' => 'role_add', 'group_name' => 'role_permission'],
            ['name' => 'role_edit', 'group_name' => 'role_permission'],
            ['name' => 'role_delete', 'group_name' => 'role_permission'],
            ['name' => 'role_list', 'group_name' => 'role_permission'],

            ['name' => 'permission_add', 'group_name' => 'role_permission'],
            ['name' => 'permission_edit', 'group_name' => 'role_permission'],
            ['name' => 'permission_delete', 'group_name' => 'role_permission'],
            ['name' => 'permission_list', 'group_name' => 'role_permission'],

            ['name' => 'assign_permissions_roles', 'group_name' => 'role_permission'],
            ['name' => 'edit_permissions_roles', 'group_name' => 'role_permission'],
            ['name' => 'delete_permissions_roles', 'group_name' => 'role_permission'],
            ['name' => 'permissions_roles_list', 'group_name' => 'role_permission'],
            ['name' => 'roles & permission_menu', 'group_name' => 'role_permission'],

        ];

        // ======================================================
        // CREATE PERMISSIONS
        // ======================================================

        foreach ($permissions as $permission) {

            Permission::updateOrCreate(
                [
                    'name' => $permission['name'],
                    'guard_name' => 'web',
                ],
                [
                    'group_name' => $permission['group_name'],
                ]
            );
        }

        // ======================================================
        // CREATE ROLE
        // ======================================================

        $role = Role::firstOrCreate([
            'name' => 'super_admin',
            'guard_name' => 'web',
        ]);

        // ======================================================
        // ASSIGN ALL PERMISSIONS TO ROLE
        // ======================================================

        $role->syncPermissions(Permission::all());

        // ======================================================
        // CREATE USER
        // ======================================================

        $user = User::updateOrCreate(
            ['user_name' => 'super_admin',
            ],
            [
                'password' => Hash::make('super_admin'),
                'role' => 'staff',
            ]
        );

        // ======================================================
        // ASSIGN ROLE TO USER
        // ======================================================

        $user->assignRole($role);
    }
}