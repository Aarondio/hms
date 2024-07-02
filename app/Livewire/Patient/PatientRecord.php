<?php

namespace App\Livewire\Patient;

use App\Models\Bill;
use App\Models\Payment as PaymentModel;
use App\Models\Payment;
use App\Models\SickBay;
use App\Models\User;
use App\Models\Ward;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Url;
use Livewire\Component;

class PatientRecord extends Component implements HasForms
{
    use InteractsWithForms;

    #[Url]
    public $user_id;

    public $amount;
    public $amount_deposited;
    public $ward_id = "";
    public $balance;
    public $bill_id;

    public $no;
    public $name;
    public $phone;
    public $email;
    public $address;
    public $gender = "";
    public $password;

    public SickBay $sickbay;
    public Bill $bill;
    public $payments;

    public function mount()
    {
        $patient = User::findOrFail($this->user_id);
        $this->name = $patient->name;
        $this->phone = $patient->phone;
        $this->email = $patient->email;
        $this->address = $patient->address;
        $this->no = $patient->no;
        $this->gender = $patient->gender;
        //    $this->password = $patient->password;
        $this->balance = ($this->amount) - ($this->amount_deposited);

        $exists = SickBay::where('user_id', $this->user_id)
            ->whereNull('discharge_date')
            ->exists();


        if ($exists) {
            $this->sickbay = SickBay::where('user_id', $this->user_id)->whereNull('discharge_date')->first();
            $this->bill = Bill::where('user_id', $this->user_id)->where('sick_bay_id', $this->sickbay->id)->first();
            $check_payment = PaymentModel::where('bill_id', $this->bill->id)->exists();

            if ($check_payment) {
                $this->payments = PaymentModel::where('bill_id', $this->bill->id)->first();
            }
        }
    }


    public function render()
    {
        return view('livewire.patient.patient-record')->with([
            'patient' => User::findOrFail($this->user_id),
            'wards' => Ward::where('status', 'Available')->where('is_available', 1)->get(),
            'sickbay' => $this->sickbay ?? [],
            'bill' => $this->bill ?? [],
            'payments' => $this->payments ?? [],

        ]);
    }

    public function form(Form $form): Form
    {

        return $form->schema([
            TextInput::make('room_id'),
        ]);
    }



    public function admit()
    {

        DB::beginTransaction();
        $sickbay = SickBay::create($this->only([
            'user_id',
            'ward_id',
        ]));

        $ward = Ward::find($this->ward_id);

        if ($ward) {
            $ward->sick_person += 1;
            if ($ward->capacity > $ward->sick_person) {
                $ward->status = "Available";
                $ward->save();
            } else {
                $ward->status = "Unavailable";
                $ward->save();
            }
        }
        $patient = User::find($this->user_id);
        if ($patient) {
            $patient->is_admitted = true;
            $patient->save();
        }

        $bill = Bill::create($this->only([
            'user_id',
            'amount',
        ]));

        $this->bill_id = $bill->id;
        $payment = Payment::create($this->only([
            'bill_id',
            'amount_deposited',
        ]));


        if ($sickbay && $bill && $payment) {
            $bill->sick_bay_id =  $sickbay->id;
            $bill->save();
            DB::commit();
            return redirect()->route('patients');
        } else {
            DB::rollback();
        }
    }


    public function discharge()
    {
        // dd($this->sickbay);
        DB::beginTransaction($this->ward_id);

       
        $discharge_date = now();
        $this->sickbay->discharge_date = $discharge_date;
        $this->sickbay->save();

        $patient = User::find($this->user_id);
        $patient->is_admitted = false;
        $patient->save();

        
        $ward = Ward::find($this->sickbay->ward_id);
        if ($ward && $patient) {
            $ward->sick_person -= 1;
            if ($ward->capacity > $ward->sick_person) {
                $ward->status = "Available";
                $ward->save();
            } else {
                $ward->status = "Unavailable";
                $ward->save();
            }
            DB::commit();
        }else{
            DB::rollback();
        }
        

        
    }

    public function makePayment()
    {

        // dd($this->payments,$this->bill);
        if($this->payments->amount_deposited + $this->amount_deposited > $this->bill->amount){
            session()->flash('error',"Amount to be paid is exceed by ". $this->payments->amount_deposited + $this->amount_deposited -  $this->bill->amount);
        }else{
        $this->payments->amount_deposited += $this->amount_deposited;
        $this->payments->save();
        $this->amount_deposited = "";
        Notification::make()
            ->title("Payment made successfully")
            ->success()
            ->send();
        }
    }

    public function rules()
    {
        return [
            'no' => 'required|unique:users',
            'name' => 'required',
            'phone' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required',
            'address' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'no.unique' => 'The generated patient number has been registerd',
            'email.unique' => 'This email has already been registered',
            'phone.unique' => 'This phone number has already been registered'
        ];
    }

    public function update()
    {
        $patient = User::find($this->user_id);
        if ($patient) {

            if (!empty($this->password)) {
                $this->password = Hash::make($this->password);
                $patient->update($this->only([
                    'no',
                    'name',
                    'phone',
                    'email',
                    'password',
                    'address',
                ]));
            } else {
                $patient->update($this->only([
                    'no',
                    'name',
                    'phone',
                    'email',
                    'address',
                ]));
            }

            Notification::make()
                ->title('Patient updated successfully')
                ->success()
                ->send();
            $this->redirect('/patients', navigate: true);
        }
    }
}
