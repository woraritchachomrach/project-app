<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard ระบบขอใช้รถราชการ</title>

    <!-- Bootstrap & AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Home</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">

        <!-- Notifications -->
<li class="nav-item dropdown">
    <a class="nav-link" data-bs-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        @php $notificationCount = auth()->user()->unreadNotifications->count(); @endphp
        @if ($notificationCount > 0)
            <span class="badge bg-danger navbar-badge">{{ $notificationCount }}</span>
        @endif
    </a>

    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
        <span class="dropdown-header">{{ $notificationCount }} การแจ้งเตือน</span>
        <div class="dropdown-divider"></div>

        @forelse (auth()->user()->unreadNotifications as $notification)
            <a href="{{ route('notifications.read', $notification->id) }}" class="dropdown-item">
                <i class="fas fa-car text-primary me-2"></i>
                {{ $notification->data['message'] ?? 'ไม่มีข้อความ' }}
                <span class="float-end text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
            </a>
            <div class="dropdown-divider"></div>
        @empty
            <span class="dropdown-item text-muted">ไม่มีการแจ้งเตือนใหม่</span> @endforelse

        <a href="#"
        class="dropdown-item dropdown-footer">ดูทั้งหมด</a>
    </div>
    </li>

    <!-- User Profile -->
    <li class="nav-item
        dropdown">
        <a class="nav-link" data-bs-toggle="dropdown" href="#">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff&rounded=true"
                class="rounded-circle" width="30" height="30" alt="User Avatar">
            <span class="ms-2 d-none d-md-inline">{{ Auth::user()->name }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
            <li>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-user me-2"></i> โปรไฟล์
                </a>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="dropdown-item text-danger" type="submit">
                        <i class="fas fa-sign-out-alt me-2"></i> ออกจากระบบ
                    </button>
                </form>
            </li>
        </ul>
    </li>

    </ul>

    </nav>

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
            <span class="brand-text font-weight-light">ระบบขอใช้รถราชการ</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                  <!--  <li class="nav-item">
                        <a href="{{ route('user-profiles.create') }}" class="nav-link">
                            <i class="nav-icon fas fa-calendar"></i>
                            <p>เพิ่มผู้ใช้</p>
                        </a>
                    </li> -->
                   <!-- <li class="nav-item">
                        <a href="{{ route('user-profiles.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>รายการผู้ใช้</p>
                        </a>
                    </li> -->
                    <li class="nav-item">
                        <a href="{{ route('car-requests.create') }}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>แบบขอรถ</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('car-requests.list') }}" class="nav-link">
                            <i class=""></i>
                            <p>รายการขอรถ</p>
                        </a>
                    </li>
                    @if (Auth::user()->role === 'chief')
                        <li class="nav-item">
                            <a href="{{ route('chief.dashboard') }}" class="nav-link">
                                <i class="nav-icon fas fa-user-shield"></i>
                                <p>หน้าหัวหน้ายาน</p>
                            </a>
                        </li>
                    @endif

                    <li class="nav-item
        mt-auto">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="nav-link text-danger btn btn-link"
                                style="color: inherit; text-align: left; padding: 0;">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>ออกจากระบบ</p>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        @yield('content') {{-- ตรงนี้จะแสดงเนื้อหาของแต่ละหน้า --}}
    </div>

    </div>

    <!-- JS Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

    @stack('scripts') {{-- สำหรับหน้าอื่น ๆ ที่อยากเพิ่ม script เพิ่มเติม --}}
    @yield('scripts')
    </body>

</html>
