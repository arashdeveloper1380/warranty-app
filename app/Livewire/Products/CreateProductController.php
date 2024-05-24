<?php

namespace App\Livewire\Products;

use App\Models\Category;
use App\Models\DefaultProduct;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;

class CreateProductController extends Component
{

    public mixed $product_id = '';
    public int $category_id = 0;
    public int $count       = 0;
    public $price;

    private function getCategories(){
        return Category::query()->where('parent_id', 0)->get();
    }
    
    private function getProduct(){
        return DefaultProduct::query()->get();
    }

    private function getProductById(){
        return DefaultProduct::query()
            ->where('id', $this->product_id)
            ->with('category')
            ->first();
    }

    private function firtProduct(){
        return DefaultProduct::query()->first()->id;
    }

    public function mount(){
        $this->product_id = $this->firtProduct();
    }
    
    public function create(){
        
        $barcode = random_int(1000000000,9999999999);
        if (!empty($this->count)) {
            try {
                DB::transaction(function () use ($barcode) {
                    for ($i = 0; $i < $this->count; $i++) {
                        Product::create([
                            'name'          => $this->getProductById()->name,
                            'category_id'   => $this->getProductById()->category->id,
                            'price'         => $this->price,
                            'code_unique'   => $this->getCategoryCode($this->getProductById()->category->id) . $barcode,
                            'status'        => 'de_active'
                        ]);
                        $barcode = random_int(1000000000,9999999999);
                    }
                });
            } catch (Exception $e) {
                throw new Exception($e->getMessage()); 
            }
        }
        
        return redirect()->route('product.index')->with('success', 'محصول با موفقیت ایجاد شد');
    }

    private function getCategoryCode(int $category_id) :string{
        return Category::query()->find($category_id)->code;
    }
    public function render(){
        $getCategories = $this->getCategories();
        $getProduct = $this->getProduct();

        return view('livewire.Products.create-product', compact('getCategories', 'getProduct'))
            ->extends('layouts.admin_master')
            ->section('content');
    }
}
