<div>

    <h2>ایجاد دسته بندی</h2><br><br>

    @if(session()->has('success'))
        <div class="alert alert-danger">{{ session()->get('success') }}</div>
    @endif

    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="name">
                عنوان دسته بندی
                @error('name') <span style="color: crimson">{{ $message }}</span> @enderror
            </label>
            <input type="text" wire:model="name" required class="form-control" placeholder="عنوان دسته بندی را وارد کنید">
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            
            <label for="name">
                کد اختصار
                @error('code') <span style="color: crimson">{{ $message }}</span> <br> @enderror
            </label>
            <input type="text" wire:model="code" class="form-control" placeholder="کد اختصار را وارد کنید">
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="name">دسته مادر</label>
            <select class="form-control" wire:model="parent_id">
                <option value="0" style="color: red">دسته مادر</option>
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

    <div class="form-group" style="clear: both">
        <button type="button" class="btn btn-primary" wire:click="update">ویرایش دسته بندی</button>
    </div>

</div>
