<div class="container mx-auto ">
    <div class="flex justify-center">
        <div class=" w-1/2 bg-white rounded-lg px-6 py-6 mt-1 self-start">
            <div class="mb-3 flex justify-between">
                <h1 class="text-lg capitalize">Create new staff</h1>
                <p class="text-purple-600 text-sm">Default password is 123456</p>
            </div>
            <form wire:submit.prevent="create">
                <div class="mb-4">
                    <label for="Staff Name" class="text-sm text-gray-600">Staff Name</label>
                    <input type="text" wire:model="name" placeholder="Staff Name" autocomplete="name"
                        class="rounded-lg w-full placeholder:text-sm focus:ring-purple-600 border-neutral-400 focus:outline-none active:ring-purple-600 focus:border-purple-200">
                    @error('name')
                        <p class="text-sm text-red-500"> {{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="Employee number" class="text-sm text-gray-600">Employee number</label>
                    <input type="text" wire:model="emp_id" 
                        class="rounded-lg w-full placeholder:text-sm focus:ring-purple-600 border-neutral-400 focus:outline-none active:ring-purple-600 focus:border-purple-200">
                    @error('emp_id')
                        <p class="text-sm text-red-500"> {{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="Staff type" class="text-sm text-gray-600">Staff type</label>
                    <select wire:model="type"
                        class="rounded-lg w-full placeholder:text-sm focus:ring-purple-600 border-neutral-400 focus:outline-none active:ring-purple-600 focus:border-purple-200">
                        <option value="" selected disabled>Select staff type</option>
                        <option value="Doctor">Doctor</option>
                        <option value="Nurse">Nurse</option>
                        <option value="Pharmacy">Pharmacy</option>
                        <option value="Technician">Lab Technician</option>
                        <option value="Receptionist">Receptionist</option>
                    </select>
                    @error('type')
                        <p class="text-sm text-red-500"> {{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="Staff Department" class="text-sm text-gray-600">Staff Department</label>
                    <select wire:model="department_id"
                        class="rounded-lg w-full placeholder:text-sm focus:ring-purple-600 border-neutral-400 focus:outline-none active:ring-purple-600 focus:border-purple-200">
                        <option value="" selected disabled>Select department</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name. ' '.  $department->id }}</option>
                        @endforeach
                    </select>
                    @error('department_id')
                        <p class="text-sm text-red-500"> {{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="Email" class="text-sm text-gray-600">Email</label>
                    <input type="email" wire:model="email" placeholder="Email"
                        class="rounded-lg w-full placeholder:text-sm focus:ring-purple-600 border-neutral-400 focus:outline-none active:ring-purple-600 focus:border-purple-200">
                    @error('email')
                        <p class="text-sm text-red-500"> {{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="Phone" class="text-sm text-gray-600">Phone</label>
                    <input type="text" wire:model="phone" placeholder="Phone"
                        class="rounded-lg w-full placeholder:text-sm focus:ring-purple-600 border-neutral-400 focus:outline-none active:ring-purple-600 focus:border-purple-200">
                    @error('phone')
                        <p class="text-sm text-red-500"> {{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="address" class="text-sm text-gray-600">Address</label>
                    <textarea wire:model="address" placeholder="Address" rows="2"
                        class="rounded-lg w-full placeholder:text-sm focus:ring-purple-600 border-neutral-400 focus:outline-none active:ring-purple-600 focus:border-purple-200"></textarea>
                    @error('address')
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
