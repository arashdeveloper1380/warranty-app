<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;

class CategoryController extends Component
{

    public function getCategories(){
        return Category::query()->paginate();
    }
    
    public function render(){
        
        $categories = $this->getCategories();

        return view('livewire.Categories.category', compact('categories'))
            ->extends('layouts.admin_master')
            ->section('content');
    }
}
