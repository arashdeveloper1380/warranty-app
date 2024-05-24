<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use App\Models\DefaultProduct;
use Livewire\Component;

class CreateDefaultProdutController extends Component{

    public mixed $name      = "";
    public int $category_id = 0;

    private function getCategories(){
        return Category::query()->where('parent_id', 0)->get();
    }

    public function create(){

        DefaultProduct::create([
            'name'          => $this->name,
            'category_id'   => $this->category_id,
        ]);

        return redirect()->route('default-product.index')->with('success', 'محصول با موفقیت ایجاد شد');
    }

    public function render(){
        $getCategories = $this->getCategories();

        return view('livewire.Categories.default-produt-create', compact('getCategories'))
            ->extends('layouts.admin_master')
            ->section('content');
    }
}
