<header id="header" class="navbar">
    <ul class="nav navbar-nav navbar-avatar pull-right">
        <li class="dropdown">

            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="hidden-sm-only"></span>

                <span class="thumb-small avatar inline">
                    <img src="{{ asset('packages/main/img/img.jpg') }}" alt="{{ Auth::guard('admin')->user()->username }}" class="img-circle user-avatar">
                </span>

                <b class="caret hidden-sm-only"></b>
            </a>

            <!-- .dropdown-menu-->
            <ul class="dropdown-menu">
                <li>
                    <a href="{{ URL::route('admin.change_pw') }}">
                        Change password
                    </a>
                </li>

                <li>
                    <a href="{{ URL::route('admin.logout') }}">
                        Signout ({{ Auth::guard('admin')->user()->username }})
                    </a>
                </li>
            </ul>
        </li>
    </ul>

    <!-- <a class="navbar-brand" href="{{ URL::route('admin.home') }}">
        {{ Html::image('packages/main/img/logo.png') }}
    </a> -->

   <ul class="nav navbar-nav visible-lg">
        <li>
            <div class="m-t-small">

                <a class="btn btn-small btn-info show-navbar" href="javascript:show_navbar();" @if(!isset($_COOKIE['HiddenNavbar']) || $_COOKIE['HiddenNavbar'] == 0) style="display: none; @endif>
                    <i class="icon icon-fw icon-plus"></i> Show navbar
                </a>

                <a class="btn btn-small btn-primary hidden-navbar" href="javascript:hidden_navbar();" @if(isset($_COOKIE['HiddenNavbar']) && $_COOKIE['HiddenNavbar'] == 1){{ 'style="display: none;' }}@endif>
                    <i class="icon icon-fw icon-minus"></i> Hide navbar
                </a>
            </div>
        </li>
    </ul>
</header>