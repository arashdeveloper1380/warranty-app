<?php

namespace App\Livewire;

use App\Models\Customer;
use App\Models\Other;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class HomeController extends Component
{

    use LivewireAlert;

    public $name;
    public $phone;
    public $state;
    public $city;
    public $shop_name;
    public $code;

    public $check_code;

    protected $rules = [
        'name'      => 'required',
        'phone'     => 'required|numeric',
        'state'     => 'required',
        'city'      => 'required',
        'code'      => 'required',
    ];

    protected $messages = [
        'name.required'    => 'نام محصول را وارد کنید',
        'phone.required'   => 'شماره موبایل را وارد کنید',
        'state.required'   => 'استان را وارد کنید',
        'city.required'    => 'شهر را وارد کنید',
        'code.required'    => 'کد سریالی را وارد کنید',
    ];
    
    public function mount(){

        $currentViews = Other::query()
            ->where('meta_key', 'views')
            ->first()
            ->meta_value;

        Other::query()->where('meta_key', 'views')->update([
            'meta_value' => $currentViews +1
        ]);
        
    }

    public function create(){
        $this->validate();

        $this->serialCode($this->code);
    }

    private function serialCode(mixed $code){
        $product = Product::query()
            ->where('code_unique', $code)
            ->first();

        if($product){

            if ($product->status == "de_active") {
                $product->update(['status' => 'adcive_by_customer']);
    
                Customer::query()->create([
                    'name'      => $this->name,
                    'phone'     => $this->phone,
                    'state'     => $this->state,
                    'city'      => $this->city,
                    'shop_name' => $this->shop_name,
                    'code'      => $product->code_unique,
                    'product_id'=> $product->id,
                ]);
                

                $this->alert('success', 'گارانتی محصول با موفقیت فعال شد', [
                    'position'  => 'center',
                    'timer'     => 3000,
                    'toast'     => false,
                ]);
                
                $this->resetInputs();

            }else{
                $this->alert('warning', 'گارانتی این محصول قبلا فعال شده', [
                    'position'  => 'center',
                    'timer'     => 3000,
                    'toast'     => false,
                ]);
            }
        }else{
            $this->alert('error', 'محصولی با این سریال کد پیدا نشد', [
                'position'  => 'center',
                'timer'     => 3000,
                'toast'     => false,
            ]);
        }
       
    }

    private function getProductCustomer(int $product_id){
        return Customer::query()->where('product_id', $product_id)->first()->name;
    }
    
    public function checkCode(){
        $product = Product::query()
            ->with('customer')
            ->where('code_unique', $this->check_code)
            ->first();

        if($product){
            if ($product->status == "de_active") {
                $this->alert('warning', 'گارانتی این محصول غیر فعال است', [
                    'position'  => 'center',
                    'timer'     => 3000,
                    'toast'     => false,
                ]);
            }
            if($product->status == "active_by_customer"){
                $customer = $this->getProductCustomer($product->id);
                $this->alert('success', "گارانتی این محصول توسط $customer فعال شده", [
                    'position'  => 'center',
                    'timer'     => 4000,
                    'toast'     => false,
                ]);
            }
            if($product->status == "active_by_admin"){
                $this->alert('success', "گارانتی این محصول توسط ادمین فعال شده", [
                    'position'  => 'center',
                    'timer'     => 4000,
                    'toast'     => false,
                ]);
            }
        }else{
            $this->alert('error', 'محصولی با این سریال کد پیدا نشد', [
                'position'  => 'center',
                'timer'     => 4000,
                'toast'     => false,
            ]);
        }
    }

    public function resetInputs(){
        $this->name = "";
        $this->phone = "";
        $this->state = "";
        $this->city = "";
        $this->shop_name = "";
        $this->code = "";
    }
    public function render(){
        return view('livewire.home')
            ->extends('layouts.home_matser')
            ->section('content');
    }
}
