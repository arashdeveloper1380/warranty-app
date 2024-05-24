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

    <a href="{{ route('default-product.create') }}" class="btn btn-primary pull-left">+ محصول جدید</a>
    <br>

    <input style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;border: 0;border-radius: 5px; width: 300px;" type="text" wire:model.live="search" class="form-control" placeholder="جست وجو کنید ...!">
    <br>
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th style="text-align: center">#</th>
                <th style="text-align: center">نام محصول</th>
                <th style="text-align: center">دسته بندی</th>
                <th style="text-align: center">تاریخ ثبت</th>
                <th style="text-align: center">مدیریت</th>
            </tr>
        </thead>
        <tbody style="text-align: center">
            @foreach ($getProducts as $key => $value)
                <tr>
                    <th style="text-align: center; vertical-align: middle">{{ $key + 1 }}</th>
                    <td style="text-align: center; vertical-align: middle; width: 30%">{{ $value->name }}</td>
                    <td style="text-align: center; vertical-align: middle">{{ $value->category->name }}</td>
                    <td style="text-align: center; vertical-align: middle">{{ verta()->instance($value->updated_at)->format('Y/m/d') }}</td>
                    <td style="text-align: center; vertical-align: middle">
                        <button class="btn btn-danger" wire:click="deleteProduct('{{ $value->id }}')">حذف</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    {{ $getProducts->links() }}

</div>
