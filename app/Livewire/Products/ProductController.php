<?php

namespace App\Livewire\Products;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Milon\Barcode\DNS1D;
use Illuminate\Support\Facades\File;

class ProductController extends Component{
    
    use LivewireAlert;
    use WithPagination;

    public array $select_id     = [];
    public array $select_all_id = [];
    public $selectAll = [];

    public $search;
    public $search_status;
 
    protected $queryString = ['search'];
    protected $paginationTheme = 'bootstrap';

    private function getProducts() :?object{
        if($this->search_status){
            return Product::query()
                ->where('status', $this->search_status)
                ->paginate(50);
        }else{
            return Product::query()
                ->where('code_unique', 'like', '%'.$this->search.'%')
                ->paginate(50);
        }
        
    }
    
    public function selectAllProducts(){
        $products = $this->getProducts();
        if ($this->selectAll) {
            $this->select_id = $products->pluck('id')->mapWithKeys(function ($id) {
                return [$id => true];
            })->toArray();
        } else {
            $this->select_id = [];
        }
    }

    public function searchStatusBtn(string $status) {
        $this->search_status = $status;
    }

    private function getProductCategory(int $category_id) :?object{
        return Category::query()->find($category_id)->first();
    }

    private function getProductStatus(
        int $id
    ) :string|null{

        $product = Product::query()->find($id);
        $status = '';

        if($product->status == "de_active"){
            $status = 'گارانتی غیر فعال'; 
        }

        if($product->status == "active_by_admin"){
            $status = 'گارانتی فعال توسط ادمین';
        }

        if($product->status == "active_by_customer"){
            $status = 'گارانتی فعال توسط مشتری';
        }

        return $status;
    }
    public function result(){
        if(empty($this->select_id)){
            $this->alert('warning', 'لطفا چند محصول را انتخاب کنید', [
                'position'  => 'center',
                'timer'     => 3000,
                'toast'     => false,
            ]);
            return;
        }else{
            $checkedArry = [];
            foreach ($this->select_id as $key => $value){
                if($value == "true"){
                    $checkedArry[] = $key;
                }
                else{
                    $this->alert('warning', 'لطفا چند محصول را انتخاب کنید', [
                        'position'  => 'center',
                        'timer'     => 3000,
                        'toast'     => false,
                    ]);
                    return;
                }
            }
    
            $products = Product::query()
                ->whereIn('id', $checkedArry)
                ->get();
    
            $datas = [];
    
            foreach ($products as $product) {
                // $csvGenerator = new DNS1D();
                // $csvGenerator->getBarcodeHTML($product->code_unique, "C128",1.4,22)
                // $product->status == "de_active" ?: 'غیر فعال', $product->status == "active_by_admin" ?: 'فعال شده توسط ادمین', $product->status == "active_by_customer" ?: 'فعال شده توسط مشتری'
                $datas[] = [
                    'name'          => $product->name,
                    'category'      => $this->getProductCategory($product->category_id)->name,
                    'price'         => $product->price,
                    'code_unique'   => $product->code_unique,
                    'status'        => $this->getProductStatus($product->id)
                ];
    
            }
            
            $bom = "\xEF\xBB\xBF";
    
            $csvContent = $bom;
            
            $csvContent .= implode(',', ['نام', 'دسته بندی ','قیمت', 'بار کد', 'وضعیت گارانتی']) . "\r\n";
    
            foreach ($datas as $row){
                $csvContent .= implode(',', $row) . "\r\n";
            }
            $fileName = "data_" . time() . ".csv";
    
            $filePath = public_path('csv/' . $fileName);
            
            if (!File::isDirectory(public_path('csv'))) {
                File::makeDirectory(public_path('csv'), 0755, true);
            }
    
            File::put($filePath, $csvContent);
            
            return response()->download($filePath, $fileName, [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            ])->deleteFileAfterSend();
        }
      
    }


    public function resultAll(){
        $products = Product::query()->get();

        $datas = [];

        foreach ($products as $product) {
            // $csvGenerator = new DNS1D();
            // $csvGenerator->getBarcodeHTML($product->code_unique, "C128",1.4,22)
            // $product->status == "de_active" ?: 'غیر فعال', $product->status == "active_by_admin" ?: 'فعال شده توسط ادمین', $product->status == "active_by_customer" ?: 'فعال شده توسط مشتری'
            $datas[] = [
                'name'          => $product->name,
                'category'      => $this->getProductCategory($product->category_id)->name,
                'price'         => $product->price,
                'code_unique'   => $product->code_unique,
                'status'        => $this->getProductStatus($product->id)
            ];

        }
        
        $bom = "\xEF\xBB\xBF";

        $csvContent = $bom;
        
        $csvContent .= implode(',', ['نام', 'دسته بندی ','قیمت', 'بار کد', 'وضعیت گارانتی']) . "\r\n";

        foreach ($datas as $row){
            $csvContent .= implode(',', $row) . "\r\n";
        }
        $fileName = "data_" . time() . ".csv";

        $filePath = public_path('csv/' . $fileName);
        
        if (!File::isDirectory(public_path('csv'))) {
            File::makeDirectory(public_path('csv'), 0755, true);
        }

        File::put($filePath, $csvContent);
        
        return response()->download($filePath, $fileName, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ])->deleteFileAfterSend();
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
            $product->update(['status' => 'active_by_admin']);

            $this->alert('success', 'گارانتی محصول با موفقیت فعال شد', [
                'position'  => 'center',
                'timer'     => 3000,
                'toast'     => false,
            ]);
        }
        
    }

    public function activeAfterTwoMonth(int $id){
        $product = Product::query()->find($id);
        if($product->active_after_two_month == 1){
            $this->alert('success', 'گارانتی محصول بعد از دو ماه فعال میشود', [
                'position'  => 'center',
                'timer'     => 3000,
                'toast'     => false,
            ]);
        }else{
            $product->update([
                'active_after_two_month' => Carbon::parse($product->updated_at)->addMonths(2),
            ]);
            $this->alert('success', 'گارانتی محصول بعد از دو ماه فعال میشود', [
                'position'  => 'center',
                'timer'     => 3000,
                'toast'     => false,
            ]);
        }
    }

    public function multiActive(){
        if(empty($this->select_id)){
            $this->alert('warning', 'لطفا چند محصول را انتخاب کنید', [
                'position'  => 'center',
                'timer'     => 3000,
                'toast'     => false,
            ]);
            return;
        }

        $checkedArry = [];
        foreach ($this->select_id as $key => $value){
            if($value == "true"){
                $checkedArry[] = $key;
            }
        }

        $products = Product::query()
            ->whereIn('id', $checkedArry)
            ->get();

        foreach ($products as $product){
            $product->update(['status' => 'active_by_admin']);
        }

        $this->alert('success', 'گارانتی محصولات با موفقیت فعال شد', [
            'position'  => 'center',
            'timer'     => 3000,
            'toast'     => false,
        ]);

        $this->select_id = [];

    }
    
    public function multiActiveWhenTwoMonth(){
        if(empty($this->select_id)){
            $this->alert('warning', 'لطفا چند محصول را انتخاب کنید', [
                'position'  => 'center',
                'timer'     => 3000,
                'toast'     => false,
            ]);
            return;
        }

        $checkedArry = [];
        foreach ($this->select_id as $key => $value){
            if($value == "true"){
                $checkedArry[] = $key;
            }
        }

        $products = Product::query()
            ->whereIn('id', $checkedArry)
            ->get();

        foreach ($products as $product){
            $product->update([
                'active_after_two_month' => 
                Carbon::parse($product->updated_at)->addMonths(2)
            ]);
        }

        $this->alert('success', 'گارانتی محصولات بعد از 2 ماه فعال می شود', [
            'position'  => 'center',
            'timer'     => 3000,
            'toast'     => false,
        ]);

        $this->select_id = [];
    }
    
    public function deleteProduct(int $id) : void{
        $product = Product::query()->find($id);

        $product->delete();

        $this->alert('success', ' محصول با موفقیت حذف شد', [
            'position'  => 'center',
            'timer'     => 3000,
            'toast'     => false,
        ]);
    }

    public function render(){

        $getProducts = $this->getProducts();

        return view('livewire.Products.product', compact('getProducts'))
            ->extends('layouts.admin_master')
            ->section('content');
    }
}
