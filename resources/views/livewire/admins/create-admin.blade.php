<div>

    <h2>ایجاد ادمین</h2><br><br>

    @if(session()->has('success'))
        <div class="alert alert-danger">{{ session()->get('success') }}</div>
    @endif

    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="name">
                نام و نام خانوادگی
                @error('name') <span style="color: crimson">{{ $message }}</span> @enderror
            </label>
            <input type="text" wire:model="name" required class="form-control" placeholder="نام و نام خانوادگی را وارد کنید">
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="name">
                 ایمیل
                @error('email') <span style="color: crimson">{{ $message }}</span> @enderror
            </label>
            <input type="text" wire:model="email" required class="form-control" placeholder="ایمیل را وارد کنید">
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="name">
                 رمز عبور
                @error('password') <span style="color: crimson">{{ $message }}</span> @enderror
            </label>
            <input type="text" wire:model="password" required class="form-control" placeholder="رمز عبور را وارد کنید">
        </div>
    </div>

    <h4 style="clear: both">تعریف سطح دسترسی</h4><br>

    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="clear: both">
        
        <div class="form-group">

            <label for="melkCategory">مدیریت دسته بندی </label>
            <input type="checkbox" wire:model="permission.category" value="category"><br>
        </div>
        
        <div class="form-group">

            <label for="melkCategory">مدیریت محصولات</label>
            <input type="checkbox"  wire:model="permission.product" value="product"><br>
        </div>

    </div>

    <div class="form-group" style="clear: both">
        <button type="button" class="btn btn-primary" wire:click="create">ذخیره</button>
    </div>

</div>
