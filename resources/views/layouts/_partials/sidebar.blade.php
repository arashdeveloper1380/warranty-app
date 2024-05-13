<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">

            <li class="nav-item">
                <a class="nav-link" href="{{  route('dashboard.index') }}"><i class="icon-speedometer"></i>داشبورد</a>
            </li>

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-puzzle"></i>مدیریت دسته بندی</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('category.index') }}"><i class="icon-puzzle"></i>دسته بندی</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-puzzle"></i>مدیریت محصولات</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('product.index') }}"><i class="icon-puzzle"></i>لیست محصولات</a>
                    </li>
                </ul>
            </li>
            
        </ul>
    </nav>
</div>