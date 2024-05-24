<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">

            <li class="nav-item">
                <a class="nav-link" href="{{  route('dashboard.index') }}"><i class="icon-speedometer"></i>داشبورد</a>
            </li>

            @if (auth()->user()->is_admin != 1 && in_array('category', auth()->user()->permission))
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-puzzle"></i>مدیریت دسته بندی</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('category.index') }}"><i class="icon-puzzle"></i>دسته بندی</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('default-product.index') }}"><i class="icon-puzzle"></i>محصولات</a>
                        </li>

                    </ul>
                </li>

            @elseif(auth()->user()->is_admin == 1)
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-puzzle"></i>مدیریت دسته بندی</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('category.index') }}"><i class="icon-puzzle"></i>دسته بندی</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('default-product.index') }}"><i class="icon-puzzle"></i>محصولات</a>
                        </li>

                    </ul>
                </li>

            @endif
            

            @if (auth()->user()->is_admin != 1 && in_array('category', auth()->user()->permission))
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-puzzle"></i>مدیریت محصولات</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('product.index') }}"><i class="icon-puzzle"></i>لیست محصولات</a>
                        </li>
                    </ul>
                </li>
            @elseif(auth()->user()->is_admin == 1)
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-puzzle"></i>مدیریت محصولات</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('product.index') }}"><i class="icon-puzzle"></i>لیست محصولات</a>
                        </li>
                    </ul>
                </li>
            @endif

            @if(auth()->user()->is_admin == 1)
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-puzzle"></i>مدیریت ادمین ها</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.index') }}"><i class="icon-puzzle"></i>لیست ادمین ها</a>
                        </li>
                    </ul>
                </li>
            @endif
            
            
        </ul>
    </nav>
</div>