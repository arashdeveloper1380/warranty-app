@section('header')
    <style>
        .box {
            box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
            height: 100px;
            border-radius: 20px;
            padding: 10px;
            background-color: currentColor;
            margin-bottom: 20px;
        }
        .box .icon{
            text-align: center;
            font-size: 17px;
            color: #fff;
        }
        .content{
            text-align: center;
            font-size: 30px;
            color: #fff;
        }   
    </style>
@endsection

<div>
    
    <div class="container">
        <div class="row">

            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="box">
                    <div class="icon">
                        <i class="fa fa-check"></i>
                        <span class="title">تعداد محصولات فعال شده</span>
                    </div>
                    <div class="content">{{ $getActiveWarranties }}</div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="box">
                    <div class="icon">
                        <i class="fa fa-close"></i>
                        <span class="title">تعداد محصولات فعال نشده</span>
                    </div>
                    <div class="content">{{ $getNotActiveWarranties }}</div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="box">
                    <div class="icon">
                        <i class="fa fa-eye"></i>
                        <span class="title">تعداد بازدید سایت</span>
                    </div>
                    <div class="content">{{ $getSiteViews }}</div>
                </div>
            </div>

        </div>
    </div>
</div>
