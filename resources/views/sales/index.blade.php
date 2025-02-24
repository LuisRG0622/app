<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sales') }}
        </h2>

        @foreach ($clients as $client)
            <x-primary-button class="mt-4">
                <a href="{{ route('sales.create', ['clientId' => $client->id]) }}" class="text-dark">
                    {{ __('Quote') }}
                </a>
            </x-primary-button>
        @endforeach
    </x-slot>

    <h1 class="text-lg font-bold text-black-700 mt-6">{{ __('Quote History') }}</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-4 shadow-md">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto shadow-lg rounded-lg mt-4 mx-auto w-full max-w-7xl">
        <table class="min-w-full border-collapse table-auto">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="border border-gray-300 px-6 py-3 text-left">{{ __('Client Name') }}</th>
                    <th class="border border-gray-300 px-6 py-3 text-left">{{ __('Work Site') }}</th>
                    <th class="border border-gray-300 px-6 py-3 text-left">{{ __('Total') }}</th>
                    <th class="border border-gray-300 px-6 py-3 text-left">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody class="bg-white text-gray-700">
                @foreach ($quotes as $quote)
                    <tr class="hover:bg-gray-100">
                        <td class="border border-gray-300 px-6 py-4">{{ $quote->client->name }}</td>
                        <td class="border border-gray-300 px-6 py-4">{{ $quote->work }}</td>
                        <td class="border border-gray-300 px-6 py-4">${{ number_format($quote->total, 2) }}</td>
                        <td class="border border-gray-300 px-6 py-4">
                            <a href="{{ route('quotes.edit', $quote->id) }}" class="text-blue-500 hover:underline ml-2">{{ __('Show') }}</a>
                            
                            <!-- Agregar botón de eliminar -->
                            <form action="{{ route('sales.destroy', $quote->id) }}" method="POST" class="inline-block ml-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">{{ __('Delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
