<x-layout>
    <x-slot:title>Statystyki Rodzinne</x-slot:title>

    <div class="max-w-6xl mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold text-gray-900 mb-8">Podsumowanie Wydatków {{ date('Y') }}</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <p class="text-sm font-medium text-gray-500 uppercase">W tym miesiącu</p>
                <p class="text-3xl font-bold text-indigo-600">{{ number_format($currentMonthSum, 2) }} zł</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <p class="text-sm font-medium text-gray-500 uppercase">Średnia miesięczna (rok)</p>
                <p class="text-3xl font-bold text-gray-800">{{ number_format($yearlyAverage, 2) }} zł</p>
            </div>
        </div>
        <p>Suma w tym miesiącu: {{ number_format($currentMonthSum, 2, ',', ' ') }} zł</p>

        <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-sm font-semibold text-gray-900">Miesiąc</th>
                        <th class="px-6 py-4 text-sm font-semibold text-gray-900">Suma</th>
                        <th class="px-6 py-4 text-sm font-semibold text-gray-900">Vs. Średnia</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($monthlyStats as $stat)
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-700 font-medium">
                            {{ ucfirst($stat->month_name) }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900 font-bold">
                            {{ number_format($stat->total, 2, ',', ' ') }} zł
                        </td>
                        <td class="px-6 py-4 text-sm">
                            @if($stat->percentage_diff > 0)
                            <span class="text-red-600 font-semibold text-xs bg-red-50 px-2 py-1 rounded-full">
                                ↑ {{ $stat->percentage_diff }}% więcej
                            </span>
                            @elseif($stat->percentage_diff < 0)
                                <span class="text-green-600 font-semibold text-xs bg-green-50 px-2 py-1 rounded-full">
                                ↓ {{ abs($stat->percentage_diff) }}% mniej
                                </span>
                                @else
                                <span class="text-gray-400 text-xs">Średnia</span>
                                @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>