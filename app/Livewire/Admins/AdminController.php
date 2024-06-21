<?php

namespace App\Livewire\Admins;

use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class AdminController extends Component
{
    use LivewireAlert;

    public function getAdmins(){
        return User::query()->get();
    }

    public function delete(int $id){
        User::query()->find($id)->delete();

        $this->alert('success', 'ادمین با موفقیت حذف شد', [
            'position'  => 'center',
            'timer'     => 3000,
            'toast'     => false,
        ]);
    }

    public function render(){
        $admins = $this->getAdmins();

        return view('livewire.admins.admin', compact('admins'))
            ->extends('layouts.admin_master')
            ->section('content');
    }
}
