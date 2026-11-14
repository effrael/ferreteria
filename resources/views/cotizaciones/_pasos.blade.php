{{-- Indicador de pasos. Uso: @include('cotizaciones._pasos', ['paso' => 1]) --}}
@php $textos = [1 => 'Cotización', 2 => 'Pago', 3 => 'Orden de venta']; @endphp
<ol class="flex items-center gap-3 text-xs">
    @foreach ($textos as $n => $texto)
        <li class="flex items-center gap-2">
            <span class="flex h-5 w-5 items-center justify-center rounded-full text-[10px] font-bold {{ $n <= $paso ? 'bg-[var(--color-primary)] text-white' : 'bg-slate-200 text-slate-500' }}">{{ $n }}</span>
            <span class="{{ $n === $paso ? 'font-semibold text-slate-800' : 'text-slate-400' }}">{{ $texto }}</span>
        </li>
        @if (! $loop->last)
            <li class="text-slate-300">—</li>
        @endif
    @endforeach
</ol>
