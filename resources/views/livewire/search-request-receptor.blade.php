<div class="flex relative flex-1 md:w-1/3 justify-center md:justify-start text-white px-2">
    <div x-data x-init="() => { $refs.query.value = '' }" class="relative w-full">
        <input id="query" x-ref="query" name="query" autocomplete="query" type="search" wire:model="query" placeholder="Search" type="text"
        class="w-full bg-gray-800 text-sm text-white transition border border-transparent focus:outline-none focus:border-gray-700 rounded py-1 px-2 pl-10 appearance-none leading-normal">
        <div class="absolute search-icon" style="top: .5rem; left: .8rem;">
            <svg class="fill-current pointer-events-none text-white w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20">
                <path
                    d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z">
                </path>
            </svg>
        </div>
        @if($query !== null && $query !== '')
        <div style="width: 100%;max-height: 100vh;" class="sticky overflow-y-scroll top-10">
            <div style="width: 100%;" class="bg-gray-800" wire:loading wire:target="query">
                <x-loader />
            </div>
            @livewire('product.search-products')
        </div>
        @endif
    </div>
</div>