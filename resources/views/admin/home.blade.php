@extends('layouts.main-admin')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <div class="flex items-center justify-between mb-8 border-b-2 border-gray-200 pb-4">
            <h3 class="text-2xl font-bold text-blue-900 uppercase">Hệ thống Dashboard</h3>
            <span class="text-sm font-bold text-gray-600 bg-gray-100 px-3 py-1 border border-gray-300 rounded-md">
                <i class="far fa-calendar-alt mr-1"></i> {{ now()->format('d/m/Y') }}
            </span>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
            <div class="bg-white border-2 border-gray-100 p-4 flex items-center rounded-lg">
                <div class="bg-blue-900 text-white w-12 h-12 flex items-center justify-center mr-4 rounded-md">
                    <i class="fas fa-user-graduate text-xl"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase">Sinh viên</p>
                    <h4 class="text-xl font-bold text-gray-800">{{ $stats['total_students'] }}</h4>
                </div>
            </div>

            <div class="bg-white border-2 border-gray-100 p-4 flex items-center rounded-lg">
                <div class="bg-purple-700 text-white w-12 h-12 flex items-center justify-center mr-4 rounded-md">
                    <i class="fas fa-book text-xl"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase">Môn học</p>
                    <h4 class="text-xl font-bold text-gray-800">{{ $stats['total_courses'] }}</h4>
                </div>
            </div>

            <div class="bg-white border-2 border-gray-100 p-4 flex items-center rounded-lg">
                <div class="bg-green-700 text-white w-12 h-12 flex items-center justify-center mr-4 rounded-md">
                    <i class="fas fa-university text-xl"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase">Khoa</p>
                    <h4 class="text-xl font-bold text-gray-800">{{ $stats['total_khoas'] }}</h4>
                </div>
            </div>

            <div class="bg-white border-2 border-gray-100 p-4 flex items-center rounded-lg">
                <div class="bg-yellow-600 text-white w-12 h-12 flex items-center justify-center mr-4 rounded-md">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase">Lớp học</p>
                    <h4 class="text-xl font-bold text-gray-800">{{ $stats['total_classes'] }}</h4>
                </div>
            </div>

            <div class="bg-white border-2 border-gray-100 p-4 flex items-center rounded-lg">
                <div class="bg-red-700 text-white w-12 h-12 flex items-center justify-center mr-4 rounded-md">
                    <i class="fas fa-edit text-xl"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase">Đăng ký</p>
                    <h4 class="text-xl font-bold text-gray-800">{{ $stats['total_registrations'] }}</h4>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Hot Courses List -->
            <div class="bg-white border-2 border-gray-100 p-6 rounded-lg">
                <div class="flex items-center justify-between mb-6 border-b border-gray-100 pb-3">
                    <h5 class="text-md font-bold text-blue-900 uppercase">Môn học phổ biến</h5>
                    <a href="{{ route('monhoc.index') }}" class="text-blue-600 text-xs font-bold hover:underline">XEM TẤT CẢ</a>
                </div>
                <div class="space-y-4">
                    @foreach($hot_courses as $monhoc)
                        <div class="flex items-center p-2 border-b border-gray-50 last:border-0 hover:bg-gray-50 rounded-md">
                            <div class="w-8 h-8 bg-gray-100 flex items-center justify-center text-blue-900 font-bold mr-3 text-sm rounded">
                                {{ substr($monhoc->tenmonhoc, 0, 1) }}
                            </div>
                            <div class="flex-grow">
                                <h6 class="text-sm font-bold text-gray-800">{{ $monhoc->tenmonhoc }}</h6>
                                <p class="text-[10px] text-gray-500 uppercase">{{ $monhoc->giangvien }}</p>
                            </div>
                            <div class="text-right">
                                <span class="text-[10px] font-bold text-blue-700">
                                    {{ $monhoc->dadangky }} / {{ $monhoc->soluongsinhvien }} SV
                                </span>
                                <div class="w-20 bg-gray-200 h-1.5 mt-1">
                                    @if($monhoc->soluongsinhvien > 0)
                                        <div class="bg-blue-900 h-1.5" style="width: {{ ($monhoc->dadangky / $monhoc->soluongsinhvien) * 100 }}%"></div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Quick Actions & Khoa Stats -->
            <div class="space-y-6">
                <div class="bg-white border-2 border-gray-100 p-6 rounded-lg">
                    <h5 class="text-md font-bold text-blue-900 uppercase mb-6 border-b border-gray-100 pb-3">Thao tác nhanh</h5>
                    <div class="grid grid-cols-2 gap-4">
                        <a href="{{ route('sinhvien.create') }}" class="flex flex-col items-center justify-center p-4 border-2 border-dashed border-gray-200 hover:bg-gray-50 group rounded-lg">
                            <i class="fas fa-user-plus text-xl mb-2 text-gray-400"></i>
                            <span class="text-xs font-bold text-gray-600">Thêm sinh viên</span>
                        </a>
                        <a href="{{ route('monhoc.create') }}" class="flex flex-col items-center justify-center p-4 border-2 border-dashed border-gray-200 hover:bg-gray-50 group rounded-lg">
                            <i class="fas fa-folder-plus text-xl mb-2 text-gray-400"></i>
                            <span class="text-xs font-bold text-gray-600">Thêm môn học</span>
                        </a>
                    </div>
                </div>

                <div class="bg-white border-2 border-gray-100 p-6 rounded-lg">
                    <h5 class="text-md font-bold text-blue-900 uppercase mb-6 border-b border-gray-100 pb-3">Phân bổ sinh viên</h5>
                    <div class="space-y-4">
                        @foreach($registrations_by_khoa as $khoa)
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-gray-600 uppercase">{{ $khoa->tenkhoa }}</span>
                                <div class="flex items-center flex-grow mx-4">
                                    <div class="w-full bg-gray-100 h-2">
                                        @php
                                            $percentage = $stats['total_students'] > 0 ? ($khoa->sinhviens_count / $stats['total_students']) * 100 : 0;
                                        @endphp
                                        <div class="bg-blue-800 h-2" style="width: {{ $percentage }}%"></div>
                                    </div>
                                </div>
                                <span class="text-xs font-bold text-gray-800">{{ $khoa->sinhviens_count }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection
