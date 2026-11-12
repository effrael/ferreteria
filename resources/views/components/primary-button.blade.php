<button {{ $attributes->merge(['type' => 'submit', 'class' => 'iw-full flex justify-center items-center py-3 px-4 rounded-xl bg-primary text-white text-sm font-semibold shadow-lg shadow-primary/25 hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-all cursor-pointer']) }}>
    {{ $slot }}
</button>
