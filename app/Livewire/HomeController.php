<?php

namespace App\Livewire;

use Livewire\Component;

class HomeController extends Component
{
    public function render(){
        return view('livewire.home')
            ->extends('layouts.home_matser')
            ->section('content');
    }
}
