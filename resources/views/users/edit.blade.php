<x-guest-layout>
    <form method="POST" action="{{ route('users.update', $user->id) }}">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$user->name" required />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$user->email" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Role')" />
            <select id="role" name="role" class="block mt-1 w-full" required>
                <option value="super_admin" {{ $user->role == 'super_admin' ? 'selected' : '' }}>Super Administrator</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Administrator</option>
                <option value="warehouse" {{ $user->role == 'warehouse' ? 'selected' : '' }}>Usuario de almacen</option>
                <option value="sales" {{ $user->role == 'sales' ? 'selected' : '' }}>Usuario de ventas</option>
                <option value="historic" {{ $user->role == 'historic' ? 'selected' : '' }}>Usuario historico</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Submit Buttons -->
        <div style="text-align: center;" class="mt-4">
            <x-primary-button class="ms-4">
                {{ __('Update user') }}
            </x-primary-button>

            <a href="{{ route('users.index') }}" class="ms-4 inline-block px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:bg-gray-500 active:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Cancel') }}
            </a>
        </div>
    </form>
</x-guest-layout>
