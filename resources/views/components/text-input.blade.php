@props(['disabled' => false])

<input @disabled($disabled)
{{ $attributes->merge([
    'class' => 'w-full rounded-2xl border border-slate-200 bg-white px-5 py-4 text-slate-700 shadow-sm focus:border-[#01a3e4] focus:ring focus:ring-[#01a3e4]/20 focus:outline-none'
]) }}>