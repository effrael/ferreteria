@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'rounded border-slate-300 text-primary shadow-sm focus:ring-primary block mt-1.5 w-full rounded-xl border-slate-200 px-4 py-2.5 text-sm focus:border-primary focus:ring-primary']) }}>
