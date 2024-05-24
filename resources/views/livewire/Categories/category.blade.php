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
    <input style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;border: 0;border-radius: 5px; width: 300px;" type="text" wire:model.live="search" class="form-control" placeholder="جست وجو کنید ...!">
    <br>
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th style="text-align: center">#</th>
                <th style="text-align: center">نام دسته بندی</th>
                <th style="text-align: center">کد اختصار</th>
            </tr>
        </thead>
        <tbody style="text-align: center">
            @foreach ($categories as $key => $value)
                <tr>
                    <th style="text-align: center">{{ $key + 1 }}</th>
                    <td style="text-align: center; width: 30%">
                        <p style="color: crimson">{{ $value->name }}</p>
                        <ul style="list-style-type: none">
                            @foreach ($value->getChild as $key2 => $value2)
                                <li>{{ $value2->name }}</li>
                                <ul style="list-style-type: none">
                                    @foreach ($value2->getChild as $key3 => $value3)
                                        <li>{{ $value3->name }}</li>
                                    @endforeach
                                </ul>
                            @endforeach
                        </ul>
                    </td>
                    {{-- <td style="text-align: center">
                        @if (!empty($value->parent_id))
                            <span class="alert alert-success custom-parent">{{ $value->getParent->name}}</span>
                        @else
                            <span class="alert alert-danger custom-parent">ندارد</span>
                        @endif
                    </td> --}}
                    <td style="text-align: center; width: 30%">{{ $value->code ?? 'ندارد' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    {{ $categories->links() }}


</div>
