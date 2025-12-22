@extends('layouts.main-admin')

@section('title', 'Chỉnh sửa sinh viên')

@section('content')
    <div class="container mx-auto p-4">
        <!-- Header section with title and button -->
        <div class="flex justify-between items-center text-white p-4 rounded-md shadow-md mb-8"
            style="background-color: #002244">
            <h2 class="text-2xl font-semibold uppercase tracking-wider">Chỉnh Sửa Thông Tin Sinh Viên</h2>
            <a href="{{ route('sinhvien.index') }}"
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
            <div class="w-full max-w-4xl">
                <div class="bg-white shadow-xl rounded-lg overflow-hidden border border-gray-100">
                    <div class="p-8">
                        <form method="post" action="{{ route('sinhvien.update', $sinhvien->mssv) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="updated_at" value="{{ $sinhvien->updated_at }}">

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Mã số sinh viên -->
                                <div class="mb-4">
                                    <label for="mssv" class="block text-gray-700 font-bold mb-2">Mã số sinh viên:</label>
                                    <input type="text" id="mssv" name="mssv" placeholder="Nhập MSSV"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        value="{{ $sinhvien->mssv }}" required>
                                    @error('mssv')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Họ tên -->
                                <div class="mb-4">
                                    <label for="hoten" class="block text-gray-700 font-bold mb-2">Họ tên:</label>
                                    <input type="text" id="hoten" name="hoten" placeholder="Nhập họ và tên"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        value="{{ $sinhvien->hoten }}" required>
                                    @error('hoten')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Ngày sinh -->
                                <div class="mb-4">
                                    <label for="ngaysinh" class="block text-gray-700 font-bold mb-2">Ngày sinh:</label>
                                    <input type="date" id="ngaysinh" name="ngaysinh"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        value="{{ $sinhvien->ngaysinh }}" required>
                                    @error('ngaysinh')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Giới tính -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-bold mb-4">Giới tính:</label>
                                    <div class="flex items-center space-x-6">
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="radio" id="nam" name="gioitinh" value="Nam" class="form-radio h-5 w-5 text-blue-600"
                                                {{ $sinhvien->gioitinh == 'Nam' ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700">Nam</span>
                                        </label>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="radio" id="nu" name="gioitinh" value="Nữ" class="form-radio h-5 w-5 text-pink-600"
                                                {{ $sinhvien->gioitinh == 'Nữ' ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700">Nữ</span>
                                        </label>
                                    </div>
                                    @error('gioitinh')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Lớp -->
                                <div class="mb-4">
                                    <label for="lop" class="block text-gray-700 font-bold mb-2">Lớp:</label>
                                    <select name="lop" id="lop"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white"
                                        required>
                                        @foreach ($lops as $lop)
                                            <option value="{{ $lop->malop }}" {{ $sinhvien->malop == $lop->malop ? 'selected' : '' }}>
                                                {{ $lop->tenlop }} - Khoa: {{ $lop->khoa->tenkhoa }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('lop')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Quê quán -->
                                <div class="mb-4">
                                    <label for="quequan" class="block text-gray-700 font-bold mb-2">Quê quán:</label>
                                    <input type="text" id="quequan" name="quequan" placeholder="Nhập quê quán"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                        value="{{ $sinhvien->quequan }}" required>
                                    @error('quequan')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-8 flex justify-center">
                                <button type="submit"
                                    class="w-full md:w-1/2 bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg shadow-lg uppercase tracking-wide">
                                    <i class="fas fa-save mr-2"></i> Lưu thay đổi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


