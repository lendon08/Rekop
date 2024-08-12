

<label {!! $attributes->merge(['class' =>'inline-flex text-center w-full p-2 text-gray-500 bg-white border-2 border-gray-500 rounded-lg cursor-pointer peer-checked:border-green-600 peer-checked:bg-green-600 peer-checked:text-white hover:text-dark-600 peer-checked:text-dark-600 hover:bg-dark-50']) !!}>
    <div class="w-full font-semibold">{{ $slot }}</div>
</label>

