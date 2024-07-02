<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    {{-- @livewireStyles
    @livewireScripts --}}
    <title>{{ $title ?? 'Wise HMS' }}</title>
 

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @filamentStyles
    @vite('resources/css/app.css')
</head>


<body class="bg-neutral-100 relative">
    <div class="flex h-screen">
        <div class="w-80 bg-purple-800 hidden lg:flex flex-col">
            <div class="">
                <div class="px-6 pt-3 ">
                    <a href="#" class="text-white font-bold text-2xl">W<span
                            class="italic text-green-300">i</span>se</span> </a>
                </div>
                <div class="mt-12">

                    <ul class="text-white">

                        <li class="{{ Route::is('dashboard') ? 'bg-purple-500' : '' }} pl-6 py-3 text-white  text-sm ">
                            <a href="{{ route('dashboard') }}" wire:navigate class="self-center flex text-sm">
                                <x-heroicon-o-home name="home" class="h-5 w-5 self-center mr-2" />
                                Dashboard

                            </a>
                        </li>
                        <li class="{{ Route::is('patients') ? 'bg-purple-500' : '' }} pl-6 py-3 text-white  text-sm ">
                            <a href="{{ route('patients') }}" wire:navigate class="self-center flex">
                                <x-heroicon-o-user-group name="home" class="h-5 w-5 self-center mr-2" />
                                Patients
                            </a>
                        </li>
                        <li class="{{ Route::is('staff') ? 'bg-purple-500' : '' }} pl-6 py-3 text-white  text-sm ">
                            <a href="{{ route('staff') }}" wire:navigate class="self-center  flex">
                                <x-heroicon-o-users name="home" class="h-5 w-5 self-center mr-2" />
                                Staffs</a>
                        </li>

                        <li class="{{ Route::is('rooms') ? 'bg-purple-500' : '' }} pl-6 py-3 text-white  text-sm ">
                            <a href="{{ route('rooms') }}" wire:navigate class="self-center flex">
                                <x-heroicon-o-home-modern name="home" class="h-5 w-5 self-center  mr-2" />
                                Wards
                            </a>
                        </li>
                        <li class="{{ Route::is('departments') ? 'bg-purple-500' : '' }} pl-6 py-3 text-white  text-sm ">
                            <a href="{{ route('departments') }}" wire:navigate class="self-center flex">
                                <x-heroicon-o-squares-2x2 name="home" class="h-5 w-5 self-center  mr-2" />
                                Departments
                            </a>
                        </li>
                        <li class="{{ Route::is('inventory') ? 'bg-purple-500' : '' }} pl-6 py-3 text-white  text-sm ">
                            <a href="{{ route('inventory') }}" wire:navigate class="self-center flex">
                                <x-heroicon-o-archive-box-arrow-down name="home" class="h-5 w-5 self-center  mr-2" />
                                Inventories
                            </a>
                        </li>
                        {{-- <li class="{{ Route::is('appointments') ? 'bg-purple-500' : '' }} pl-6 py-3 text-white  text-sm ">
                            <a href="{{ route('appointments') }}" wire:navigate class="self-center flex">
                                <x-heroicon-o-archive-box-arrow-down name="home" class="h-5 w-5 self-center  mr-2" />
                                Appointments
                            </a>
                        </li> --}}
                        <li class="{{ Route::is('notice') ? 'bg-purple-500' : '' }} pl-6 py-3 text-white  text-sm ">
                            <a href="{{ route('notice') }}" wire:navigate class="self-center flex">
                                <x-heroicon-o-speaker-wave name="home" class="h-5 w-5 self-center  mr-2" />
                                Notice
                            </a>
                        </li>
                        <li class="pl-6 py-3 text-red-100  text-sm ">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf 
                                <button type="submit" class="flex"><x-heroicon-o-arrow-left-end-on-rectangle name="home" class="h-5 w-5 self-center  mr-2" /> Logout</button>
                            </form>
                            {{-- <a href="{{ route('notice') }}" wire:navigate class="self-center flex">
                                <x-heroicon-o-arrow-left-end-on-rectangle name="home" class="h-5 w-5 self-center  mr-2" />
                                Logout
                            </a> --}}
                        </li>

                    </ul>
                </div>
            </div>
        </div>


        @php
            $currentRouteName = Route::currentRouteName();
        @endphp
        @switch($currentRouteName)
        

            @case('staff')
                <div class="w-52  bg-[#eeeef0] hidden lg:flex flex-col ">
                    {{-- <img src="{{ asset('assets/icons/toggle.svg') }}" alt=""> --}}
                    <div class="bg-gradient-to-r from-purple-800 to-blue-400 h-16 flex  justify-center items-center text-white">
                        <x-heroicon-o-user-group name="home" class="h-5 w-5 self-center" />
                        <h1 class="font-normal text-sm text-center ms-2">Staff</h1>
                    </div>
                    <div class="flex justify-center items-center  ">
                        <ul class="mt-2">
                            <li class="mt-5 {{  Route::is('search','Doctor') ? 'underline ' : '' }} "><a href="{{ route('search','Doctor') }}" class="text-xs text-purple-600" wire:navigate>Doctors</a></li>
                            <li class="mt-5 {{  Route::is('search','Nurse') ? 'underline ' : '' }} "><a href="{{ route('search','Nurse') }}" class="text-xs text-purple-600" wire:navigate>Nurse</a></li>
                            <li class="mt-5 {{  Route::is('search','Pharmacy') ? 'underline ' : '' }} "><a href="{{ route('search','Pharmacy') }}" class="text-xs text-purple-600" wire:navigate>Pharmarcist</a></li>
                            <li class="mt-5 {{  Route::is('search','Technician') ? 'underline ' : '' }} "><a href="{{ route('search','Technician') }}" class="text-xs text-purple-600" wire:navigate>Lab Technicians</a></li>
                            <li class="mt-5 {{  Route::is('search','Receptionist') ? 'underline ' : '' }} "><a href="{{ route('search','Receptionist') }}" class="text-xs text-purple-600" wire:navigate>Receptionist</a></li>
                    </div>
                </div>
            @break

            @case('search')
                <div class="w-52  bg-[#eeeef0] hidden lg:flex flex-col">
                    {{-- <img src="{{ asset('assets/icons/toggle.svg') }}" alt=""> --}}
                    <div class="bg-gradient-to-r from-purple-800 to-blue-400 h-16 flex  justify-center items-center text-white">
                        <x-heroicon-o-user-group name="home" class="h-5 w-5 self-center" />
                        <h1 class="font-normal text-sm text-center ms-2">Staff</h1>
                    </div>
                    <div class="flex justify-center items-center">
                        <ul class="mt-2">
                            <li class="mt-5 "><a href="{{ route('search','Doctor') }}" class="text-xs text-purple-600" wire:navigate>Doctors</a></li>
                            <li class="mt-5  "><a href="{{ route('search','Nurse') }}" class="text-xs text-purple-600" wire:navigate>Nurse</a></li>
                            <li class="mt-5  "><a href="{{ route('search','Pharmacy') }}" class="text-xs text-purple-600" wire:navigate>Pharmarcist</a></li>
                            <li class="mt-5  "><a href="{{ route('search','Technician') }}" class="text-xs text-purple-600" wire:navigate>Lab Technicians</a></li>
                            <li class="mt-5  "><a href="{{ route('search','Receptionist') }}" class="text-xs text-purple-600" wire:navigate>Receptionist</a></li>
                    </div>
                </div>
            @break

           
          
           

            @default
        @endswitch

        <div class="w-full  overflow-y-auto ">
            <div class="bg-white py-4 px-6 flex justify-between  w-full  h-16">
                <div class="self-center hidden lg:flex flex-col">
                    <h3 class="text-xl  text-gray-900">Hello, {{ Auth::user()->name ?? 'Admin' }} 👋</h3>
                    <p class="text-xs text-gray-500">Welcome to wise hospital management system</p>
                </div>
                <x-heroicon-o-bars-3  class="h-6 w-6 lg:hidden cursor-pointer"/>
            </div>



           <div class="container mx-auto px-4 lg:px-6 py-4">
            {{ $slot }}
            
            @livewire('notifications')
            
            @filamentScripts
            @vite('resources/js/app.js')
           </div>

        </div>
    </div>

</body>

</html>
