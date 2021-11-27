<aside class="left-sidebar" data-sidebarbg="skin5">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
               <ul id="sidebarnav" class="pt-4">
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{route('vendor.dashboard')}}" aria-expanded="false"> <i class="fas fa-bars"></i><span
                                class="hide-menu">Dashboard</span></a></li>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                            href="javascript:void(0)" aria-expanded="false"><i class="fab fa-product-hunt"></i><span
                                class="hide-menu">Product </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{route('products.index')}}" class="sidebar-link"><i
                                        class="mdi mdi-all-inclusive"></i><span class="hide-menu"> List </span></a>
                            </li>
                            <li class="sidebar-item"><a href="{{route('products.create')}}" class="sidebar-link"><i
                                        class="mdi mdi-all-inclusive"></i><span class="hide-menu"> Add New
                                    </span></a></li>
                                    <li class="sidebar-item"><a href="{{route('product.stock')}}" class="sidebar-link"><i
                                        class="mdi mdi-all-inclusive"></i><span class="hide-menu"> Stock
                                    </span></a></li>
                                    <li class="sidebar-item"><a href="{{route('reviews.index')}}" class="sidebar-link"><i
                                        class="mdi mdi-all-inclusive"></i><span class="hide-menu"> Product Review
                                    </span></a></li>
                                    <li class="sidebar-item"><a href="{{route('product.wishlist')}}" class="sidebar-link"><i
                                        class="mdi mdi-all-inclusive"></i><span class="hide-menu"> Product Wishlist
                                    </span></a></li>
                        </ul>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                            href="javascript:void(0)" aria-expanded="false"><i class="fas fa-certificate"></i><span
                                class="hide-menu">Order </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{route('orders.index')}}" class="sidebar-link"><i
                                        class="mdi mdi-all-inclusive"></i><span class="hide-menu"> List </span></a>
                            </li>
                        </ul>
                    </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                            href="javascript:void(0)" aria-expanded="false"><i class="fas fa-certificate"></i><span
                                class="hide-menu">Delivery Charge </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{route('delivery-charge.index')}}" class="sidebar-link"><i
                                        class="mdi mdi-all-inclusive"></i><span class="hide-menu"> List </span></a>
                            </li>
                            <li class="sidebar-item"><a href="{{route('delivery-charge.create')}}" class="sidebar-link"><i
                                class="mdi mdi-all-inclusive"></i><span class="hide-menu"> Add </span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                        href="javascript:void(0)" aria-expanded="false"><i class="fas fa-certificate"></i><span
                            class="hide-menu">Coupon</span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{route('coupon.index')}}" class="sidebar-link"><i
                                        class="mdi mdi-all-inclusive"></i><span class="hide-menu"> List </span></a>
                            </li>
                            <li class="sidebar-item"><a href="{{route('coupon.create')}}" class="sidebar-link"><i
                                class="mdi mdi-all-inclusive"></i><span class="hide-menu"> Add </span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item p-3">
                        <a href="{{route('logout')}}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" class="w-100 btn btn-cyan d-flex align-items-center text-white"><i class="fa fa-power-off me-1 ms-1"></i>Logout</a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </ul>
        </nav>
    </div>
</aside>