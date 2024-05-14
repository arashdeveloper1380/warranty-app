<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Component;

class ProductController extends Component{
    
    private function getProducts(){
        return Product::query()->paginate(10);
    }

    public function render(){

        $getProducts = $this->getProducts();

        return view('livewire.Products.product', compact('getProducts'))
            ->extends('layouts.admin_master')
            ->section('content');
    }
}
