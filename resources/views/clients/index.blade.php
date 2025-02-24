<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Clients') }}
    </h2>

    <x-primary-button class="mt-4">
        <a href="{{ route('clients.create') }}" class="text-dark">
            {{ __('Create client') }}
        </a>
    </x-primary-button>

        
</x-slot>
<div class="container mx-auto mt-8">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table-auto w-full border-collapse bg-white shadow-md">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">Name</th>
                    <th class="px-4 py-2 border">Address</th>
                    <th class="px-4 py-2 border">Phone</th>
                    <th class="px-4 py-2 border">Email</th>
                    <th class="px-4 py-2 border">RFC</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                    <tr>
                        <td class="border px-4 py-2">{{ $client->name }}</td>
                        <td class="border px-4 py-2">{{ $client->address }}</td>
                        <td class="border px-4 py-2">{{ $client->phone }}</td>
                        <td class="border px-4 py-2">{{ $client->email }}</td>
                        <td class="border px-4 py-2">{{ $client->rfc }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-black dark:text-dark-100 text-center">
                            <a href="{{ route('clients.edit', $client->id) }}" class="text-blue-600 hover:underline">{{ __('Edit') }}</a> |
                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>