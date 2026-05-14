<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\StaffDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StaffDocumentController extends Controller
{
    public function index()
    {
        $document = StaffDocument::all();
        return view('dashboard.staff.staff_documents.staff_document')->with('documents', $document);
    }


    public function DocumentAdd()
    {
        $staff = Staff::all();
        return view('dashboard.staff.staff_documents.staff_document_add')->with('staffs', $staff);
    }


    public function DocumentSave(Request $request)
    {
        $data = $request->validate([
            'document_name' => ['required', 'string', 'max:255'],
            'document_file' => ['required', 'file'],
            'uplode_date' => ['required', 'date'],
            'staff_id' => ['required', 'integer'],
        ]);

        // ذخیره فایل در مسیر public/files/Staff_documents
        $document_file = $request->file('document_file');
        $filename = time() . '-' . $document_file->getClientOriginalName();
        $document_file->move(public_path('files/Staff_documents'), $filename);

        // ذخیره اطلاعات در دیتابیس
        StaffDocument::create([
            'document_name' => $request->document_name,
            'uplode_date' => $request->uplode_date,
            'staff_id' => $request->staff_id,
            'document_file' => $filename
        ]);

        $notification = array(
            'message' => 'staff document successfuly created !',
            'alert-type' => 'success'
        );
        return redirect()->route('staff_document')->with($notification);
    }


    public function download($filename)
    {
        // مسیر کامل فایل در public
        $path = public_path('files/Staff_documents/' . $filename);
        // بررسی وجود فایل
        if (!file_exists($path)) {
            return redirect()->back()->with('error', 'Not Found !');
        }
        // دانلود فایل
        return response()->download($path);
    }



    public function DocumentEdit($id)
    {
        $staff = Staff::all();
        $document = StaffDocument::find($id);

        return view('dashboard.staff.staff_documents.staff_document_edit')->with('staffs', $staff)->with('document', $document);
    }


    public function DocumentUpdate(Request $request, $id)
    {
        $document = StaffDocument::find($id);
        // dd($document);
        $data = $request->validate([
            'document_name' => ['required', 'string', 'max:255'],
            'uplode_date' => ['required', 'date'],
            'staff_id' => ['required', 'integer'],
        ]);

        if (!is_null($request->document_file)) {
            $request->validate([
                'document_file' => ['required', 'file'],
            ]);
        }
        // dd($request->all());
        $document->staff_id = $request->staff_id;
        $document->document_name = $request->document_name;
        $document->uplode_date = $request->uplode_date;

        $document_file = $request->file('document_file');
        if ($document_file) {
            $filename = time() . '-' . $document_file->getClientOriginalName();
            $document_file->move(public_path('files/staff_documents') . $filename);

            $document->document_file = $filename;
        }
        $document->save();
        $notification = array(
            'message' => 'staff document successfuly updated !',
            'alert-type' => 'success'
        );
        return redirect()->route('staff_document')->with($notification);
    }


    public function DocumentDelete($id)
    {
        $document = StaffDocument::find($id);
        //پیدا کردن عکس 
        $path = public_path('files/staff_documents') . '/' . $document->document_file;
        //وجود داشتن عکس
        if (File::exists($path)) {
            File::delete($path);
            $document->delete();
        }
        $notification = array(
            'message' => 'staff document successfuly deleted !',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
