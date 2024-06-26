@section('header')
    <style>
        .custom-parent{
            display: block;
            height: 40px;
            width: 200px;
            line-height: 10px;
            margin: 0 auto;
            border-radius: 20px; 
        }
        .btn{
            border-radius: 20px; 
        }
        .d-flex.justify-content-between.flex-fill.d-sm-none{
            display: none
        }
    </style>
@endsection

<div>
    <h2>مدیریت محصولات</h2>

    @if(session()->has('success'))
        <div class="alert alert-success">{{ session()->get('success') }}</div>
    @endif

    <a href="{{ route('product.create') }}" class="btn btn-primary pull-left">+ کد جدید</a>
    <button class="btn btn-success pull-left" wire:click="result" style="margin-left: 10px">خروجی</button>
    <button class="btn btn-success pull-left" wire:click="resultAll" style="margin-left: 10px">خروجی همه</button>
    <button class="btn btn-primary pull-left" wire:click="multiActive" style="margin-left: 10px">فعال کردن گروهی</button>
    <button class="btn btn-primary pull-left" wire:click="multiActiveWhenTwoMonth" style="margin-left: 10px">فعال کردن گروهی بعد از دو ماه</button>
    <br>
    <br>
    <br>
   

    <div class="col-lg-3">
        <input style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;border: 0;border-radius: 5px; width: 300px;" type="text" wire:model.live="search" class="form-control" placeholder="جست وجو کنید ...!">
    </div>

    <div class="col-lg-1" style="margin-right: 50px; line-height: 40px;">
        <span>فیلتر: </span>
    </div>
    
    <div class="col-lg-1" style="margin-right: 20px;">
        
        <button class="btn btn-success pull-left" wire:click.live="searchStatusBtn('active_by_customer')" style="margin-left: 10px">فعال شده کاربر</button>
    </div>

    <div class="col-lg-1" style="margin-right: 50px;">
        <button class="btn btn-warning pull-left" wire:click.live="searchStatusBtn('active_by_admin')" style="margin-left: 10px">فعال شده ادمین</button>
    </div>

    <div class="col-lg-1" style="margin-right: 50px;">
        <button class="btn btn-warning pull-left" wire:click.live="searchStatusBtn('de_active')" style="margin-left: 10px">غیر فعال شده ها</button>
    </div>

    <br><br>
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th style="text-align: center">
                    <input type="checkbox" id="selectAll" wire:model="selectAll" wire:click="selectAllProducts">
                </th>
                <th style="text-align: center">#</th>
                <th style="text-align: center">نام محصول</th>
                <th style="text-align: center">دسته بندی</th>
                <th style="text-align: center;width: 45%;">قیمت</th>
                <th style="text-align: center; width: 28%">کد سریال</th>
                <th style="text-align: center; width: 28%">تاریخ ثبت محصول</th>
                <th style="text-align: center; width: 28%">تاریخ ثبت گارانتی</th>
                <th style="text-align: center; width: 10%">وضعیت</th>
            </tr>
        </thead>
        <tbody style="text-align: center">
            @foreach ($getProducts as $key => $value)
                <tr>
                    <th style="text-align: center; vertical-align: middle">
                        <input type="checkbox" wire:model="select_id.{{ $value->id }}">
                    </th>
                    <th style="text-align: center; vertical-align: middle">{{ $key + 1 }}</th>
                    <td style="text-align: center; vertical-align: middle; width: 30%">{{ $value->name }}</td>
                    <td style="text-align: center; vertical-align: middle">{{ $value->category->name }}</td>
                    <td style="text-align: center; vertical-align: middle">{{ $value->price }}</td>
                    <td style="text-align: center; vertical-align: middle">
                        <div style="display: flex;justify-content: center;">
                            {!! DNS1D::getBarcodeHTML($value->code_unique, "C128",1.4,22) !!}
                        </div>
                        <p>{{ $value->code_unique }}</p>
                    </td>
                    <td style="text-align: center; vertical-align: middle">{{ verta()->instance($value->created_at)->format('Y/m/d h:i:s') }}</td>
                    <td style="text-align: center; vertical-align: middle">
                        @if ($value->created_at != $value->updated_at)
                            {{ verta()->instance($value->updated_at)->format('Y/m/d h:i:s') }}
                        @else
                            هنوز ثبت نشده
                        @endif
                        
                    </td>
                    <td>
                        {{-- <button type="button" style="margin-bottom: 5px" @if($value->status = "de_active") @disabled(true) @endif class="btn btn-warning" wire:click="deActive('{{ $value->id }}')">غیر فعال</button> --}}
                        <button 
                            type="button" 
                            style="margin-bottom: 5px" 
                            @if($value->active_after_two_month != null) disabled @endif
                            class="btn @if($value->status == "de_active") btn-success @else btn-danger @endif" 
                            wire:click="activeByAdmin('{{ $value->id }}')">
                            @if($value->status == "de_active")
                                فعال کردن گارانتی
                            @else
                                فعال شده
                            @endif
                        </button>

                        <button 
                            type="button" 
                            style="margin-bottom: 5px" 
                            @if($value->status != "de_active") disabled @endif
                            class="btn @if($value->active_after_two_month != null) btn-danger @else btn-primary @endif" 
                            wire:click="activeAfterTwoMonth('{{ $value->id }}')">
                            @if($value->active_after_two_month != null)
                                بعد از دو ماه فعال میشود
                            @else
                                فعال کردن گارانتی بعد از دو ماه 
                            @endif
                            
                        </button>

                        <button 
                            type="button" 
                            style="margin-bottom: 5px" 
                            class="btn btn-warning" 
                            wire:click="deleteProduct('{{ $value->id }}')">
                            حذف
                        </button>
                        {{-- <button type="button" @if($value->status == "active_by_customer") disable @endif class="btn btn-primary" value="activeByCustomer('{{ $value->id }}')">فعال کردن توسط مشتری</button> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    {{ $getProducts->links() }}

</div>

@section('footer')

@endsection