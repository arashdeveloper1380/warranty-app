<?php

namespace App\Livewire;

use Livewire\Component;

class DashboardController extends Component
{
    public function render()
    {
        return view('livewire.dashboard')
            ->extends('layouts.admin_master')
            ->section('content');
    }
}
