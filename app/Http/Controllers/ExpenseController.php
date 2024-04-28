<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function index()
{
    $expenses = Expense::latest()->get(); // Ambil daftar catatan pengeluaran terbaru
    $totalExpenses = Expense::sum('amount'); // Hitung total pengeluaran
    return view('home', compact('expenses', 'totalExpenses'));
}

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required|nullable',
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]);

        $expense = new Expense();
        $expense->title = $request->title;
        $expense->description = $request->description;
        $expense->amount = $request->amount;
        $expense->date = $request->date;
        Auth::user()->expenses()->save($expense);

        return redirect()->route('expenses.index')->with('success', 'Expense created successfully.');
    }

    public function show($id)
    {
        $expense = Expense::findOrFail($id);
        return view('expenses.show', compact('expense'));
    }

    public function edit($id)
    {
        $expense = Expense::findOrFail($id);
        return view('edit', compact('expense'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]);

        $expense = Expense::findOrFail($id);
        $expense->title = $request->title;
        $expense->description = $request->description;
        $expense->amount = $request->amount;
        $expense->date = $request->date;
        $expense->save();

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully.');
    }

    public function destroy($id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();

        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully.');
    }

    public function filterByDate(Request $request)
{
    $request->validate([
        'start_date' => 'required|date_format:Y-m-d',
        'end_date' => 'required|date_format:Y-m-d|after_or_equal:start_date',
    ]);

    $expenses = Expense::whereBetween('date', [$request->start_date, $request->end_date])
                    ->latest()
                    ->get();

    $totalExpenses = $expenses->sum('amount'); // Hitung total pengeluaran

    return view('home', compact('expenses', 'totalExpenses'));
}



}