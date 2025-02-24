<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Quote Details') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-700">{{ __('Client Details') }}</h3>
            <p><strong>{{ __('Name:') }}</strong> {{ $sale->client->name }}</p>
            <p><strong>{{ __('Work Site:') }}</strong> {{ $sale->work }}</p>
            <p><strong>{{ __('Total:') }}</strong> ${{ number_format($sale->total, 2) }}</p>

            <h3 class="text-lg font-semibold text-gray-700 mt-6">{{ __('Materials Used') }}</h3>
            <table class="min-w-full border-collapse border border-gray-300 mt-4">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">{{ __('Material Name') }}</th>
                        <th class="border border-gray-300 px-4 py-2">{{ __('Quantity') }}</th>
                        <th class="border border-gray-300 px-4 py-2">{{ __('Unit Price') }}</th>
                        <th class="border border-gray-300 px-4 py-2">{{ __('Subtotal') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sale->materials as $material)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $material->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $material->quantity }}</td>
                            <td class="border border-gray-300 px-4 py-2">${{ number_format($material->unit_price, 2) }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                ${{ number_format($material->quantity * $material->unit_price, 2) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-6">
                <x-primary-button class="mt-4">
                    <a href="{{ route('sales.pdf', $sale->id) }}" class="text-dark">
                        {{ __('Generate PDF') }}
                    </a>
                </x-primary-button>
                <x-secondary-button class="mt-4">
                    <a href="{{ route('sales.index') }}" class="text-gray-700">
                        {{ __('Back to Sales') }}
                    </a>
                </x-secondary-button>
            </div>
        </div>
    </div>
</x-app-layout>
