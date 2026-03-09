<x-layout>
    <x-slot:title>Edytuj wydatek</x-slot:title>

    <div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="/expenses" class="text-sm font-medium text-indigo-600 hover:text-indigo-500 flex items-center gap-1">
                ← Anuluj i wróć
            </a>
        </div>

        <div class="bg-white shadow-xl rounded-2xl border border-gray-100 overflow-hidden">
            <div class="bg-amber-50 px-8 py-6 border-b border-amber-100">
                <h2 class="text-xl font-bold text-amber-900">Edycja wpisu</h2>
                <p class="text-sm text-amber-700 text-opacity-80">Zmieniasz dane dla: <strong>{{ $expense->description }}</strong></p>
            </div>

            <form action="/expenses/{{ $expense->id }}" method="POST" class="p-8 space-y-6">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="date" class="block text-sm font-semibold text-gray-700">Data</label>
                        <input type="date" name="date" id="date" 
                           value="{{ old('date', $expense->date->format('Y-m-d')) }}"
                            class="mt-1 block w-full px-4 py-3 border @error('date') border-red-500 @else border-gray-300 @enderror rounded-xl shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-transparent transition"
                            required>
                        @error('date') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="amount" class="block text-sm font-semibold text-gray-700">Kwota (zł)</label>
                        <input type="number" step="0.01" name="amount" id="amount" 
                            value="{{ old('amount', $expense->amount) }}" 
                            class="mt-1 block w-full px-4 py-3 border @error('amount') border-red-500 @else border-gray-300 @enderror rounded-xl shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-transparent transition"
                            required>
                        @error('amount') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700">Opis</label>
                    <input type="text" name="description" id="description" 
                        value="{{ old('description', $expense->description) }}" 
                        class="mt-1 block w-full px-4 py-3 border @error('description') border-red-500 @else border-gray-300 @enderror rounded-xl shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-transparent transition"
                        required>
                    @error('description') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="category" class="block text-sm font-semibold text-gray-700">Kategoria</label>
                    <select name="category" id="category" 
                        class="mt-1 block w-full px-4 py-3 bg-white border @error('category') border-red-500 @else border-gray-300 @enderror rounded-xl shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-transparent transition" 
                        required>
                        <option value="expense" {{ old('category', $expense->category->name) == 'expense' ? 'selected' : '' }}>Wydatki</option>
                        <option value="income" {{ old('category', $expense->category->name) == 'income' ? 'selected' : '' }}>Przychody</option>
                    </select>
                    @error('category') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center gap-4 pt-4">
                    <button type="submit" class="flex-1 py-3 px-4 rounded-xl shadow-lg text-sm font-bold text-white bg-amber-600 hover:bg-amber-700 transition-all transform hover:scale-[1.01]">
                        Zaktualizuj dane
                    </button>
                    <a href="/expenses" class="px-6 py-3 text-sm font-semibold text-gray-600 hover:text-gray-900 transition">
                        Anuluj
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layout>