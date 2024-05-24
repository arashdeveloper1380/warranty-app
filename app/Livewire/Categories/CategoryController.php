<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryController extends Component
{
    use LivewireAlert, WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;
 
    protected $queryString = ['search'];

    public function getCategories(){
        return Category::query()
            ->where('parent_id', 0)
            ->where('name', 'like', '%'.$this->search.'%')
            ->paginate(10);
    }
    
    public function delete(int $id){
        Category::query()->find($id)->delete();

        $this->alert('success', 'دسته بندی با موفقیت حذف شد', [
            'position'  => 'center',
            'timer'     => 3000,
            'toast'     => false,
        ]);
    }
    public function render(){
        $categories = $this->getCategories();

        return view('livewire.Categories.category', compact('categories'))
            ->extends('layouts.admin_master')
            ->section('content');
    }
}
