<div class="deznav">
    <div class="deznav-scroll">
        <ul class="nav menu-tabs">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard*') || request()->is('log-aktivitas*') ? 'active' : '' }}"
                    data-toggle="tab" href="#dashboard-area">
                    <svg id="icon-home1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-home">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                </a>
            </li>
            @if (Auth::user()->level != 'user' && Auth::user()->level != 'verifikator')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('master*') ? 'active' : '' }}" data-toggle="tab" href="#apps">
                        <svg id="icon-apps" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link  {{ request()->is('jamkesda*') ? 'active' : '' }}" data-toggle="tab" href="#table">
                    <svg id="icon-table" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-server">
                        <rect x="2" y="2" width="20" height="8" rx="2" ry="2">
                        </rect>
                        <rect x="2" y="14" width="20" height="8" rx="2" ry="2">
                        </rect>
                        <line x1="6" y1="6" x2="6" y2="6"></line>
                        <line x1="6" y1="18" x2="6" y2="18"></line>
                    </svg>
                </a>
            </li>
            @if (Auth::user()->level != 'user' && Auth::user()->level != 'verifikator')
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#forms">
                        <svg id="icon-forms" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"
                                style="stroke-dasharray: 66, 86; stroke-dashoffset: 0;"></path>
                            <path d="M14,2L14,8L20,8" style="stroke-dasharray: 12, 32; stroke-dashoffset: 0;">
                            </path>
                            <path d="M16,13L8,13" style="stroke-dasharray: 8, 28; stroke-dashoffset: 0;"></path>
                            <path d="M16,17L8,17" style="stroke-dasharray: 8, 28; stroke-dashoffset: 2;"></path>
                            <path d="M10,9L9,9L8,9" style="stroke-dasharray: 2, 22; stroke-dashoffset: 12;">
                            </path>
                        </svg>
                    </a>
                </li>
            @endif
        </ul>
    </div>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <a href="{{ route('logout') }}" onclick="event.preventDefault();
        this.closest('form').submit();"
            class="logout-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="feather feather-log-out">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                <polyline points="16 17 21 12 16 7"></polyline>
                <line x1="21" y1="12" x2="9" y2="12"></line>
            </svg></a>
    </form>
</div>
