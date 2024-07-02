<div class="container mx-auto">
    <div class="flex justify-between bg-white rounded-lg px-6 py-4 mt-1  ring-gray-200 ring-1">
        <div class="">
            <h1 class="tracking-tight">List of Inventory</h1>
            <p class="text-xs text-gray-400">{{ $total }} available</p>
        </div>
        {{-- <a href="#" class="flex text-sm tracking-tighter bg-purple-600 self-center px-4 py-2 text-white rounded-md hover:bg-purple-700"> <x-heroicon-o-user-plus class="h-5 me-1" /> New Doctor</a> --}}
    </div>
    <div class="grid grid-cols-12 mt-4 gap-4">

        <div class="col-span-12 md:col-span-6 lg:col-span-7  rounded-lg   mt-1 self-start">

            {{ $this->table }}
         
        </div>
        <div
            class="col-span-12 md:col-span-6 lg:col-span-5 bg-white rounded-lg px-6 py-6 mt-1 self-start  ring-gray-200 ring-1">
            <div class="mb-3">
                <h1 class="text-lg">Add Inventory</h1>
            </div>
            <form wire:submit="create">
                <div class="mb-4">
                    <label for="Inventory name" class="text-sm text-gray-600">Inventory name</label>
                    <input type="text" wire:model="name" placeholder="E.g Panadol"
                        class="rounded-lg w-full placeholder:text-sm focus:ring-purple-600 border-neutral-400 focus:outline-none active:ring-purple-600 focus:border-purple-200">
                    @error('name')
                        <p class="text-sm text-red-500"> {{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="Expiry Date" class="text-sm text-gray-600">Expiry Date</label>
                    <input type="date" wire:model="expiry_date" placeholder="E.g Panadol"
                        class="rounded-lg w-full placeholder:text-sm focus:ring-purple-600 border-neutral-400 focus:outline-none active:ring-purple-600 focus:border-purple-200">
                    @error('expiry_date')
                        <p class="text-sm text-red-500"> {{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="Quantity" class="text-sm text-gray-600">Quantity</label>
                    <input type="number" min="1" wire:model="quantity" placeholder="E.g 20"
                        class="rounded-lg w-full placeholder:text-sm focus:ring-purple-600 border-neutral-400 focus:outline-none active:ring-purple-600 focus:border-purple-200">
                    @error('quantity')
                        <p class="text-sm text-red-500"> {{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button
                        class="flex text-sm tracking-tighter bg-purple-600 self-center px-6 py-2 text-white rounded-md hover:bg-purple-700">Save</button>
                </div>
            </form>
        </div>
    </div>

</div>
