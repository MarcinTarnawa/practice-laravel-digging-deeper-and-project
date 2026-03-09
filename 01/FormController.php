<?php

namespace App\Http\Controllers;

use App\Mail\ExpensesPosted;
use App\Models\Category;
use App\Models\Expenses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class FormController extends Controller
{
    /**
     * Wyświetlanie listy wydatków.
     */

    public function index()
    {
        // Pobieramy wydatki tylko dla zalogowanego użytkownika
        $expenses = Expenses::with('category')
            // ->where('user_id', auth()->id()) // Filtracja po użytkowniku
            ->latest()
            ->simplePaginate(3);

        return view('expenses.index', compact('expenses'));
    }

    /**
     * Formularz dodawania.
     */
    public function create()
    {
        return view('expenses.create');
    }

    /**
     * Zapisywanie nowego wydatku.
     */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|min:3|max:255',
            'amount'      => 'required|numeric',
            'date'        => 'required|date',
            'category'    => 'required|string'
        ]);


        $store = Expenses::create([
            'description' => $validated['description'],
            'amount'      => $validated['amount'],
            'date'        => $validated['date'],
            'category_id' => $this->getCategoryId($validated['category']),
            'user_id'     => auth()->id()
        ]);

        if ($request->has('send_email')) {
            Mail::to($request->user())->send(new ExpensesPosted($store));
        }

        return redirect('/expenses')->with('success', 'Wydatek zapisany!');
    }

    /**
     * Formularz edycji.
     */
    public function edit(Expenses $expense)
    {
        $categories = Category::all();
        return view('expenses.edit', compact('expense', 'categories'));
    }

    /**
     * Aktualizacja wydatku.
     */
    public function update(Request $request, Expenses $expense)
    {
        // Gate::authorize('update', $expense);
        $validated = $request->validate([
            'description' => 'required|string|min:3|max:255',
            'amount'      => 'required|numeric',
            'date'        => 'required|date',
            'category'    => 'required|string'
        ]);

        $expense->update([
            'description' => $validated['description'],
            'amount'      => $validated['amount'],
            'date'        => $validated['date'],
            'category_id' => $this->getCategoryId($validated['category'])
        ]);

        return redirect('/expenses')->with('success', 'Wydatek został zaktualizowany!');
    }

    /**
     * Usuwanie wydatku.
     */
    public function destroy(Expenses $expense)
    {
        $expense->delete();
        return back()->with('success', 'Wydatek usunięty.');
    }

    /**
     * Prywatna pomocnicza metoda do obsługi kategorii.
     */
    private function getCategoryId(string $categoryName): int
    {
        $slug = Str::slug(strtolower(trim($categoryName)), '-');
        
        $category = Category::firstOrCreate(['name' => $slug]);

        return $category->id;
    }
}