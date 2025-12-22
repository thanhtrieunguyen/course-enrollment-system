@extends('layouts.main-admin')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <div class="flex items-center justify-between mb-8">
            <h3 class="text-3xl font-bold text-gray-800 uppercase tracking-wider">Dashboard</h3>
            <span class="text-sm font-medium text-gray-500 bg-white px-4 py-2 rounded-full shadow-sm border border-gray-100">
                <i class="far fa-calendar-alt mr-2 text-blue-500"></i> {{ now()->format('d/m/Y') }}
            </span>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                <div class="rounded-full bg-blue-50 p-4 mr-4 text-blue-600">
                    <i class="fas fa-user-graduate text-2xl"></i>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase">Sinh viên</p>
                    <h4 class="text-2xl font-bold text-gray-800">{{ $stats['total_students'] }}</h4>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                <div class="rounded-full bg-purple-50 p-4 mr-4 text-purple-600">
                    <i class="fas fa-book text-2xl"></i>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase">Môn học</p>
                    <h4 class="text-2xl font-bold text-gray-800">{{ $stats['total_courses'] }}</h4>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                <div class="rounded-full bg-green-50 p-4 mr-4 text-green-600">
                    <i class="fas fa-university text-2xl"></i>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase">Khoa</p>
                    <h4 class="text-2xl font-bold text-gray-800">{{ $stats['total_khoas'] }}</h4>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                <div class="rounded-full bg-yellow-50 p-4 mr-4 text-yellow-600">
                    <i class="fas fa-users text-2xl"></i>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase">Lớp học</p>
                    <h4 class="text-2xl font-bold text-gray-800">{{ $stats['total_classes'] }}</h4>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                <div class="rounded-full bg-red-50 p-4 mr-4 text-red-600">
                    <i class="fas fa-edit text-2xl"></i>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase">Đăng ký</p>
                    <h4 class="text-2xl font-bold text-gray-800">{{ $stats['total_registrations'] }}</h4>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Hot Courses List -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h5 class="text-lg font-bold text-gray-800 capitalize">Môn học đăng ký nhiều nhất</h5>
                    <a href="{{ route('monhoc.index') }}" class="text-blue-500 text-sm font-semibold hover:underline">Tất cả</a>
                </div>
                <div class="space-y-4">
                    @foreach($hot_courses as $monhoc)
                        <div class="flex items-center p-3 rounded-xl hover:bg-gray-50 transition-colors duration-200">
                            <div class="w-10 h-10 rounded-lg bg-indigo-50 flex items-center justify-center text-indigo-600 font-bold mr-4">
                                {{ substr($monhoc->tenmonhoc, 0, 1) }}
                            </div>
                            <div class="flex-grow">
                                <h6 class="text-sm font-bold text-gray-800">{{ $monhoc->tenmonhoc }}</h6>
                                <p class="text-xs text-gray-500">{{ $monhoc->giangvien }}</p>
                            </div>
                            <div class="text-right">
                                <span class="inline-block px-2 py-1 rounded-full bg-blue-100 text-blue-600 text-[10px] font-bold">
                                    {{ $monhoc->dadangky }} / {{ $monhoc->soluongsinhvien }} SV
                                </span>
                                <div class="w-24 bg-gray-100 rounded-full h-1.5 mt-2">
                                    @if($monhoc->soluongsinhvien > 0)
                                        <div class="bg-blue-500 h-1.5 rounded-full" style="width: {{ ($monhoc->dadangky / $monhoc->soluongsinhvien) * 100 }}%"></div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Quick Actions & Khoa Stats -->
            <div class="space-y-8">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h5 class="text-lg font-bold text-gray-800 mb-6 capitalize">Thao tác nhanh</h5>
                    <div class="grid grid-cols-2 gap-4">
                        <a href="{{ route('sinhvien.create') }}" class="flex flex-col items-center justify-center p-4 rounded-xl border border-dashed border-gray-200 hover:border-blue-500 hover:bg-blue-50 transition-all group">
                            <i class="fas fa-user-plus text-2xl mb-2 text-gray-400 group-hover:text-blue-600"></i>
                            <span class="text-sm font-bold text-gray-600 group-hover:text-blue-700">Thêm sinh viên</span>
                        </a>
                        <a href="{{ route('monhoc.create') }}" class="flex flex-col items-center justify-center p-4 rounded-xl border border-dashed border-gray-200 hover:border-green-500 hover:bg-green-50 transition-all group">
                            <i class="fas fa-folder-plus text-2xl mb-2 text-gray-400 group-hover:text-green-600"></i>
                            <span class="text-sm font-bold text-gray-600 group-hover:text-green-700">Thêm môn học</span>
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h5 class="text-lg font-bold text-gray-800 mb-6 capitalize">Phân bổ sinh viên theo khoa</h5>
                    <div class="space-y-4">
                        @foreach($registrations_by_khoa as $khoa)
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-600">{{ $khoa->tenkhoa }}</span>
                                <div class="flex items-center flex-grow mx-4">
                                    <div class="w-full bg-gray-100 rounded-full h-1.5">
                                        @php
                                            $percentage = $stats['total_students'] > 0 ? ($khoa->sinhviens_count / $stats['total_students']) * 100 : 0;
                                        @endphp
                                        <div class="bg-gradient-to-r from-blue-400 to-indigo-500 h-1.5 rounded-full" style="width: {{ $percentage }}%"></div>
                                    </div>
                                </div>
                                <span class="text-sm font-bold text-gray-800">{{ $khoa->sinhviens_count }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection
