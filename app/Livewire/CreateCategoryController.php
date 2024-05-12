<?php

namespace App\Livewire;

use Livewire\Component;

class CreateCategoryController extends Component
{
    public function render(){
        return view('livewire.Categories.create-category')
            ->extends('layouts.admin_master')
            ->section('content');
    }
}
