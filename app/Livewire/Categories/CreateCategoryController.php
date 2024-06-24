<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;

class CreateCategoryController extends Component
{
    public string $name = '';
    public string $parent_id = '';
    public string $code = '';

    protected $rules = [
        'name'      => 'required',
        // 'code'      => 'regex:/^[a-zA-Z ]+$/',
        'code'      => 'required',
    ];

    protected $messages = [
        'name.required' => 'نام محصول را وارد کنید',
        // 'code.regex'    => 'کد اختصار باید از نوع حروف باشد ',
        'code.regex'    => 'کد اختصار را وارد کنید ',
    ];

    public function getCategories(){
        return Category::query()
            ->where('parent_id', 0)
            ->get();
    }

    public function create(){
        $this->validate();

        $parentId = intval($this->parent_id);

        Category::query()->create([
            'name'      => $this->name,
            'code'      => $this->code,
            'parent_id' => $parentId,
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
