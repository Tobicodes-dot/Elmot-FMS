<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'w-full bg-[#01a3e4] hover:bg-sky-500 hover:scale-[1.01] transition-all duration-200 text-white font-semibold py-4 rounded-2xl shadow-lg shadow-sky-100'
]) }}>
    {{ $slot }}
</button>