{{--@if (auth('admin')->user()->can('canProduct') or auth('admin')->user()->id == 1)--}}
{{--    <li>--}}
{{--        <a href="javascript: void(0);">--}}
{{--            <i class="mdi mdi-view-list"></i>--}}

{{--            <span>پروژه ها</span>--}}

{{--            <span class="menu-arrow"></span>--}}
{{--        </a>--}}
{{--        <ul class="nav-second-level collapse" aria-expanded="false">--}}



{{--            <li>--}}

{{--                <a href="{{ route('product.create') }}"> تعریف پروژه جدید</a>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="{{ route('product.index') }}">لیست پروژه ها</a>--}}

{{--            </li>--}}
{{--        </ul>--}}
{{--    </li>--}}
{{--@endif--}}

{{--@if (auth('admin')->user()->can('canProductAttribute') or auth('admin')->user()->id == 1)--}}
{{--    <li>--}}
{{--        <a href="javascript: void(0);">--}}
{{--            <i class="mdi mdi-view-list"></i>--}}

{{--            <span>ویژگی های پروژه ها</span>--}}

{{--            <span class="menu-arrow"></span>--}}
{{--        </a>--}}
{{--        <ul class="nav-second-level collapse" aria-expanded="false">--}}
{{--            <li>--}}
{{--                <a href="{{ route('product-attributes.create') }}"> تعریف ویژگی جدید</a>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="{{ route('product-attributes.index') }}">لیست ویژگی ها</a>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--    </li>--}}
{{--@endif--}}

{{--@if (auth('admin')->user()->can('canCity') or auth('admin')->user()->id == 1)--}}
{{--    <li>--}}
{{--        <a href="javascript: void(0);">--}}
{{--            <i class="mdi mdi-view-list"></i>--}}

{{--            <span>شهرها</span>--}}

{{--            <span class="menu-arrow"></span>--}}
{{--        </a>--}}
{{--        <ul class="nav-second-level collapse" aria-expanded="false">--}}
{{--            <li>--}}
{{--                <a href="{{ route('city.create') }}"> تعریف شهر جدید</a>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="{{ route('city.index') }}">لیست شهر ها</a>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--    </li>--}}
{{--@endif--}}

{{--@if (auth('admin')->user()->can('canPageBuilder') or auth('admin')->user()->id == 1)--}}
{{--    <li>--}}
{{--        <a href="javascript: void(0);">--}}
{{--            <i class="mdi mdi-card-bulleted"></i>--}}
{{--            <span>صفحه ساز</span>--}}
{{--            <span class="menu-arrow"></span>--}}
{{--        </a>--}}
{{--        <ul class="nav-second-level collapse" aria-expanded="false">--}}
{{--            <li>--}}
{{--                <a href="{{ route('page.create') }}">ایجاد صفحه جدید</a>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="{{ route('page.index') }}">لیست صفحات</a>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--    </li>--}}
{{--@endif--}}

{{--@if (auth('admin')->user()->can('canInstagram') or auth('admin')->user()->id == 1)--}}
{{--    <li>--}}
{{--        <a href="javascript: void(0);">--}}
{{--            <i class="mdi mdi-card-bulleted"></i>--}}
{{--            <span>اینستاگرام</span>--}}
{{--            <span class="menu-arrow"></span>--}}
{{--        </a>--}}
{{--        <ul class="nav-second-level collapse" aria-expanded="false">--}}
{{--            <li>--}}
{{--                <a href="{{ route('instagram.create') }}">ایجاد پست جدید</a>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="{{ route('instagram.index') }}">لیست پست ها</a>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--    </li>--}}
{{--@endif--}}

{{--@if (auth('admin')->user()->can('canContactUs') or auth('admin')->user()->id == 1)--}}
{{--    <li>--}}
{{--        <a href="{{ route('contact-us.index') }}">--}}
{{--            <i class="mdi mdi-card-bulleted"></i>--}}
{{--            <span>فرم های تماس با ما</span>--}}
{{--        </a>--}}
{{--    </li>--}}
{{--@endif--}}
