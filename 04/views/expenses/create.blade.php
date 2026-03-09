<x-layout>
    <x-slot:title>Dodaj nowy wydatek</x-slot:title>

    <div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="/expenses" class="text-sm font-medium text-indigo-600 hover:text-indigo-500 flex items-center gap-1">
                ← Powrót do listy
            </a>
        </div>

        <div class="bg-white shadow-xl rounded-2xl border border-gray-100 overflow-hidden">
            <div class="bg-gray-50 px-8 py-6 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-900">Nowy wpis</h2>
                <p class="text-sm text-gray-500">Wybierz typ transakcji i uzupełnij szczegóły.</p>
            </div>

            <form action="/expenses" method="POST" class="p-8 space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="date" class="block text-sm font-semibold text-gray-700">Data</label>
                        <input type="date" name="date" id="date" 
                            value="{{ old('date', date('Y-m-d')) }}" 
                            class="mt-1 block w-full px-4 py-3 border @error('date') border-red-500 @else border-gray-300 @enderror rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                            required>
                        @error('date') <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="amount" class="block text-sm font-semibold text-gray-700">Kwota (zł)</label>
                        <input type="number" step="0.01" name="amount" id="amount" 
                            value="{{ old('amount') }}" 
                            placeholder="0.00"
                            class="block w-full px-4 py-3 border @error('amount') border-red-500 @else border-gray-300 @enderror rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                            required>
                        @error('amount') <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700">Opis</label>
                    <input type="text" name="description" id="description" 
                        value="{{ old('description') }}" 
                        placeholder="Na co wydano pieniądze?"
                        class="mt-1 block w-full px-4 py-3 border @error('description') border-red-500 @else border-gray-300 @enderror rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                        required>
                    @error('description') <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="category" class="block text-sm font-semibold text-gray-700">Kategoria</label>
                    <select name="category" id="category" 
                        class="mt-1 block w-full px-4 py-3 bg-white border @error('category') border-red-500 @else border-gray-300 @enderror rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition appearance-none" 
                        required>
                        <option value="" disabled>Wybierz kategorię</option>
                        <option value="expense">Wydatki</option>
                        <option value="income">Przychody</option>
                    </select>
                    @error('category') <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                </div>

                <div>
                    <strong>Wyślij na mój adres email</strong>
                    <input type="checkbox" name="send_email" id="send_email" value="1">
                    <label for="send_email" class="block text-sm font-semibold text-gray-700"></label>
                </div>
                <button type="submit" class="w-full flex justify-center py-3 px-4 rounded-xl shadow-lg text-sm font-bold text-white bg-green-600 hover:bg-green-700 transition-all transform hover:scale-[1.01]">
                    Zapisz transakcję
                </button>
            </form>
        </div>
    </div>
</x-layout>