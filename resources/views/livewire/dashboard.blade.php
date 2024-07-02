<div class="">
    <div class="grid-cols-12 grid gap-4 ">
        <div
            class="h-32 bg-gradient-to-r from-cyan-500 to-blue-500 lg:col-span-3 col-span-12 md:col-span-6 p-4 rounded-lg flex flex-col justify-between">
            <div class="flex">
                <div class="h-10 w-10 rounded-full bg-cyan-600 justify-center items-center flex self-center">
                    <x-heroicon-o-user-group name="home" class="h-5 w-5 self-center text-white" />
                </div>
                <h1 class="text-white self-center ml-4 font-medium lg:font-semibold text-sm">Patients</h1>
            </div>
            <div class="flex justify-between">
                <h1 class="text-white self-center font-semibold text-lg xl:text-xl">{{ number_format($total_patients) }}
                </h1>
                <div class="h-6 w-14 rounded-full bg-white opacity-80 justify-center items-center flex self-center">
                    <p class="text-xs">22.0%</p>
                </div>
            </div>
        </div>
        <div
            class="h-32 bg-gradient-to-r from-indigo-500  to-blue-500  col-span-12 lg:col-span-3 md:col-span-6 p-4 rounded-lg flex flex-col justify-between">
            <div class="flex">
                <div class="h-10 w-10 rounded-full bg-indigo-700 justify-center items-center flex self-center">
                    <x-heroicon-o-currency-dollar class="h-5 w-5 self-center text-white " />
                </div>
                <h1 class="text-white self-center ml-4 font-medium lg:font-semibold text-sm ">Income Generated</h1>
            </div>
            <div class="flex justify-between">
                <h1 class="text-white self-center font-semibold text-lg lg:text-xl">
                    ₦{{ number_format($income) }}</h1>
                <div class="h-6 w-14 rounded-full bg-white opacity-80 justify-center items-center flex self-center">
                    <p class="text-xs">22.0%</p>
                </div>
            </div>
        </div>
        <div
            class="h-32 bg-gradient-to-r from-blue-500 to-cyan-500 lg:col-span-3 col-span-12  md:col-span-6  p-4 rounded-lg flex flex-col justify-between">
            <div class="flex">
                <div class="h-10 w-10 rounded-full bg-blue-600 justify-center items-center flex self-center">
                    <x-heroicon-o-home-modern class="h-5 w-5 self-center text-white " />
                </div>
                <h1 class="text-white self-center ml-4 font-medium lg:font-semibold text-sm">Wards</h1>
            </div>
            <div class="flex justify-between">
                <h1 class="text-white self-center font-semibold text-lg lg:text-xl">{{ number_format($total_wards) }}
                </h1>
                <div class="h-6 w-14 rounded-full bg-white opacity-80 justify-center items-center flex self-center">
                    <p class="text-xs">22.0%</p>
                </div>
            </div>
        </div>
        <div
            class="h-32 bg-gradient-to-r from-purple-500 to-blue-500 lg:col-span-3 col-span-12  md:col-span-6  p-4 rounded-lg flex flex-col justify-between">
            <div class="flex">
                <div class="h-10 w-10 rounded-full bg-purple-400 justify-center items-center flex">
                    <x-heroicon-o-users name="home" class="h-5 w-5 self-center text-white" />
                </div>
                <h1 class="text-white self-center ml-4 font-medium lg:font-semibold text-sm">Staff</h1>
            </div>
            <div class="flex justify-between">
                <h1 class="text-white self-center font-semibold text-lg lg:text-xl">{{ number_format($total_staff) }}
                </h1>
                <div class="h-6 w-14 rounded-full bg-white opacity-80 justify-center items-center flex self-center">
                    <p class="text-xs">22.0%</p>
                </div>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-12 mt-6 gap-4">
        <div class=" col-span-12  lg:col-span-6 px-0 py-0 rounded-lg">
            <div class="flex justify-between">
                <h1 class="font-medium">New Patients</h1>
                <a href="{{ route('patients') }}" class="text-sm text-purple-600" wire:navigate>see all</a>
            </div>
            {{-- <div class="flex justify-between mt-4">
                   <input type="search" placeholder="Search patient" class="rounded-lg w-full placeholder:text-sm focus:ring-purple-600 border-purple-600 focus:outline-none active:ring-purple-600">
                
              </div> --}}
            <div class="mt-4">
                {{ $this->table }}
            </div>
        </div>
        <div class=" col-span-12  lg:col-span-6 px-0 py-0 rounded-lg self-start">
            <div class="flex justify-between">
                <h1 class="font-medium">Announcement</h1>
                <a href="{{ route('notice') }}" class="text-sm text-purple-600" wire:navigate>see all</a>
            </div>

            @if ($notices->isEmpty())
                <div
                    class="mt-4 bg-red-100 text-red-600 text-center flex justify-center flex-col items-center py-5 rounded-xl border-red-200 border">
                    <x-heroicon-o-bell class="h-10 w-10" />
                    <p>No annnouncement at the moment</p>
                </div>
            @else
                <div class="bg-yellow-50 border-l-4 border-purple-600  p-6 my-3 rounded-lg mt-4">
                    @foreach ($notices as $notice)
                        <li class="font-medium text-sm text-gray-800 mt-2">
                            {{ $notice->message }}
                        </li>
                    @endforeach
                </div>
            @endif

        </div>

    </div>
</div>
