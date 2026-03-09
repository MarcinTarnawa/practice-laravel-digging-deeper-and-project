<x-layout>

    <div class="max-w-2xl mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
        <x-formField>
            <x-slot:action>/form</x-slot:action>
            <x-slot:name>name</x-slot:name>
            <x-slot:type>text</x-slot:type>
            <x-slot:placeholder>Twoje Imię</x-slot:placeholder>
            <x-slot:required>required</x-slot:required>
        </x-formField>
    </div>

</x-layout>