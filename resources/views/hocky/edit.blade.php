@extends('layouts.main-admin')

@section('title', 'Chỉnh Sửa Học kỳ')

@section('content')
    <div class="container mx-auto p-4">
        <!-- Header section with title and button -->
        <div class="flex justify-between items-center text-white p-4 rounded-md shadow-md mb-8"
            style="background-color: #002244">
            <h2 class="text-2xl font-semibold uppercase tracking-wider">Chỉnh Sửa Học kỳ</h2>
            <a href="{{ route('hocky.index') }}"
                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md shadow-md">
                <i class="fas fa-arrow-left mr-2"></i> Trở về danh sách
            </a>
        </div>

        @if (session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Có lỗi xảy ra!',
                    text: '{{ session('error') }}',
                    showConfirmButton: true,
                });
            </script>
        @endif

        <div class="flex justify-center">
            <div class="w-full max-w-5xl">
                <div class="bg-white shadow-xl rounded-lg overflow-hidden border border-gray-100">
                    <div class="p-8">
                        <form action="{{ route('hocky.update', $hocky->mahocky) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Mã Học kỳ -->
                                <div class="mb-4">
                                    <label for="mahocky" class="block text-gray-700 font-bold mb-2">Mã Học kỳ</label>
                                    <input type="text" name="mahocky" id="mahocky"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        value="{{ $hocky->mahocky }}" required>
                                </div>

                                <!-- Tên Học kỳ -->
                                <div class="mb-4">
                                    <label for="tenhocky" class="block text-gray-700 font-bold mb-2">Tên Học kỳ</label>
                                    <input type="text" name="tenhocky" id="tenhocky"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        value="{{ $hocky->tenhocky }}" required>
                                </div>

                                @php
                                    $currentYear = date('Y'); // Năm hiện tại
                                    $years = [
                                        $currentYear - 1, // Năm ngoái
                                        $currentYear, // Năm hiện tại
                                        $currentYear + 1, // Năm tiếp theo
                                        $currentYear + 2, // 2 năm tiếp theo
                                        $currentYear + 3, // 3 năm tiếp theo
                                    ];
                                @endphp

                                <!-- Năm học -->
                                <div class="mb-4">
                                    <label for="namhoc" class="block text-gray-700 font-bold mb-2">Năm học:</label>
                                    <select name="namhoc" id="namhoc"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white">
                                        @foreach ($years as $year)
                                            <option value="{{ $year }}" {{ old('namhoc', $hocky->namhoc) == $year ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Trạng thái -->
                                <div class="mb-4">
                                    <label for="trangthai" class="block text-gray-700 font-bold mb-2">Trạng thái:</label>
                                    <select name="trangthai" id="trangthai"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white">
                                        <option value="0" {{ old('trangthai', $hocky->trangthai) == 0 ? 'selected' : '' }}>
                                            Đã đóng</option>
                                        <option value="1" {{ old('trangthai', $hocky->trangthai) == 1 ? 'selected' : '' }}>
                                            Đang
                                            mở</option>
                                    </select>
                                </div>

                                <!-- Ngày bắt đầu -->
                                <div class="mb-4">
                                    <label for="ngaybatdau" class="block text-gray-700 font-bold mb-2">Ngày bắt đầu:</label>
                                    <input type="date"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        id="ngaybatdau" name="ngaybatdau" value="{{ $hocky->ngaybatdau }}">
                                </div>

                                <!-- Ngày kết thúc -->
                                <div class="mb-4">
                                    <label for="ngayketthuc" class="block text-gray-700 font-bold mb-2">Ngày kết
                                        thúc:</label>
                                    <input type="date"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        id="ngayketthuc" name="ngayketthuc" value="{{ $hocky->ngayketthuc }}">
                                </div>
                            </div>

                            <div class="mt-8 flex justify-center">
                                <button type="submit"
                                    class="w-full md:w-1/2 bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg shadow-lg uppercase tracking-wide">
                                    <i class="fas fa-save mr-2"></i> Cập Nhật
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection