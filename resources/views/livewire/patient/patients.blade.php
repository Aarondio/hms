<div class="">
    <div class="flex justify-between bg-white rounded-lg px-6 py-4 mt-1  ring-gray-200 ring-1">
        <div class="">
            <h1 class="tracking-tight">List of Patients</h1>
            <p class="text-xs text-gray-400">{{ $total }} </p>
        </div>
        <a href="{{ route('new-patient') }}" wire:navigate
            class="flex text-sm tracking-tighter bg-gradient-to-r from-blue-600 to-purple-600 self-center px-4 py-2 text-white rounded-md hover:bg-purple-700">
            <x-heroicon-o-user-plus class="h-5 me-1" /> New Patient</a>
    </div>
    <div class="py-4 mt-1">
        {{ $this->table }}
    </div>
</div>
