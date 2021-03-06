<div class="c-sidebar-brand">
    <img src="{{asset('images/sj_logo_long.png')}}" alt="SJ Legacy" width="90%" height="auto" style="padding:10px">
</div>
<ul class="c-sidebar-nav ps">
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link c-active" href="https://riseaboveself.com/dashboard">
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{asset('icons/sprites/free.svg#cil-speedometer')}}"></use>
            </svg>
            Dashboard</a>
    </li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('profile.edit', auth()->id()) }}">
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{asset('icons/sprites/free.svg#cil-people')}}"></use>
            </svg>
            Profile</a>
    </li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('willform.create')}}">
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{asset('icons/sprites/free.svg#cil-elevator')}}">
                </use>
            </svg>
            New Will
        </a>
    </li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('willform.submissions')}}">
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{asset('icons/sprites/free.svg#cil-layers')}}">
                </use>
            </svg>
            Submission</a></li>
    @hasrole('admin')
    <li class="c-sidebar-nav-title">Payment</li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="https://riseaboveself.com/payments">
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{asset('icons/sprites/free.svg#cil-money')}}"></use>
            </svg>
            Payments &amp; Subscriptions</a></li>
    <li class="c-sidebar-nav-title">Manage Will</li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('singleWill.form')}}">
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{asset('icons/sprites/free.svg#cil-user')}}"></use>
            </svg>
            Edit Will</a></li>
    <li class="c-sidebar-nav-title">Settings</li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('users.index') }}">
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{asset('icons/sprites/free.svg#cil-group')}}"></use>
            </svg>
            Manage Users</a></li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('users.create') }}">
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{asset('icons/sprites/free.svg#cil-user')}}"></use>
            </svg>
            Create User</a></li>
    @endhasrole
    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
    </div>
    <div class="ps__rail-y" style="top: 0px; right: 0px;">
        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
    </div>
</ul>
<button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
        data-class="c-sidebar-minimized"></button>
