<div x-data="{ initial: true, deleting: false }" class="text-sm flex items-center">
    <button
        x-on:click.prevent="deleting = true; initial = false"
        x-show="initial"
        x-on:deleting.window="$el.disabled = true"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 transform scale-90"
        x-transition:enter-end="opacity-100 transform scale-100"
        class="inline-flex justify-center items-center w-24 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25"
    >
        {{ $buttonText }}
    </button>

    <div
        x-show="deleting"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 transform scale-90"
        x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90"
        class="flex items-center space-x-3"
        x-cloak
    >
        <span class="dark:text-white ml-4">@lang('Are you sure?')</span>

        <form x-on:submit="$dispatch('deleting')" method="post" action="{{ $action }}">
            @csrf
            @method('delete')

            <button
                x-on:click="$el.form.submit()"
                x-on:deleting.window="$el.disabled = true"
                type="submit"
                class="text-white px-4 py-2 rounded-md bg-red-600 hover:bg-red-700 disabled:opacity-50"
            >
                @lang('Yes')
            </button>

            <button
                x-on:click.prevent="deleting = false; setTimeout(() => { initial = true }, 150)"
                x-on:deleting.window="$el.disabled = true"
                class="text-white w-24 py-2 rounded-md bg-gray-300 hover:bg-gray-400 disabled:opacity-50"
            >
                @lang('No')
            </button>
        </form>
    </div>
</div>
