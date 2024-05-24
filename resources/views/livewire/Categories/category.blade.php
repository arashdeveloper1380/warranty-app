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
        .dropbtn {
            background-color: #4CAF50;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            width: 70px;
            height: 40px;
            line-height: 6px;

        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {background-color: #f1f1f1}

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }
        .warning{
            background-color: rgb(223, 223, 20)
        }
        .danger{
            background-color: crimson;
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
                <th style="text-align: center">مدیریت</th>
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
                    <td style="text-align: center; width: 30%">{{ $value->code ?? 'ندارد' }}</td>
                    <td style="text-align: center; width: 25%">
                        
                        <div class="dropdown">
                            <button class="dropbtn warning">ویرایش</button>
                            <div class="dropdown-content">
                                <a href="#">{{ $value->name }}</a>
                                @foreach ($value->getChild as $item)
                                    <a href="#">{{ $item->name }}</a>
                                    @foreach ($item->getChild as $item2)
                                        <a href="#">{{ $item2->name }}</a>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>

                        <div class="dropdown">
                            <button class="dropbtn danger">حذف</button>
                            <div class="dropdown-content">
                                <a href="#">{{ $value->name }}</a>
                                @foreach ($value->getChild as $item)
                                    <a href="#">{{ $item->name }}</a>
                                    @foreach ($item->getChild as $item2)
                                        <a href="#">{{ $item2->name }}</a>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    {{ $categories->links() }}


</div>
