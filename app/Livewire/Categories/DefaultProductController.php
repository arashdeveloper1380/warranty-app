<?php

namespace App\Livewire\Categories;

use App\Models\DefaultProduct;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class DefaultProductController extends Component{

    use LivewireAlert;
    use WithPagination;

    public array $select_id = [];
    public $search;
 
    protected $queryString = ['search'];

    protected $paginationTheme = 'bootstrap';

    private function getProducts(){
        return DefaultProduct::query()
            ->where('name', 'like', '%'.$this->search.'%')
            ->paginate(20);
    }

    public function deleteProduct(int $id) : void{
        $product = DefaultProduct::query()->find($id);

        $product->delete();

        $this->alert('success', ' محصول با موفقیت حذف شد', [
            'position'  => 'center',
            'timer'     => 3000,
            'toast'     => false,
        ]);
    }

    public function render(){
        $getProducts = $this->getProducts();

        return view('livewire.Categories.default-product', compact('getProducts'))
            ->extends('layouts.admin_master')
            ->section('content');
    }
}
