<x-mail::message>
Hello!
New {{ $expense->category->name }}:

<h1>{{ $expense->description }}</h1>

<p>
    <strong>Thanks, {{ $expense->user->name }}!</strong>
</p>

<x-mail::button :url="url('/expenses')">
    Check your expenses
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
