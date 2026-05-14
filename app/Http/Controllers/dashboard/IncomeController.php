<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Income;
use App\Models\IncomeSource;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function incomeList(Request $request)
    {
        $query = Income::with('IncomeSource');

        // فلتر سال
        if ($request->filled('year')) {
            $query->whereYear('income_date', $request->year);
        }

        // فلتر ماه
        if ($request->filled('month')) {
            $query->whereMonth('income_date', $request->month);
        }

        // گرفتن دیتا
        $incomes = $query->latest()->get();
        return view('dashboard.income.income_list', compact('incomes'));
    }


    public function incomeAdd()
    {
        $sources = IncomeSource::all();
        return view('dashboard.income.income_add', compact('sources'));
    }


    public function incomeSave(Request $request)
    {
        $request->validate([
            'amount' => ['required', 'numeric', 'max_digits:30000'],
            'date' => ['required', 'date'],
            'source_id' => ['required']
        ]);

        $income = income::create([
            'income_amount' => $request->amount,
            'income_date' => $request->date,
            'source_id' => $request->source_id
        ]);
        $income->save();

        $notification = array(
            'message' => 'income successfuly created',
            'alert-type' => 'success'
        );
        return redirect()->route('income_list')->with($notification);
    }


    public function incomeEdit($id)
    {
        $sources = IncomeSource::all();
        $income = income::find($id);

        return view('dashboard.income.income_edit', compact('sources', 'income'));
    }



    public function incomeUpdate(Request $request, $id)
    {
        $income = income::find($id);
        $request->validate([
            'amount' => ['required', 'numeric', 'max_digits:30000'],
            'date' => ['required', 'date'],
            'source_id' => ['required']
        ]);

        $income->income_amount = $request->amount;
        $income->income_date = $request->date;
        $income->source_id = $request->source_id;
        $income->save();

        $notification = array(
            'message' => 'income successfuly updated',
            'alert-type' => 'success'
        );
        return redirect()->route('income_list')->with($notification);
    }



    public function incomeDelete($id)
    {
        $income = income::find($id);
        $income->delete();

        $notification = array(
            'message' => 'income successfuly deleted',
            'alert-type' => 'success'
        );
        return redirect()->route('income_list')->with($notification);
    }
}
