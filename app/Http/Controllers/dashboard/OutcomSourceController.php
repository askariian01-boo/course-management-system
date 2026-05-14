<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\outcome_source;
use Illuminate\Http\Request;

class OutcomSourceController extends Controller
{
    public function SourceList(){
        $outcome_source = outcome_source::all();
        return view('dashboard.outcome.outcome_source.outcome_source_list' , compact('outcome_source'));
    }


    public function SourceAdd(){
        return view('dashboard.outcome.outcome_source.outcome_source_add');
    }


    public function SourceSave(Request $request){
        $request->validate([
            'source_name' => ['required']
        ]);

        outcome_source::create([
            'source_name' => $request->source_name
        ]);

        $notification = array(
            'message' => 'outcome source successfuly created !',
            'alert-type' => 'success'
        );
        return redirect()->route('outcome_source_list')->with($notification);
        
    }


    public function SourceEdit($id){
        $outcome_source = outcome_source::find($id);
        return view('dashboard.outcome.outcome_source.outcome_source_edit' , compact('outcome_source'));
    }



    public function SourceUpdate(Request $request , $id){
        $source = outcome_source::find($id);
        $request->validate([
            'source_name' => ['required']
        ]);

        $source->source_name = $request->source_name;


        $notification = array(
            'message' => 'outcome source successfuly updated !',
            'alert-type' => 'success'
        );
        return redirect()->route('outcome_source_list')->with($notification);
    }



    public function SourceDelete($id){
        $source = outcome_source::find($id);
        $source->delete();

        $notification = array(
            'message' => 'outcome source successfuly deleted !',
            'alert-type' => 'success'
        );
        return redirect()->route('outcome_source_list')->with($notification);
    }
}
