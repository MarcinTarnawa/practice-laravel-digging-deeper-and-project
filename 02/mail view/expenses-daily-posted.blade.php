<x-mail::message>
# Cześć!

Oto Twoje wczorajsze wydatki:

@foreach ($expenses as $expense)
* **Opis:** {{ $expense->description }} — **Kwota:** {{ number_format($expense->amount, 2) }} PLN , **Data:** {{ $expense->date }} Typ : {{ $expense->category->name }}
@endforeach

<x-mail::button :url="url('/expenses')">
Sprawdź wszystkie wydatki
</x-mail::button>

Dzięki,<br>
{{ config('app.name') }}
</x-mail::message>