<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ProductController extends Component{
    
    use LivewireAlert;
    private function getProducts(){
        return Product::query()->paginate(10);
    }

    public function deActive($id){
        $this->alert('success', 'Basic Alert');
    }

    public function render(){

        $getProducts = $this->getProducts();

        return view('livewire.Products.product', compact('getProducts'))
            ->extends('layouts.admin_master')
            ->section('content');
    }
}
