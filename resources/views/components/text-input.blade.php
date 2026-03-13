@props(['disabled' => false])

<input @disabled($disabled)
    {{ $attributes->merge(['class' => 'border-gray-200 bg-gray-100 text-gray-700 focus:border-gray-400 focus:ring-gray-400 rounded-md shadow-sm']) }}>
