<form action="{{ $action }}" method="post" class="flex flex-wrap items-center gap-4">
    @csrf
    
    <div class="w-full md:w-1/3">
        <input type="{{ $type }}" 
               name="{{ $name }}" 
               placeholder="{{ $placeholder }}" 
               {{ $required }}
               class="block w-full px-4 py-2 rounded-md border border-gray-300 shadow-sm 
                      focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 
                      placeholder-gray-400 transition duration-150">
    </div>

    <div class="w-full md:w-40">
        <button type="submit" 
                class="w-full px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold 
                       rounded-md shadow-md transition-colors duration-200">
            Zapisz
        </button>
    </div>

    <div class="flex items-center">
        <a href="/" class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition">
            Powrót
        </a>
    </div>

    @if($errors->any())
        <div class="w-full p-4 mt-2 bg-red-50 border-l-4 border-red-500 rounded-md">
            <div class="flex">
                <div class="flex-shrink-0">
                    </div>
                <div class="ml-3">
                    @foreach ($errors->all() as $error)
                        <p class="text-sm text-red-700 leading-relaxed">{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</form>