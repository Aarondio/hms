<div class="container mx-auto">

    <div class="flex justify-between bg-white rounded-xl px-6 py-4 mt-1 ring-gray-200 ring-1">
        <div class="">
            <h1 class="tracking-tight">All Staff</h1>
            <p class="text-xs text-gray-400">{{ $total }}</p>
        </div>
        <a href="{{ route('new-staff') }}"
            class="flex text-sm tracking-tighter bg-purple-600 self-center px-4 py-2 text-white rounded-md hover:bg-purple-700">
            <x-heroicon-o-user-plus class="h-5 me-1" /> New Staff</a>
    </div>
    <div class="mt-3  rounded-lg ">

        {{ $this->table }}
    </div>

</div>
