    <li class="menu-item {{ request()->is('dashboard*') ? 'active' : '' }}">
        <a href="{{ URL::to('/dashboard') }}" class="menu-link">
            <span class="menu-icon icon-base ti tabler-layout-dashboard"></span>
            {{-- <div data-i18n="Dashboard">Dashboard</div> --}}
            <div>Dashboard</div>
        </a>
    </li>

    <li class="menu-item {{ request()->is('auction-finder*') ? 'active' : '' }}">
        <a href="{{ url('/auction-finder') }}" class="menu-link">
            <span class="menu-icon icon-base ti tabler-gavel"></span>
            {{-- <div data-i18n="Auction Finder">Auction Finder</div> --}}
            <div>Auction Finder</div>
        </a>
    </li>

    <li class="menu-item {{ request()->is('interest*') ? 'active' : '' }}">
        <a href="{{ url('/interest') }}" class="menu-link gap-x-2">
            {{-- <i class="menu-icon icon-base ti tabler-pointer-heart"></i> --}}
            <span class="material-symbols-outlined" style="font-size: 22px;">
                thumb_up
            </span>
            {{-- <div data-i18n="My Interest">My Interest</div> --}}
            <div>My Interest</div>
        </a>
    </li>

    <li class="menu-item {{ request()->is('viewhistory*') ? 'active' : '' }}">
        <a href="{{ url('/viewhistory') }}" class="menu-link">
            <span class="menu-icon ti tabler-history"></span>
            <div>Watchlist</div>
        </a>
    </li>


    <li class="menu-item {{ request()->is('reauction*') ? 'active open' : '' }}">
        <a href="{{ URL::to('/reauction') }}" class="menu-link">
            <span class="menu-icon icon-base ti tabler-calendar-repeat"></span>
            {{-- <div data-i18n="Reauction">Reauction</div> --}}
            <div>Reauction</div>
        </a>
    </li>

    <li class="menu-item {{ request()->is('compare*') ? 'active open' : '' }}">
        <a href="{{ URL::to('/compare') }}" class="menu-link">
            <span class="menu-icon icon-base ti tabler-arrows-diff"></span>
            {{-- <div data-i18n="Compare">Compare</div> --}}
            <div>Compare</div>
        </a>
    </li>


    <li class="menu-item {{ request()->is('auctionscheduler*') ? 'active' : '' }}">
        <a href="{{ URL::to('/auctionscheduler') }}" class="menu-link space-x-2">
            <span class="material-symbols-outlined">
                event_available
            </span>
            {{-- <div data-i18n="Auction Scheduler">Auction Scheduler</div> --}}
            <div>Auction Scheduler</div>
        </a>
    </li>
