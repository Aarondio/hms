@extends('layouts.base')

@section('body')
    {{-- <div class="flex  justify-center min-h-screen py-12 bg-gray-500 sm:px-6 lg:px-8 "> --}}
    <div class="  min-h-screen m-w-screen  bg-white">
        <div class="grid grid-cols-12 h-screen">
            <div class="lg:col-span-5 bg-purple-600 lg:flex justify-center items-center flex-col hidden">
                <h1 class="text-center text-2xl font-bold text-neutral-200"> <span class="text-white text-3xl">W<span class="italic text-green-300">i</span>se</span> <br>Hospital Management System</h1>
            </div>
            <div class="lg:col-span-7 col-span-12 my-auto px-4 lg:px-24  w-9/12 mx-auto">
                @yield('content')
            </div>
        </div>

        @isset($slot)
            {{ $slot }}
        @endisset
    </div>
@endsection
