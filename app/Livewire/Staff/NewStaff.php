<?php

namespace App\Livewire\Staff;

use App\Models\Department;
use App\Models\Staff as Worker;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;


class NewStaff extends Component
{

    public $name = "";
    public $emp_id;
    public $type="";
    public $department_id="";
    public $phone = "";
    public $email = "";
    public $address = "";
    public $password="123456";

    public function mount(){
        $this->password= Hash::make($this->password);
        $this->emp_id = 'Wi'.rand(1000,10000);
    }
    
    public function render()
    {
        return view('livewire.staff.new-staff')->with([
            'departments' => Department::where('is_active', 1)->orderBy('name', 'ASC')->get(),
        ]);
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'emp_id' => 'required|unique:staff',
            'type' => 'required',
            'department_id' => 'required',
            'phone' => 'required|unique:staff',
            'email' => 'required|unique:staff',
            'password' => 'required',
            'address' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'emp_id.unique' => 'The generated patient number has been registerd',
            'email.unique' => 'This email has already been registered',
            'phone.unique' => 'This phone number has already been registered',
            'department_id.required' => 'Kindly select a department',
            'type.required' => 'Kindly select a category for staff',
        ];
    }

    public function create()
    {
        $this->validate();
        Worker::create($this->only([
            'name',
            'emp_id',
            'type',
            'department_id',
            'phone',
            'email',
            'address',
            'password',
        ]));
        $this->redirect('staff');
    }
}
