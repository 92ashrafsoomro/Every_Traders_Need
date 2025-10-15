<li
    class="menu-item {{ request()->is('tickethistory*') || request()->is('createticket*') || request()->is('ticket*') ? 'active' : '' }}">
    <a href="{{ route('ticket.history') }}" class="menu-link gap-2">
        <span class="material-symbols-outlined">
            support_agent
        </span>
        <div class="sidebar_T">Support</div>
    </a>
</li>

<li class="menu-item {{ request()->is('news*') ? 'active' : 'text-white' }}">
    <a href="{{ route('news.index') }}" class="menu-link gap-2">
        <span class="material-symbols-outlined">
            newspaper
        </span>
        <div class="sidebar_T">News</div>
    </a>
</li>
{{-- <li class="menu-item {{ request()->is('blog*') ? 'active' : '' }}">
        <a href="{{ route('blog.index') }}" class="menu-link">
            <span class="menu-icon icon-base ti tabler-news"></span>
            <div>Blog</div>
        </a>
    </li> --}}

<!-- Cards -->
<li class="menu-item {{ request()->is('userprofile*') ? 'active' : '' }}">
    <a href="{{ url('userprofile') }}" class="menu-link gap-2">
        <span class="material-symbols-outlined">
            account_circle
        </span>
        <div class="sidebar_T">Profile</div>
    </a>
</li>

<li class="menu-item {{ request()->is('account-setting/profile*') ? 'active' : '' }}">
    <a href="{{ url('/account-setting/profile') }}" class="menu-link">
        <span class="menu-icon icon-base ti tabler-settings"></span>
        <div class="sidebar_T">Setting</div>
    </a>
</li>
