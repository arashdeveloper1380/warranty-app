<?php

namespace App\Livewire\Admins;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateAdminController extends Component
{
    public $name;
    public $email;
    public $password;

    public array $permission = [];

    public function create(){
        $permmisonArr = [];
        foreach ($this->permission as $key => $value){
            if($value == true){
                $permmisonArr[] = $key;
            }
        }

        $bcryptPassword = Hash::make($this->password);

        User::query()->create([
            'name'  => $this->name,
            'email' => $this->name,
            'password' => $bcryptPassword,
            'permission' => $permmisonArr,
        ]);

        return redirect()->route('admin.index')->with('success', 'کاربر با موفقیت ایجاد شد');
    }

    public function render(){
        return view('livewire.admins.create-admin')
            ->extends('layouts.admin_master')
            ->section('content');
    }
}
