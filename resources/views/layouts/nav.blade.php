<button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-secondary am-show-sm-only"
        data-am-collapse="{target: '#collapse-head'}"><span class="am-sr-only">nav switch</span>
        <span class="am-icon-bars"></span></button>
<div class="am-collapse am-topbar-collapse" id="collapse-head">
    @if (Auth::check())
        <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right">
            <li class="am-dropdown" data-am-dropdown>
                <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
                <span class="am-icon-briefcase"></span> {{ Request::user()->nickname}} <span class="am-icon-caret-down"></span>
                </a>
                <ul class="am-dropdown-content">
                    @if ( Auth::user()->is_admin)
                    <li class=""><a href="{{ URL::to('admin/users') }}"><span class="am-icon-users"></span> Users</a></li>
                    @endif
                    <li><a href="{{ URL::to('article/create') }}"><span class="am-icon-edit"></span> Publish Article</a></li>
                    <li><a href="{{ URL::to('user/'.Auth::id().'/edit') }}"><span class="am-icon-user"></span> Information</a></li>
                    <li><a href="{{ URL::to('logout') }}"><span class="am-icon-power-off"></span> Exit</a></li>
                </ul>
            </li>
        </ul>
    @else
        <div class="am-topbar-right">
            <a href="{{ URL::to('register') }}" class="am-btn am-btn-secondary am-topbar-btn am-btn-sm topbar-link-btn"><span class="am-icon-pencil"></span>Register</a>
        </div>
        <div class="am-topbar-right">
            <a href="{{ URL::to('login') }}" class="am-btn am-btn-primary am-topbar-btn am-btn-sm topbar-link-btn"><span class="am-icon-user"></span> Login</a>
        </div>
    @endif
</div>
