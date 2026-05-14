<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\IncomeSource;
use Illuminate\Http\Request;

class IncomeSourceController extends Controller
{
    public function SourceList()
    {
        $income_source = IncomeSource::all();
        return view('dashboard.income.income_source.income_source_list', compact('income_source'));
    }


    public function SourceAdd()
    {
        return view('dashboard.income.income_source.income_source_add');
    }


    public function SourceSave(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $income = IncomeSource::create([
            'source_name' => $request->name
        ]);
        $income->save();
        $notification = array(
            'message' => 'income source successfuly created',
            'alert-type' => 'success'
        );
        return redirect()->route('income_source_list')->with($notification);
    }


    public function SourceEdit($id){
        $source = IncomeSource::find($id);
        return view('dashboard.income.income_source.income_source_edit' , compact('source'));
    }


    public function SourceUpdate(Request $request , $id){
        $source = IncomeSource::findOrFail($id);
        $request->validate([
            'name' => 'required'
        ]);

        $source->source_name = $request->name;
        $source->save();
        $notification = array(
            'message' => 'income source successfuly updated',
            'alert-type' => 'success'
        );
        return redirect()->route('income_source_list')->with($notification);
    }


    public function SourceDelete($id){
        $source = IncomeSource::findOrFail($id);
        $source->delete();
        $notification = array(
            'message' => 'income source successfuly deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
