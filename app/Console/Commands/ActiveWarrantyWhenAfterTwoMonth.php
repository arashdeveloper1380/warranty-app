<?php

namespace App\Console\Commands;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ActiveWarrantyWhenAfterTwoMonth extends Command{
    
    protected $signature = 'app:activeWarrantyWhenAfterTwoMonth';

    protected $description = 'Active Warranty When After Two Month';

    public function handle(){
        
        $products = Product::query()
            ->WhereNotNull(['active_after_two_month'])
            ->get();

        foreach ($products as  $product) {
            $twoMonthsAgo = Carbon::now();

            if ($twoMonthsAgo > $product->active_after_two_month) {
                $product->update(['status' => 'active_by_admin']);
                $this->info("[*] Product id {$product->id} is Activated By Admin");
            }
        }
    }
}
