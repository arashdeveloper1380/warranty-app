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
    <a href="{{ route('product.create') }}" class="btn btn-primary pull-left">+ محصول جدید</a><br>
    <br>
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th style="text-align: center">#</th>
                <th style="text-align: center">نام محصول</th>
                <th style="text-align: center">دسته بندی</th>
                <th style="text-align: center">قیمت</th>
                <th style="text-align: center; width: 28%">کد سریال</th>
                <th style="text-align: center; width: 10%">وضعیت</th>
            </tr>
        </thead>
        <tbody style="text-align: center">
            @foreach ($getProducts as $key => $value)
                <tr>
                    <th style="text-align: center">{{ $key + 1 }}</th>
                    <td style="text-align: center; width: 30%">{{ $value->name }}</td>
                    <td style="text-align: center">{{ $value->category->name }}</td>
                    <td style="text-align: center">{{ $value->price }}</td>
                    <td style="text-align: center">{{ $value->code_unique }}</td>
                    <td>
                        <button type="button" style="margin-bottom: 5px" @if($value->status != "de_active") @disabled(true) @endif class="btn btn-warning" wire:click="deActive('{{ $value->id }}')">غیر فعال</button>
                        <button type="button" style="margin-bottom: 5px" @if($value->status == "active_by_admin") disable @endif class="btn btn-success" value="active_by_admin">فعال کردن توسط ادمین</button>
                        <button type="button" @if($value->status == "active_by_customer") disable @endif class="btn btn-primary" value="active_by_customer">فعال کردن توسط مشتری</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    {{ $getProducts->links() }}

</div>
