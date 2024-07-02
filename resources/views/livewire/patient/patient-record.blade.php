<div class="">
    <div class="flex justify-between bg-white rounded-lg px-6 py-4 mt-1  ring-gray-200 ring-1">
        <div class="">
            <h1 class="tracking-tight">Patient Record</h1>
        </div>

    </div>
    <div class="bg-blue-100 rounded-lg px-4 py-4   ring-gray-200 ring-1 mt-4">
        <div class="lg:flex  justify-between">
            <div>
                <div class="flex">
                    <div>
                        @if (empty($patient->image))
                            <img src="{{ asset('assets/images/noimage.jpg') }}" class="h-40 w-40 rounded-full"
                                alt="no profile image">
                        @else
                            image dey
                        @endif
                    </div>
                    <div class="self-center ms-8">
                        <h1 class="text-2xl font-semibold text-slate-600">{{ $patient->name }}</h1>
                        <p class="text-lg text-gray-500">Patient number: {{ $patient->no }}</p>
                    </div>
                </div>
            </div>
            <div class="mt-6 lg:mt-0">
                <div class="bg-white p-4 rounded-lg h-full">

                    <div class="self-center flex flex-col gap-1">
                        <p class="text-sm font-medium text-slate-600">Address: {{ $patient->address ?? 'NA' }}</p>
                        <p class="text-sm font-medium text-slate-600">Gender: {{ $patient->gender ?? 'NA' }}</p>
                        <p class="text-sm font-medium text-slate-600">Blood Group: {{ $patient->blood_group ?? 'NA' }}
                        </p>
                        <p class="text-sm font-medium text-slate-600">Genotype: {{ $patient->genotype ?? 'NA' }}</p>
                        <p class="text-sm font-medium text-slate-600">Email: {{ $patient->email ?? 'NA' }}</p>
                        <p class="text-sm font-medium text-slate-600">Phone: {{ $patient->phone ?? 'NA' }}</p>

                    </div>
                </div>
            </div>
        </div>
        {{-- {{ $this->table }} --}}
    </div>


    <div class="mt-8">
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-6 bg-white rounded-lg p-6 self-start">
                <h1 class="text-xl font-semibold tracking-wide">Admit Patient</h1>
                @if (!$patient->is_admitted)
                    <form wire:submit="admit">
                        <div class="mb-4 mt-4">
                            <label for="Phone" class="text-sm text-gray-600">Select Room</label>
                            <select wire:model.lazy="ward_id"
                                class="rounded-lg w-full placeholder:text-sm focus:ring-purple-600 border-neutral-400 focus:outline-none active:ring-purple-600 focus:border-purple-200">
                                @if ($wards->isEmpty())
                                    <option value="" selected disabled>
                                        No Room available
                                    </option>
                                @else
                                    <option value="" disabled selected>
                                        Select room
                                    </option>
                                    @foreach ($wards as $ward)
                                        <option value="{{ $ward->id }}">
                                            {{ $ward->no . ' (' . $ward->type . ') Available space (' . $ward->capacity - $ward->sick_person . ')' }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('ward_id')
                                <p class="text-sm text-red-500"> {{ $message }}</p>
                            @enderror

                        </div>
                        <div class="mb-4">
                            <label for="Amount" class="text-sm text-gray-600">Billing Amount</label>
                            <input type="number" wire:model="amount" placeholder="E.g 10,000" autocomplete="false"
                                class="rounded-lg w-full placeholder:text-sm focus:ring-purple-600 border-neutral-400 focus:outline-none active:ring-purple-600 focus:border-purple-200">
                            @error('amount')
                                <p class="text-sm text-red-500"> {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="Amount Deposited" class="text-sm text-gray-600">Amount Deposited</label>
                            <input type="number" wire:model="amount_deposited" placeholder="E.g 10,000"
                                autocomplete="false"
                                class="rounded-lg w-full placeholder:text-sm focus:ring-purple-600 border-neutral-400 focus:outline-none active:ring-purple-600 focus:border-purple-200">
                            @error('amount_deposited')
                                <p class="text-sm text-red-500"> {{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <button
                                class="flex text-sm self-center px-4 py-2 text-white rounded-md  @if ($wards->isEmpty()) bg-gray-400 @else bg-purple-600 hover:bg-purple-700 @endif"
                                @if ($wards->isEmpty()) disabled @endif>Admit
                                Patient</button>
                        </div>
                    </form>
                @else
                    <div class="bg-red-100 text-red-700 p-4 mt-4 rounded-sm">
                        <h1>Patient is in admission</h1>
                    </div>
                    <div class="mt-4 bg-purple-100 p-4 rounded-sm text-purple-700">
                        <h1 class="text-lg font-semibold underline mb-2">Admission Details</h1>
                        <p>Room number: {{ $sickbay->ward->no }}</p>
                        <p>Admission Date: {{ $sickbay->created_at->format('Y-M-d') }}</p>
                        <p>Bill Amount: {{ number_format($bill->amount) }}</p>
                    </div>
                    <div
                        class="mt-4  @if (empty($payments)) bg-red-100 text-red-700 @else bg-green-100 text-green-700 @endif p-4 rounded-sm ">

                        @if (empty($payments))
                            <p class="font-semibold ">No payment has been made yet</p>
                        @else
                            {{-- @foreach ($payments as $payment) --}}
                            {{-- <p class="font-semibold ">Amount Paid</p> --}}
                            {{-- @php $payments->amount_deposited=0 @endphp
                            @foreach ($payments as $payment)
                               @php $payments->amount_deposited += $payment->amount_deposited @endphp
                            @endforeach --}}
                            <p>Amount Paid: {{ $payments->amount_deposited }}</p>
                            <p>Balance Remaining: {{ number_format($bill->amount - $payments->amount_deposited) }}</p>
                            {{-- @endforeach --}}
                        @endif


                    </div>
                    <div class="mt-4">
                        {{-- @if ($bill->amount > 0) --}}
                        @if ($bill->amount - $payments->amount_deposited > 0)
                            <p class="text-red-600 mb-4">Patient cannot be discarged due to unpaid balance of
                                {{ number_format($bill->amount - $payments->amount_deposited) }}</p>


                            @session('error')
                                <div class="bg-red-100 text-red-500 my-4 p-3 rounded-md">
                                    <p>{{ session('error') }}</p>
                                </div>
                            @endsession

                            <form wire:submit="makePayment">
                                <div class="mb-4">
                                    <label for="Amount Deposited" class="text-sm text-gray-600">Make Payment</label>
                                    <input type="number" wire:model="amount_deposited" placeholder="E.g 10,000"
                                        autocomplete="false"
                                        class="rounded-lg w-full placeholder:text-sm focus:ring-purple-600 border-neutral-400 focus:outline-none active:ring-purple-600 focus:border-purple-200">
                                    @error('amount_deposited')
                                        <p class="text-sm text-red-500"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <button
                                        class="flex text-sm self-center px-4 py-2 text-white rounded-md   bg-purple-600 hover:bg-purple-700 ">Make
                                        Payment</button>
                                </div>
                            </form>
                        @endif
                        <form wire:submit="discharge" wire:confirm="You do you want to discharge patient?">
                            <div>
                                <button
                                    class="flex text-sm self-center px-4 py-2   rounded-md @if ($bill->amount - $payments->amount_deposited > 0) bg-gray-500 text-gray-400 @else bg-red-600 hover:bg-red-700 text-white @endif"
                                    @if ($bill->amount - $payments->amount_deposited > 0) disabled @endif>Discharge
                                    Patient</button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
            <div class="col-span-6 bg-white rounded-lg p-6">
                <h1 class="text-xl font-semibold">Update Record</h1>
                <div>
                    <form wire:submit.prevent="update">
                        <div class="mb-4">
                            <label for="Patient Name" class="text-sm text-gray-600">Patient Name</label>
                            <input type="text" wire:model="name" value="{{ $patient->name }}"
                                placeholder="Patient Name" autocomplete="name"
                                class="rounded-lg w-full placeholder:text-sm focus:ring-purple-600 border-neutral-400 focus:outline-none active:ring-purple-600 focus:border-purple-200">
                            @error('name')
                                <p class="text-sm text-red-500"> {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="Patient number" class="text-sm text-gray-600">Patient number</label>
                            <input type="text" wire:model="no" value="{{ $patient->no }}"
                                class="rounded-lg w-full placeholder:text-sm focus:ring-purple-600 border-neutral-400 focus:outline-none active:ring-purple-600 focus:border-purple-200"
                                readonly>
                            @error('no')
                                <p class="text-sm text-red-500"> {{ $message }}</p>
                            @enderror
                        </div>


                        <div class="mb-4">
                            <label for="Email" class="text-sm text-gray-600">Email</label>
                            <input type="email" wire:model="email" value="{{ $patient->email }}"
                                placeholder="Email"
                                class="rounded-lg w-full placeholder:text-sm focus:ring-purple-600 border-neutral-400 focus:outline-none active:ring-purple-600 focus:border-purple-200">
                            @error('email')
                                <p class="text-sm text-red-500"> {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="Phone" class="text-sm text-gray-600">Phone</label>
                            <input type="text" wire:model="phone" value="{{ $patient->phone }}"
                                placeholder="Phone"
                                class="rounded-lg w-full placeholder:text-sm focus:ring-purple-600 border-neutral-400 focus:outline-none active:ring-purple-600 focus:border-purple-200">
                            @error('phone')
                                <p class="text-sm text-red-500"> {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="gender" class="text-sm text-gray-600">Gender</label>
                            <select wire:model="gender" id="gender" placeholder="Gender"
                                class="rounded-lg w-full placeholder:text-sm focus:ring-purple-600 border-neutral-400 focus:outline-none active:ring-purple-600 focus:border-purple-200">
                                <option value="" {{ empty($patient->gender) ? 'selected' : '' }}>Select gender
                                </option>
                                <option value="Male" {{ $patient->gender == 'Male' ? 'selected' : '' }}>Male
                                </option>
                                <option value="Female" {{ $patient->gender == 'Female' ? 'selected' : '' }}>Female
                                </option>
                            </select>
                            @error('gender')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <div class="flex justify-between">
                                <label for="Phone" class="text-sm text-gray-600">Password</label>
                                <p class="text-xs self-center text-red-400">Leave empty if you are not changing
                                    password</p>
                            </div>
                            <input type="text" wire:model="password" value="{{ $patient->password }}"
                                placeholder="Password"
                                class="rounded-lg w-full placeholder:text-sm focus:ring-purple-600 border-neutral-400 focus:outline-none active:ring-purple-600 focus:border-purple-200">
                            @error('password')
                                <p class="text-sm text-red-500"> {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="address" class="text-sm text-gray-600">Address</label>
                            <textarea wire:model="address" placeholder="Address" rows="2"
                                class="rounded-lg w-full placeholder:text-sm focus:ring-purple-600 border-neutral-400 focus:outline-none active:ring-purple-600 focus:border-purple-200">{{ $patient->address }}</textarea>
                            @error('address')
                                <p class="text-sm text-red-500"> {{ $message }}</p>
                            @enderror
                        </div>


                        <div>
                            <button
                                class="flex text-sm tracking-tighter bg-purple-600 self-center px-4 py-2 text-white rounded-md hover:bg-purple-700">Update
                                Record</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
