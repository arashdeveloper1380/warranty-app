<?php

namespace App\Livewire;

use App\Models\Other;
use App\Models\Product;
use Livewire\Component;

class DashboardController extends Component
{
    
    private function getActiveWarranties(){
        return Product::query()->where('status', '!=' ,'de_active')->count();
    }

    private function getNotActiveWarranties(){
        return Product::query()->where('status', 'de_active')->count();
    }
    
    public function getSiteViews(){
        return Other::query()
            ->where('meta_key', 'views')
            ->first()
            ->meta_value;
    }

    public function render(){

        $getActiveWarranties = $this->getActiveWarranties();
        $getNotActiveWarranties = $this->getNotActiveWarranties();
        $getSiteViews = $this->getSiteViews();

        return view('livewire.dashboard', compact('getActiveWarranties', 'getNotActiveWarranties', 'getSiteViews'))
            ->extends('layouts.admin_master')
            ->section('content');
    }
}
