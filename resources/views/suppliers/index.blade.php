<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Suppliers') }}
    </h2> 

    <x-primary-button class="mt-4">
        <a href="{{ route('suppliers.create') }}" class="text-dark">
            {{ __('Create supplier') }}
        </a>
    </x-primary-button>
        
</x-slot>
<div class="container mx-auto mt-4">
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
        <h1 class="text-2xl font-bold mb-4">{{ __('Suppliers list') }}</h1>

        <table class="table-auto w-full text-left bg-white shadow-md rounded-lg">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2">{{ __('ID') }}</th>
                    <th class="px-4 py-2">{{ __('Name') }}</th>
                    <th class="px-4 py-2">{{ __('Email') }}</th>
                    <th class="px-4 py-2">{{ __('Phone number') }}</th>
                    <th class="px-4 py-2">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($suppliers as $supplier)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $supplier->id }}</td>
                        <td class="px-4 py-2">{{ $supplier->name }}</td>
                        <td class="px-4 py-2">{{ $supplier->email }}</td>
                        <td class="px-4 py-2">{{ $supplier->phone_number }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('suppliers.show', $supplier->id) }}" class="text-blue-600 hover:underline">{{ __('View') }}</a> |
                            <a href="{{ route('suppliers.edit', $supplier->id) }}" class="text-blue-600 hover:underline">{{ __('Edit') }}</a> |
                            <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-2 text-center">{{ __('No suppliers found') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


</x-app-layout>