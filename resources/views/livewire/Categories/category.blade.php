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
    <br>
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th style="text-align: center">#</th>
                <th style="text-align: center">نام دسته بندی</th>
                <th style="text-align: center">دسته مادر</th>
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

                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    {{ $categories->links() }}


</div>
