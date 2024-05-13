<?php

namespace App\Livewire\Products;

use Livewire\Component;

class CreateProductController extends Component
{
    public function render(){
        return view('livewire.create-product')
            ->extends('layouts.admin_master')
            ->section('content');
    }
}
