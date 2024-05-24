<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;

class EditCategoryController extends Component
{
    public string $name = '';
    public string $parent_id = '';
    public string $code = '';

    public $current_id;

    protected $rules = [
        'name'      => 'required',
        'code'      => 'regex:/^[a-zA-Z ]+$/',
    ];

    protected $messages = [
        'name.required' => 'نام محصول را وارد کنید',
        'code.regex'    => 'کد اختصار باید از نوع حروف باشد ',
    ];

    public function getCategories(){
        return Category::query()
            ->where('parent_id', 0)
            ->get();
    }
    
    private function getCategoryById(int $id){
        return Category::query()->find($id);
    }

    public function mount(int $id){
        $this->current_id = $id;
        $this->name         = $this->getCategoryById($id)->name;
        $this->code         = $this->getCategoryById($id)->code;
        $this->parent_id    = $this->getCategoryById($id)->parent_id;
    }

    public function update(){
        $this->validate();

        $category = $this->getCategoryById($this->current_id);

        $category->update($this->validate());

        return redirect()->route('category.index')->with('success', 'دسته با موفقیت ثبت شد');
    }
    public function render(){
        $getCategories = $this->getCategories();

        return view('livewire.Categories.edit-category', compact('getCategories'))
            ->extends('layouts.admin_master')
            ->section('content');
    }
}
