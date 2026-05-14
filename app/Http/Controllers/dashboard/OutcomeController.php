<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\outcome;
use App\Models\outcome_source;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class OutcomeController extends Controller
{
    public function OutcomeList(Request $request){
        $query = outcome::with('source');

        // فلتر سال
        if ($request->filled('year')) {
            $query->whereYear('outcome_date', $request->year);
        }

        // فلتر ماه
        if ($request->filled('month')) {
            $query->whereMonth('outcome_date', $request->month);
        }

        // گرفتن دیتا
        $outcomes = $query->latest()->get();
        return view('dashboard.outcome.outcome_list' , compact('outcomes'));
    }


    public function OutcomeAdd(){
        $sources = outcome_source::all();
        return view('dashboard.outcome.outcome_add' , compact('sources'));
    }


    public function OutcomeSave(Request $request){
        $request->validate([
            'amount' => ['required' , 'numeric' , 'max_digits:30000'],
            'date' => ['required' , 'date'],
            'remark' => ['nullable'],
            'source_id' => ['required']
        ]);

        $outcome = outcome::create([
            'outcome_amount' => $request->amount,
            'outcome_date' => $request->date,
            'remark' => $request->remark,
            'source_id' => $request->source_id
        ]);
        $outcome->save();

        $notification = array(
            'message' => 'outcome  successfuly created',
            'alert-type' => 'success'
        );
        return redirect()->route('outcome_list')->with($notification);
    }


    public function OutcomeEdit($id){
        $sources = outcome_source::all();
        $outcome = outcome::find($id);

        return view('dashboard.outcome.outcome_edit' ,compact('sources' , 'outcome'));
    }



    public function OutcomeUpdate(Request $request , $id){
        $outcome = outcome::find($id);
        $request->validate([
            'amount' => ['required' , 'numeric' , 'max_digits:30000'],
            'date' => ['required' , 'date'],
            'remark' => ['nullable'],
            'source_id' => ['required']
        ]);

        $outcome->outcome_amount = $request->amount;
        $outcome->outcome_date = $request->date;
        $outcome->remark = $request->remark;
        $outcome->source_id = $request->source_id;

        $notification = array(
            'message' => 'outcome successfuly updated',
            'alert-type' => 'success'
        );
        return redirect()->route('outcome_list')->with($notification);

    }



    public function OutcomeDelete($id){
        $outcome = outcome::find($id);
        $outcome->delete();

        $notification = array(
            'message' => 'outcome successfuly deleted',
            'alert-type' => 'success'
        );
        return redirect()->route('outcome_list')->with($notification);
    }

}
 