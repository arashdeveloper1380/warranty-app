<?php

namespace App\Livewire\Admins;

use App\Models\User;
use Livewire\Component;

class AdminController extends Component
{

    public function getAdmins(){
        return User::query()->get();
    }

    public function render(){
        $admins = $this->getAdmins();

        return view('livewire.admins.admin', compact('admins'))
            ->extends('layouts.admin_master')
            ->section('content');
    }
}
