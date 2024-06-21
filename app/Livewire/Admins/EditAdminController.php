<?php

namespace App\Livewire\Admins;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class EditAdminController extends Component
{
    public $name;
    public $email;
    public $password;

    public int $current_id = 0;

    public array $permission = [];


    public function mount(int $id){
        $this->current_id = $id;
        $this->name         = $this->getAdminById($id)->name;
        $this->email        = $this->getAdminById($id)->email;
        $this->permission   = $this->getAdminById($id)->permission;
    }
    
    public function getAdminById(int $id) :?object{
        return User::query()->find($id);
    }

    public function update(){
        $permmisonArr = [];
        foreach ($this->permission as $key => $value){
            if($value == true){
                $permmisonArr[] = $key;
            }
        }


        if(!empty($this->password)){
            $bcryptPassword = Hash::make($this->password);
            $this->getAdminById($this->current_id)->update([
                'name'          => $this->name,
                'email'         => $this->email,
                'password'      => $bcryptPassword,
            ]);
        }else{
            $this->getAdminById($this->current_id)->update([
                'name'          => $this->name,
                'email'         => $this->email,
            ]);
        }

        if($permmisonArr != $this->getAdminById($this->current_id)->permission){
            $this->getAdminById($this->current_id)->update(['permission', null]);

            $this->getAdminById($this->current_id)->update([
                'name'          => $this->name,
                'email'         => $this->email,
                'permission'    => $permmisonArr,
            ]);
        }else{
            $this->getAdminById($this->current_id)->update([
                'name'          => $this->name,
                'email'         => $this->email,
            ]);
        }


        return redirect()->route('admin.index')->with('success', 'کاربر با موفقیت ویرایش شد');
    }

    public function render(){
        return view('livewire.admins.edit-admin')
            ->extends('layouts.admin_master')
            ->section('content');
    }
}
