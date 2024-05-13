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
    <h2>مدیریت دسته بندی</h2>
    
    @if(session()->has('success'))
        <div class="alert alert-success">{{ session()->get('success') }}</div>
    @endif
    <a href="{{ route('category.create') }}" class="btn btn-primary pull-left">+ دسته بندی جدید</a><br>

    <table class="table table-bordered table-striped table-hover"
        style="border-radius: 20px; display: block; padding: 30px;padding: 30px;box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;border: 0;width: 100%;margin: 20px auto;">
        <thead>
            <tr>
                <th style="text-align: center; width: 7%">#</th>
                <th style="text-align: center; width: 59%">نام دسته بندی</th>
                <th style="text-align: center; width: 40%">دسته مادر</th>
                <th style="text-align: center">مدریت</th>
            </tr>
        </thead>
        <tbody style="text-align: center">
            @foreach ($categories as $key => $value)
                <tr>
                    <th style="text-align: center">{{ $key + 1 }}</th>
                    <td style="text-align: center; width: 30%">{{ $value->name }}</td>
                    <td style="text-align: center">
                        @if (!empty($value->parent_id))
                            <span class="alert alert-success custom-parent">{{ $value->getParent->name}}</span>
                        @else
                            <span class="alert alert-danger custom-parent">ندارد</span>
                        @endif
                    </td>
                    <td style="text-align: center; width: 30%">
                        <form style="display: contents;" action="" method="POST">
                            @csrf
                            @method("DELETE")
                            <input type="submit" class="btn btn-danger" value="حذف">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    {{ $categories->links() }}


</div>
