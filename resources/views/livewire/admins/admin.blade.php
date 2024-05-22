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
    <h2>مدیریت ادمین ها</h2>
    
    @if(session()->has('success'))
        <div class="alert alert-success">{{ session()->get('success') }}</div>
    @endif
    <a href="{{ route('admin.create') }}" class="btn btn-primary pull-left">افزودن ادمین جدید</a><br>
    <br>
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th style="text-align: center">#</th>
                <th style="text-align: center">نام</th>
                <th style="text-align: center">ایمیل</th>
                <th style="text-align: center">سطح دسترسی</th>
            </tr>
        </thead>
        <tbody style="text-align: center">
            @foreach ($admins as $key => $value)
                <tr>
                    <th style="text-align: center">{{ $key + 1 }}</th>
                    <td style="text-align: center; width: 30%">{{ $value->name }}</td>
                    <td style="text-align: center">{{ $value->email }}</td>
                    <td style="text-align: center; width: 30%">
                        @if($value->is_admin != 1) 
                            <ul>
                                @foreach ($value->permission as $item)
                                    <li>
                                        @if ($item == "category")
                                            دسته بندی
                                        @endif

                                        @if ($item == "product")
                                            محصولات
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @else
                        سوپر ادمین
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>

</div>
