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
        .btn-primary{
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
    <a href="{{ route('category.create') }}" class="btn btn-primary pull-left">+ محصول جدید</a><br>
    <br>
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th style="text-align: center">#</th>
                <th style="text-align: center">نام محصول</th>
                <th style="text-align: center">دسته بندی</th>
                <th style="text-align: center">قیمت</th>
                <th style="text-align: center">وضعیت</th>
            </tr>
        </thead>
        <tbody style="text-align: center">
            @foreach ($getProducts as $key => $value)
                <tr>
                    <th style="text-align: center">{{ $key + 1 }}</th>
                    <td style="text-align: center; width: 30%">{{ $value->name }}</td>
                    <td style="text-align: center">{{ $valute->category->name }}</td>
                    <td style="text-align: center">{{ $valute->price }}</td>
                    <td style="text-align: center">
                        <select class="form-control">
                            <option value="de_acive">غیر فعال</option>
                            <option value="active_by_admin">فعال کردن توسط ادمین</option>
                            <option value="active_by_customer">فعال کردن توسط مشتری</option>
                        </select>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    {{ $getProducts->links() }}

</div>
