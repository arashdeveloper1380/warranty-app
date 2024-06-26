<div>
    <h2>ایجاد محصول جدید</h2><br><br>

    @if(session()->has('success'))
        <div class="alert alert-danger">{{ session()->get('success') }}</div>
    @endif

    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="name">عنوان محصول</label>
            <input type="text" wire:model="name" required class="form-control" placeholder="عنوان محصول را وارد کنید">
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="name">دسته بندی</label>
            <select class="form-control" wire:model="category_id">
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
    </div>

    <div class="form-group">
        <button type="button" style="border-radius: 20px" class="btn btn-primary" wire:click="create">ذخیره محصول</button>
    </div>
</div>
