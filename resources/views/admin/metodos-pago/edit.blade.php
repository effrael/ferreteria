<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                {{ __('Editar método de pago') }}
            </h2>
            <a href="{{ route('admin.metodos-pago.index') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900">
                ← Volver a métodos de pago
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl border border-slate-200/90 shadow-2xs p-6 sm:p-8">

                @if ($errors->any())
                    <div class="mb-6 rounded-lg bg-red-50 border border-red-200 p-4 text-sm text-red-700">
                        <p class="font-semibold mb-1">Corrige los siguientes errores:</p>
                        <ul class="list-disc pl-5 space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.metodos-pago.update', $metodosPago) }}" method="POST" novalidate class="space-y-5">
                    @csrf
                    @method('PUT')
                    @include('admin.metodos-pago._form', ['textoBoton' => 'Guardar cambios'])
                </form>

            </div>
        </div>
    </div>
</x-app-layout>