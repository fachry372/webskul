<button {{ $attributes->merge(['type' => 'submit', 'class' => 'flex w-full justify-center items-center px-6 py-3 bg-blue-500 border border-transparent rounded-lg font-semibold text-sm text-white  tracking-wider hover:bg-green-600 focus:bg-green-600 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2 transition ease-in-out duration-200']) }}>
    {{ $slot }}
</button>
