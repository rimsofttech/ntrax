<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="slimscroll-menu">
        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">

                <li class="menu-title">Navigation</li>

                <li>
                    <a href="javascript: void(0);">
                        <i class="fe-airplay"></i>
                        <span class="badge badge-success badge-pill float-right">4</span>
                        <span> Masters </span>
                    </a>
                    {{-- {{dd(Auth::user()->can('List Zone'))}} --}}
                    <ul class="nav-second-level" aria-expanded="false">
                        @if(Auth::user()->can('List Zone'))
                        <li>
                            <a href="{{route('zone.index')}}">Zone Master</a>
                        </li>
                        @endif
                        @if(Auth::user()->can('List ChannelPartner'))
                        <li>
                            <a href="{{route('channelpartner.index')}}">Channel Partner</a>
                        </li>
                        @endif
                        @if(Auth::user()->can('List ChannelPartnerType'))
                        <li>
                            <a href="{{route('channelpartnertype.index')}}">Channel PartnerType</a>
                        </li>
                        @endif
                        @if(Auth::user()->can('List Product'))
                        <li>
                            <a href="{{route('product.index')}}">Product</a>
                        </li>
                        @endif
                        @if(Auth::user()->can('List SubProduct'))
                        <li>
                            <a href="{{route('subproduct.index')}}">SubProduct</a>
                        </li>
                        @endif
                        @if(Auth::user()->can('List SubSubProduct'))
                        <li>
                            <a href="{{route('subsubproduct.index')}}">SubSubProduct</a>
                        </li>
                        @endif
                    </ul>
                </li>
                @if(Auth::user()->hasRole(['Owner','Admin']))
                <li>
                    <a href="javascript: void(0);">
                        <i class="fe-pocket"></i>
                        <span> Role & Permission </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        {{-- @if(Auth::user()->can('list-permission')) --}}
                        <li>
                            <a href="{{route('permission.index')}}">Permission Master</a>
                        </li>
                        {{-- @endif --}}
                        <li>
                            <a href="{{route('role.index')}}">Role Master</a>
                        </li>
                        <li>
                            <a href="{{route('user.index')}}"> User Master</a>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->