<x-layout>

    <main class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="text-center py-20 bg-white rounded-3xl shadow-sm border border-gray-100">
            <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl">
                Zarządzaj swoimi wydatkami <span class="text-indigo-600">mądrzej.</span>
            </h1>
            <p class="mt-4 text-xl text-gray-500 max-w-2xl mx-auto">
                Prosty sposób na kontrolowanie domowego budżetu. Wszystkie Twoje dane w jednym, bezpiecznym miejscu.
            </p>
            <div class="mt-10 flex justify-center gap-4">
                <a href="/expenses" class="px-8 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
                    Sprawdź wydatki
                </a>
                @guest
                <a href="/register" class="px-8 py-3 bg-white text-gray-700 border border-gray-300 font-semibold rounded-lg hover:bg-gray-50 transition">
                    Zacznij teraz
                </a>
                @endguest
            </div>
        </div>
    </main>
    
</x-layout>