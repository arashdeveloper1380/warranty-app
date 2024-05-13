<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;

class CreateCategoryController extends Component
{
    public string $name = '';
    public string $parent_id = '';

    public function getCategories(){
        return Category::query()
            ->where('parent_id', 0)
            ->get();
    }

    public function create(){
        Category::query()->create([
            'name'      => $this->name,
            'parent_id' => $this->parent_id,
        ]);

        return redirect()->route('category.index')->with('success', 'دسته با موفقیت ثبت شد');
    }
    public function render(){
        $getCategories = $this->getCategories();

        return view('livewire.Categories.create-category', compact('getCategories'))
            ->extends('layouts.admin_master')
            ->section('content');
    }
}
