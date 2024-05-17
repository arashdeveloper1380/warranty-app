<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ProductController extends Component{
    
    use LivewireAlert;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    private function getProducts(){
        return Product::query()->paginate(20);
    }

    public function activeByAdmin(int $id)  : void{
        $product = Product::query()->find($id);
        
        if($product->status != "de_active"){
            $updated_at = verta()->instance($product->updated_at)->format('Y/m/d');
            $this->alert('success', "گارانتی محصول در تاریخ $updated_at موفقیت فعال شد", [
                'position'  => 'center',
                'timer'     => 3000,
                'toast'     => false,
            ]);
        }else{
            $product->update(['status' => 'adcive_by_admin']);

            $this->alert('success', 'گارانتی محصول با موفقیت فعال شد', [
                'position'  => 'center',
                'timer'     => 3000,
                'toast'     => false,
            ]);
        }
        
    }

    public function render(){

        $getProducts = $this->getProducts();

        return view('livewire.Products.product', compact('getProducts'))
            ->extends('layouts.admin_master')
            ->section('content');
    }
}