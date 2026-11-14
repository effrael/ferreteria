<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Crear Cliente') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">

            @if ($errors->any())
                <div class="rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
                    <p class="font-semibold mb-1">Por favor corrige los siguientes errores:</p>
                    <ul class="list-disc pl-5 space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-xl border border-slate-200/90 shadow-2xs overflow-hidden p-6">
                <form method="POST" action="{{ route('admin.usuarios.store') }}">
                    @csrf
                    @include('usuarios._form')
                </form>
            </div>
        </div>
    </div>
</x-app-layout>