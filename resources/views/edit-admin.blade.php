@extends('layouts.admin_master')

@section('content')

<div>

    <h2>ایجاد ادمین</h2><br><br>

    @if(session()->has('success'))
        <div class="alert alert-danger">{{ session()->get('success') }}</div>
    @endif

    <form action="{{ url('dashboard/admin/update', $admin->id) }}" method="POST">
        @csrf
        @method("PUT")
    
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="name">
                نام و نام خانوادگی
                @error('name') <span style="color: crimson">{{ $message }}</span> @enderror
            </label>
            <input type="text" name="name" value="{{ $admin->name }}" required class="form-control" placeholder="نام و نام خانوادگی را وارد کنید">
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="name">
                 ایمیل
                @error('email') <span style="color: crimson">{{ $message }}</span> @enderror
            </label>
            <input type="text" name="email" value="{{ $admin->email }}" required class="form-control" placeholder="ایمیل را وارد کنید">
        </div>
    </div>

    <h4 style="clear: both">تعریف سطح دسترسی</h4><br>

    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="clear: both">
        
        <div class="form-group">

            <label for="melkCategory">مدیریت دسته بندی </label>
            <input type="checkbox" name="permission[]" @if(in_array('category', $admin->permission)) @checked(true) @endif value="category"><br>
        </div>
        
        <div class="form-group">

            <label for="melkCategory">مدیریت محصولات</label>
            <input type="checkbox" name="permission[]" @if(in_array('product', $admin->permission)) @checked(true) @endif value="product"><br>
        </div>

    </div>

    <div class="form-group" style="clear: both">
        <button type="submit" class="btn btn-primary">ویرایش</button>
    </div>

    </form>

</div>

    
@endsection