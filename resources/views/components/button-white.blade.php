<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-white border border-blue-400 rounded-md font-semibold text-xs text-blue-500 uppercase tracking-widest hover:bg-blue-500 hover:text-white active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-400 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
