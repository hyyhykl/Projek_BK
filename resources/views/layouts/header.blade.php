@php
    $admin = \App\Models\User::where('role', 'admin')->first();
    $notif = $admin ? $admin->unreadNotifications : collect();
@endphp
<header class="navbar pcoded-header navbar-expand-lg navbar-light header-dark">    
    <div class="m-header">
        <a href="#!" class="b-brand">
            <!-- ========   change your logo hear   ============ -->
            <img src="{{ asset('flat/assets/images/logo.png') }}" alt="" class="logo">
            <img src="{{ asset('flat/assets/images/logo-icon.png') }}" alt="" class="logo-thumb">
        </a>
        <a href="#!" class="mob-toggler">
            <i class="feather icon-more-vertical"></i>
        </a>
    </div>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <li>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                        <i class="icon feather icon-bell"></i>
                        @if($notif->count() > 0)
                            <span class="badge badgepill badge-danger">{{ $notif->count() }}</span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-right notification">
                        <div class="noti-head">
                            <h6 class="d-inline-block m-b-0">Notifications</h6>
                            <div class="float-right">
                                <a href="{{ route('notif.readAll') }}" class="m-r-10">mark as read</a>
                                <a href="#!">clear all</a>
                            </div>
                        </div>
                        <ul class="noti-body">
                            @if($notif->count() == 0)
                                <li class="notification text-center p-3">
                                    <p class="m-b-0 text-muted">Tidak ada notifikasi baru</p>
                                </li>
                            @else
                                <li class="n-title">
                                    <p class="m-b-0">NEW</p>
                                </li>
                            @endif
                        
                            @foreach($notif as $notif)
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="{{ asset('flat/assets/images/user/profile.jpg') }}" alt="User">
                        
                                        <div class="media-body">
                                            <p>
                                                <strong>{{ $notif->data['title'] ?? 'Notifikasi Baru' }}</strong>
                                                <span class="n-time text-muted">
                                                    <i class="icon feather icon-clock m-r-10"></i>
                                                    {{ $notif->created_at->diffForHumans() }}
                                                </span>
                                            </p>
                                            <p>{{ $notif->data['message'] ?? '' }}</p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="noti-footer">
                            <a href="#!">show all</a>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <div class="dropdown drp-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="feather icon-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-notification">
                        <div class="pro-head">
                            <img src="{{ asset('flat/assets/images/user/profile.jpg') }}" class="img-radius" alt="User-Profile-Image">
                            <span>John Doe</span>
                            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="dud-logout" title="Logout" 
                                    style="background:none; border:none; padding:0; margin:0; cursor:pointer;">
                                    <i class="feather icon-log-out" style="color:white;"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>        
</header>