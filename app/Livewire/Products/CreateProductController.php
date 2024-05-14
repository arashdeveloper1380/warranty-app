<?php

namespace App\Livewire\Products;

use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;

class CreateProductController extends Component
{

    public mixed $name      = "";
    public int $category_id = 0;
    public int $count       = 0;
    public $price;

    private function getCategories(){
        return Category::query()->where('parent_id', 0)->get();
    }
    
    public function create(){
        $uuid = Str::uuid();
        if (!empty($this->count)) {
            try {
                DB::transaction(function () use ($uuid) {
                    for ($i = 0; $i < $this->count; $i++) {
                        Product::create([
                            'name'          => $this->name,
                            'category_id'   => $this->category_id,
                            'price'         => $this->price,
                            'code_unique'   => $uuid,
                            'status'        => 'de_acive'
                        ]);
                        $uuid = Str::uuid();
                    }
                });
            } catch (Exception $e) {
                throw new Exception($e->getMessage()); 
            }
        }
        
        return redirect()->route('product.index')->with('success', 'محصول با موفقیت ایجاد شد');
    }

    public function render(){
        $getCategories = $this->getCategories();

        return view('livewire.Products.create-product', compact('getCategories'))
            ->extends('layouts.admin_master')
            ->section('content');
    }
}
