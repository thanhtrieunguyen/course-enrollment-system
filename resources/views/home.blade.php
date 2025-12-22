@extends('layouts.main')
@section('title', 'Trang Chủ')

@section('content')

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Có lỗi xảy ra!',
                text: '{{ session('error') }}',
                showConfirmButton: true,
            });
            <?php    session()->forget('error'); ?>
        </script>
    @endif

    <!-- Success Notification -->
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
            <?php    session()->forget('success'); ?>
        </script>
    @endif

    <style>
        /* Custom Pagination Styling */
        .pagination-container nav {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .pagination-container .relative.inline-flex.items-center {
            padding: 8px 16px;
            border: 1px solid #e5e7eb;
            background-color: white;
            color: #374151 !important;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .pagination-container .relative.inline-flex.items-center:hover {
            background-color: #f3f4f6;
            color: #002244 !important;
        }

        /* Active page */
        .pagination-container .z-10.bg-indigo-50,
        .pagination-container [aria-current="page"] span,
        .pagination-container [aria-current="page"] .relative {
            background-color: #002244 !important;
            border-color: #002244 !important;
            color: white !important;
        }

        .pagination-container svg {
            width: 20px;
            height: 20px;
            display: inline-block;
        }
    </style>

    <div class="container min-w-full px-5 mx-auto bg-gray-50">
        @if (Session::has('message'))
            <script>
                toastr.success("{{ Session::get('message') }}");
            </script>
        @endif

        <div class="py-8">
            <h2 class="text-center text-2xl font-bold mb-8 text-blue-900 border-b-2 pb-2 inline-block mx-auto w-full">
                TIN TỨC - SỰ KIỆN
            </h2>

            @php
                $news = [
                    [
                        'title' => 'Hội thảo khoa học phiên dịch giả định của sinh viên ngôn ngữ anh',
                        'date' => '28 May, 2024',
                        'excerpt' => 'Dựa trên mô hình Hội thảo Giả định của UNESCO...',
                        'image' => 'uploads/h1.jpg',
                        'link' =>
                            'https://vaa.edu.vn/hoi-thao-khoa-hoc-phien-dich-gia-dinh-cua-sinh-vien-ngon-ngu-anh/',
                    ],
                    [
                        'title' => 'Bộ phẩm chất và năng lực sinh viên tốt nghiệp Học viện Hàng không Việt Nam',
                        'date' => '1 October, 2024',
                        'excerpt' =>
                            'Nhằm cụ thể hóa tầm nhìn, sứ mạng và giá trị cốt lõi của Học viện Hàng không Việt Nam...',
                        'image' => 'uploads/h2.png',
                        'link' =>
                            'https://vaa.edu.vn/bo-pham-chat-va-nang-luc-sinh-vien-tot-nghiep-hoc-vien-hang-khong-viet-nam/',
                    ],
                    [
                        'title' => 'Khai giảng ấm áp tình người của Học viện Hàng không Việt Nam',
                        'date' => '30 September, 2024',
                        'excerpt' =>
                            'Sáng ngày 29/9/2024, Học viện Hàng không Việt Nam tổ chức Lễ Khai giảng năm học 2024-2025...',
                        'image' => 'uploads/h3.png',
                        'link' => 'https://vaa.edu.vn/khai-giang-am-ap-tinh-nguoi-cua-hoc-vien-hang-khong-viet-nam/',
                    ],
                    [
                        'title' => 'Sinh viên Học viện Hàng không hỗ trợ hành khách tại Tân Sơn Nhất dịp lễ 02/09/2024',
                        'date' => '6 September, 2024',
                        'excerpt' =>
                            'Chiến dịch Thanh niên tình nguyện dịp cao điểm Lễ Quốc Khánh được phát động bởi Đoàn Cảng hàng không Quốc tế Tân Sơn Nhất...',
                        'image' => 'uploads/h4.png',
                        'link' =>
                            'https://vaa.edu.vn/net-dep-sinh-vien-hoc-vien-hang-khong-viet-nam-khi-ho-tro-hanh-khach-tai-cang-hang-khong-quoc-te-tan-son-nhat-dip-le-quoc-khanh-02-09-2024/',
                    ],
                    [
                        'title' => 'Sinh viên Học viện Hàng không hỗ trợ hành khách tại Tân Sơn Nhất dịp lễ 02/09/2024',
                        'date' => '6 September, 2024',
                        'excerpt' =>
                            'Chiến dịch Thanh niên tình nguyện dịp cao điểm Lễ Quốc Khánh được phát động bởi Đoàn Cảng hàng không Quốc tế Tân Sơn Nhất...',
                        'image' => 'uploads/h4.png',
                        'link' =>
                            'https://vaa.edu.vn/net-dep-sinh-vien-hoc-vien-hang-khong-viet-nam-khi-ho-tro-hanh-khach-tai-cang-hang-khong-quoc-te-tan-son-nhat-dip-le-quoc-khanh-02-09-2024/',
                    ],
                    [
                        'title' => 'Sinh viên Học viện Hàng không hỗ trợ hành khách tại Tân Sơn Nhất dịp lễ 02/09/2024',
                        'date' => '6 September, 2024',
                        'excerpt' =>
                            'Chiến dịch Thanh niên tình nguyện dịp cao điểm Lễ Quốc Khánh được phát động bởi Đoàn Cảng hàng không Quốc tế Tân Sơn Nhất...',
                        'image' => 'uploads/h4.png',
                        'link' =>
                            'https://vaa.edu.vn/net-dep-sinh-vien-hoc-vien-hang-khong-viet-nam-khi-ho-tro-hanh-khach-tai-cang-hang-khong-quoc-te-tan-son-nhat-dip-le-quoc-khanh-02-09-2024/',
                    ],
                    [
                        'title' => 'Sinh viên Học viện Hàng không hỗ trợ hành khách tại Tân Sơn Nhất dịp lễ 02/09/2024',
                        'date' => '6 September, 2024',
                        'excerpt' =>
                            'Chiến dịch Thanh niên tình nguyện dịp cao điểm Lễ Quốc Khánh được phát động bởi Đoàn Cảng hàng không Quốc tế Tân Sơn Nhất...',
                        'image' => 'uploads/h4.png',
                        'link' =>
                            'https://vaa.edu.vn/net-dep-sinh-vien-hoc-vien-hang-khong-viet-nam-khi-ho-tro-hanh-khach-tai-cang-hang-khong-quoc-te-tan-son-nhat-dip-le-quoc-khanh-02-09-2024/',
                    ],
                    [
                        'title' => 'Sinh viên Học viện Hàng không hỗ trợ hành khách tại Tân Sơn Nhất dịp lễ 02/09/2024',
                        'date' => '6 September, 2024',
                        'excerpt' =>
                            'Chiến dịch Thanh niên tình nguyện dịp cao điểm Lễ Quốc Khánh được phát động bởi Đoàn Cảng hàng không Quốc tế Tân Sơn Nhất...',
                        'image' => 'uploads/h4.png',
                        'link' =>
                            'https://vaa.edu.vn/net-dep-sinh-vien-hoc-vien-hang-khong-viet-nam-khi-ho-tro-hanh-khach-tai-cang-hang-khong-quoc-te-tan-son-nhat-dip-le-quoc-khanh-02-09-2024/',
                    ],
                    [
                        'title' => 'Sinh viên Học viện Hàng không hỗ trợ hành khách tại Tân Sơn Nhất dịp lễ 02/09/2024',
                        'date' => '6 September, 2024',
                        'excerpt' =>
                            'Chiến dịch Thanh niên tình nguyện dịp cao điểm Lễ Quốc Khánh được phát động bởi Đoàn Cảng hàng không Quốc tế Tân Sơn Nhất...',
                        'image' => 'uploads/h4.png',
                        'link' =>
                            'https://vaa.edu.vn/net-dep-sinh-vien-hoc-vien-hang-khong-viet-nam-khi-ho-tro-hanh-khach-tai-cang-hang-khong-quoc-te-tan-son-nhat-dip-le-quoc-khanh-02-09-2024/',
                    ],
                    [
                        'title' => 'Sinh viên Học viện Hàng không hỗ trợ hành khách tại Tân Sơn Nhất dịp lễ 02/09/2024',
                        'date' => '6 September, 2024',
                        'excerpt' =>
                            'Chiến dịch Thanh niên tình nguyện dịp cao điểm Lễ Quốc Khánh được phát động bởi Đoàn Cảng hàng không Quốc tế Tân Sơn Nhất...',
                        'image' => 'uploads/h4.png',
                        'link' =>
                            'https://vaa.edu.vn/net-dep-sinh-vien-hoc-vien-hang-khong-viet-nam-khi-ho-tro-hanh-khach-tai-cang-hang-khong-quoc-te-tan-son-nhat-dip-le-quoc-khanh-02-09-2024/',
                    ],
                ];
                $perPage = 8; // Số lượng bài viết hiển thị trên mỗi trang
                $page = request('page', 1); // Trang hiện tại
                $total = count($news); // Tổng số bài viết
                $newsOnPage = array_slice($news, ($page - 1) * $perPage, $perPage); // Chia nhỏ dữ liệu theo trang
            @endphp


            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                @foreach ($newsOnPage as $item)
                    <div class="bg-white border-2 border-gray-100 flex flex-col h-[350px] rounded">
                        <div class="relative flex-shrink-0 h-40">
                            <img src="{{ asset($item['image']) }}" class="w-full h-full object-cover" alt="News Image">
                            <p
                                class="absolute bottom-2 left-2 text-white text-[10px] uppercase font-bold bg-gray-800 px-2 py-1">
                                {{ $item['date'] }}
                            </p>
                        </div>
                        <div class="p-4 flex flex-col flex-grow">
                            <h5 class="text-md font-bold mb-2 line-clamp-2">
                                <a href="{{ $item['link'] }}" class="text-blue-800 hover:text-blue-600">{{ $item['title'] }}</a>
                            </h5>
                            <p class="text-gray-600 line-clamp-3 text-xs">{{ $item['excerpt'] }}</p>
                            <div class="mt-auto pt-3 border-t border-gray-100">
                                <a href="{{ $item['link'] }}"
                                    class="text-xs font-bold text-blue-600 hover:text-blue-800 uppercase text-decoration-none">
                                    Chi tiết &raquo;
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @php
                $news = new \Illuminate\Pagination\LengthAwarePaginator($newsOnPage, $total, $perPage, $page, [
                    'path' => request()->url(),
                    'pageName' => 'page',
                ]);
            @endphp
            <div class="mt-8 pagination-container">
                {{ $news->links() }}
            </div>


        </div>
    </div>
    </div>

@endsection