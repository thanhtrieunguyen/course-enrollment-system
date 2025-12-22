@extends('layouts.main-admin')

@section('title', 'Thêm mới Khoa')

@section('content')
    <div class="container mx-auto p-4">
        <!-- Header section with title and button -->
        <div class="flex justify-between items-center text-white p-4 rounded-md shadow-md mb-8"
            style="background-color: #002244">
            <h2 class="text-2xl font-semibold uppercase tracking-wider">Thêm mới Khoa</h2>
            <a href="{{ route('khoa.index') }}"
                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md shadow-md">
                <i class="fas fa-arrow-left mr-2"></i> Trở về danh sách
            </a>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 shadow-md">
                <strong class="font-bold">Oh!</strong> <span class="block sm:inline">Đã có lỗi xảy ra.</span>
                <ul class="list-disc list-inside mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="flex justify-center">
            <div class="w-full max-w-4xl">
                <div class="bg-white shadow-xl rounded-lg overflow-hidden border border-gray-100">
                    <div class="p-8">
                        <form action="{{ route('khoa.store') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-1 gap-6">
                                <!-- Mã Khoa -->
                                <div class="mb-4">
                                    <label for="makhoa" class="block text-gray-700 font-bold mb-2">Mã Khoa</label>
                                    <input type="text" name="makhoa" id="makhoa" placeholder="Nhập mã khoa"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        value="{{ old('makhoa') }}">
                                </div>

                                <!-- Tên Khoa -->
                                <div class="mb-4">
                                    <label for="tenkhoa" class="block text-gray-700 font-bold mb-2">Tên Khoa</label>
                                    <input type="text" name="tenkhoa" id="tenkhoa" placeholder="Nhập tên khoa"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        value="{{ old('tenkhoa') }}">
                                </div>
                            </div>

                            <div class="mt-8 flex justify-center">
                                <button type="submit"
                                    class="w-full md:w-1/2 bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg shadow-lg uppercase tracking-wide">
                                    <i class="fas fa-plus-circle mr-2"></i> Lưu Khoa
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection