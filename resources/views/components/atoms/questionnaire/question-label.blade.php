

<label {!! $attributes->merge(['class' =>'inline-flex text-center w-full p-2 text-gray-500 bg-white border-2 border-gray-500 rounded-lg cursor-pointer dark:hover:text-dark-300 dark:border-dark-700 peer-checked:border-green-600 peer-checked:bg-green-600 peer-checked:text-white hover:text-dark-600 dark:peer-checked:text-dark-300 peer-checked:text-dark-600 hover:bg-dark-50 dark:text-dark-400 dark:bg-dark-800 dark:hover:bg-dark-700']) !!}>
    <div class="w-full font-semibold">{{ $slot }}</div>
</label>

