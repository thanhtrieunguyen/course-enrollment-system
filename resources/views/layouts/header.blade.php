<div>
    <nav class="py-1 border-b border-yellow-500 bg-white">
        <div class="lg:h-16 px-0 lg:px-2 lg:block">
            <div class="py-0 grid grid-cols-1 md:grid-cols-2 md:gap-6 lg:gap-6">
                <div class="flex justify-start px-3"><a class="flex items-center" href="/trangchu">
                        <div
                            class="bg-blue-900 text-white w-10 h-10 flex items-center justify-center font-bold text-xl mr-3 rounded-md">
                            {{ substr(config('app.name'), 0, 1) }}
                        </div>
                        <div class="py-2">
                            <div class="text-blue-900 text-left text-sm lg:text-lg font-bold uppercase">
                                {{ config('app.name') }}
                            </div>
                            <div class="text-gray-500 text-left text-xs lg:text-sm">
                                Hệ thống đăng ký học phần
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </nav>
    <!-- menu bar -->
    <div class="nav-menu">
        <div class="container">
            <div class="nav-content">
                <nav class="main-nav">
                    <a href="/trangchu" class="nav-link {{ Request::is('trangchu') ? 'active' : '' }}">Trang Chủ</a>
                    <a href="/dangky" class="nav-link {{ Request::is('dangky') ? 'active' : '' }}">Đăng ký học
                        phần</a>
                    <a href="/ketqua-dangky" class="nav-link {{ Request::is('ketqua-dangky') ? 'active' : '' }}">Kết
                        quả đăng ký</a>
                    @if (Auth::user()->role == 'admin')
                        <a href="/admin" class="nav-link {{ Request::is('admin') ? 'active' : '' }}">Quản lý</a>
                    @endif
                </nav>

                <div class="user-section">
                    <a href="/profile" class="user-link">{{ $sinhvien->hoten }}</a>
                    <span class="separator">-</span>
                    <form action="{{ route('logout') }}" method="POST" class="logout-form"
                        onsubmit="return confirm('Bạn có chắc chắn muốn đăng xuất không?');">
                        @csrf
                        <button type="submit" class="logout-btn">Đăng Xuất</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .nav-menu {
            background-color: #002244;
            padding: 0.75rem 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .nav-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .main-nav {
            display: flex;
            gap: 2rem;
        }

        .nav-link {
            color: #e5e5e5;
            text-decoration: none;
            padding: 0.5rem 0;

        }

        .nav-link.active {
            color: #B3995D;
            font-weight: bold;
        }

        .nav-link:hover {
            color: #B3995D;
        }

        .user-section {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .user-link:hover {
            color: #B3995D;
        }

        .user-link {
            color: #B3995D;
            font-weight: 600
        }

        .separator {
            color: #666;
        }

        .logout-form {
            display: inline;
        }

        .logout-btn {
            background: none;
            border: none;
            color: #e5e5e5;
            cursor: pointer;
            font-size: 1rem;
            padding: 0;

        }

        .logout-btn:hover {
            color: #FFD700;
        }

        @media (max-width: 768px) {
            .nav-content {
                flex-direction: column;
                gap: 1rem;
            }

            .main-nav {
                flex-direction: column;
                align-items: center;
                gap: 1rem;
            }

            .user-section {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</div>