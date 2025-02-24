<form method="GET" action="{{ route('search') }}" class="flex items-center">
    <input 
        type="text" 
        name="query" 
        placeholder="Buscar..." 
        class="form-input w-full"
        value="{{ request('query') }}" 
        required>
    <button type="submit" class="ml-2 bg-blue-500 text-white py-2 px-4 rounded">
        Buscar
    </button>
</form>
