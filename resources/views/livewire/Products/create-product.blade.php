<div>
    <h2>ایجاد کد جدید</h2><br><br>

    @if(session()->has('success'))
        <div class="alert alert-danger">{{ session()->get('success') }}</div>
    @endif

    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="name">عنوان محصول</label>
            <select wire:model="product_id" class="form-control">
                @foreach ($getProduct as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>  
                @endforeach
            </select>
        </div>
    </div>

    {{-- <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="name">دسته بندی</label>
            <select class="form-control" wire:model="category_id" disabled>
                @foreach ($getCategories as $key => $value)

                    <option value="{{ $value->id }}">{{ $value->name }}</option>

                    @foreach ($value->getChild as $key2 => $value2)
                        <option value="{{ $value2->id }}">--{{ $value2->name }}</option>

                        @foreach ($value2->getChild as $key3 => $value3)
                            <option value="{{ $value3->id }}">----{{ $value3->name }}</option>
                        @endforeach

                    @endforeach

                @endforeach
            </select>
        </div>
    </div> --}}

    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="name">قیمت</label>
            <input type="text" wire:model="price" required required class="form-control" placeholder="قیمت را وارد کنید">
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="float: none">
        <div class="form-group">
            <label for="name">تعداد</label>
            <input type="text" wire:model="count" required class="form-control" placeholder="تعداد را وارد کنید">
        </div>
    </div>

    <div class="form-group" style="clear: both">
        <button type="button" style="border-radius: 20px" class="btn btn-primary" wire:click="create">ذخیره محصول</button>
    </div>
</div>
