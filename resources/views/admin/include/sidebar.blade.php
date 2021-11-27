@php $url=Route::currentRouteName();  @endphp
<div class="left main-sidebar">
    <div class="sidebar-inner leftscroll">
        <div id="sidebar-menu">
            <ul>
                <li class="submenu">
                    <a class="@if($url==='admin.dashboard') active @endif" href="{{route('admin.dashboard')}}">
                        <i class="fas fa-bars"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                <li class="submenu">
                    <a id="tables" class="@if($url==='customers.index' || $url==='customers.create' || $url==='customers.edit') active @endif" href="#">
                        <i class="fas fa-user"></i>
                        <span> Customer </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled">
                        <li class="@if($url==='customers.index') active @endif">
                            <a href="{{route('customers.index')}}">List</a>
                        </li>
                    </ul>
                </li>

                <li class="submenu">
                    <a id="tables" class="@if($url==='vendors.index' || $url==='vendors.create' || $url==='vendors.edit') active @endif" href="#">
                        <i class="fas fa-user"></i>
                        <span>Vendor</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled">
                        <li class="@if($url==='vendors.index') active @endif">
                            <a href="{{route('vendors.index')}}">List</a>
                        </li>
                        <li class="@if($url==='vendors.create') active @endif">
                            <a href="{{route('vendors.create')}}">Add New</a>
                        </li>
                    </ul>
                </li>

                <li class="submenu">
                    <a id="tables" class="@if($url==='admin.product.index' || $url==='admin.product.index') active @endif" href="#">
                        <i class="fab fa-product-hunt"></i>
                        <span>Product</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled">
                        <li class="@if($url==='admin.product.index' || $url==='admin.product.index') active @endif">
                            <a href="{{route('admin.product.index')}}">List</a>
                        </li>
                    </ul>
                </li>



                <li class="submenu">
                    <a id="tables" class="@if($url==='order.page' || $url==='order.page.edit') active @endif" href="#">
                        <i class="fas fa-user"></i>
                        <span>Order</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled">
                        <li class="@if($url==='order.page' || $url==='order.page.edit') active @endif">
                            <a href="{{route('order.page')}}">List</a>
                        </li>
                    </ul>
                </li>

                <li class="submenu">
                    <a id="tables" class="@if($url==='categories.index' || $url==='categories.create' || $url==='categories.edit') active @endif" href="#">
                        <i class="fas fa-certificate"></i>
                        <span>Category</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled">
                        <li class="@if($url==='categories.index') active @endif">
                            <a href="{{route('categories.index')}}">List</a>
                        </li>
                        <li class="@if($url==='categories.create') active @endif">
                            <a href="{{route('categories.create')}}">Add New</a>
                        </li>
                    </ul>
                </li>

                <li class="submenu">
                    <a id="tables" class="@if($url==='brands.index' || $url==='brands.create' || $url==='brands.edit') active @endif" href="#">
                        <i class="fab fa-bandcamp"></i>
                        <span>Brand</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled">
                        <li class="@if($url==='brands.index') active @endif">
                            <a href="{{route('brands.index')}}">List</a>
                        </li>
                        <li class="@if($url==='brands.create') active @endif">
                            <a href="{{route('brands.create')}}">Add New</a>
                        </li>
                    </ul>
                </li>

                <li class="submenu">
                    <a id="tables" class="@if($url==='attributes.index' || $url==='attributes.create' || $url==='attributes.edit') active @endif" href="#">
                        <i class="fab fa-vaadin"></i>
                        <span>Attribute</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled">
                        <li class="@if($url==='attributes.index') active @endif">
                            <a href="{{route('attributes.index')}}">List</a>
                        </li>
                        <li class="@if($url==='attributes.create') active @endif">
                            <a href="{{route('attributes.create')}}">Add New</a>
                        </li>
                    </ul>
                </li>

                <li class="submenu">
                    <a class="@if($url==='countries.index') active @endif" id="tables" href="#">
                        <i class="fas fa-flag"></i>
                        <span>Country</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled">
                        <li>
                            <a class="@if($url==='countries.index') active @endif" href="{{route('countries.index')}}">List</a>
                        </li>
                    </ul>
                </li>

                <li class="submenu">
                    <a class="@if($url==='sliders.index' || $url==='sliders.create') active @endif" id="tables" href="#">
                        <i class="fas fa-flag"></i>
                        <span>Slider</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled">
                        <li>
                            <a class="@if($url==='sliders.index') active @endif" href="{{route('sliders.index')}}">List</a>
                            <a class="@if($url==='sliders.create') active @endif" href="{{route('sliders.create')}}">Create</a>
                        </li>
                    </ul>
                </li>

    

                <li class="submenu">
                    <li class="submenu">
                        <a href="{{route('logout')}}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <i class="fas fa-power-off"></i>
                            <span> Logout </span>
                        </a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>


            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>