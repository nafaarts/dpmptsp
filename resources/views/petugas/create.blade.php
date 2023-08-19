<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Tambah Petugas') }}
            </h2>
        </div>
    </x-slot>

    <x-auth-validation-errors class="mb-4 bg-red-50 border border-red-400 rounded p-4" :errors="$errors" />

    <div class="p-6 bg-white border border-gray-200 shadow rounded-lg">
        <form action="{{ route('petugas.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <x-form.label for="nama" class="mb-2" :value="__('Name')" />
                <x-form.input type="text" name="nama" class="w-full" value="{{ old('nama') }}" id="nama" />
            </div>

            <div class="mb-3">
                <x-form.label for="email" class="mb-2" :value="__('Email')" />
                <x-form.input type="email" name="email" class="w-full" value="{{ old('email') }}" id="email" />
            </div>

            <div class="mb-3">
                <x-form.label for="password" class="mb-2" :value="__('Password')" />
                <x-form.input type="password" name="password" class="w-full" id="password" />
            </div>

            <div class="mb-5">
                <x-form.label for="password_confirmation" class="mb-2" :value="__('Ulangi Password')" />
                <x-form.input type="password" name="password_confirmation" class="w-full" id="password_confirmation" />
            </div>

            <div class="flex gap-3">
                <x-button>Submit</x-button>
                <x-button :href="route('petugas.index')" variant="secondary">Batal</x-button>
            </div>
        </form>
    </div>

</x-app-layout>
