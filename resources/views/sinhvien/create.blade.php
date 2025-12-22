@extends('layouts.main-admin')
@section('title', 'Thêm sinh viên')

@section('content')
    <div class="container mx-auto p-4">
        <!-- Header section with title and button -->
        <div class="flex justify-between items-center text-white p-4 rounded-md shadow-md mb-8"
            style="background-color: #002244">
            <h2 class="text-2xl font-semibold uppercase tracking-wider">Thêm Sinh Viên Mới</h2>
            <a href="{{ route('sinhvien.index') }}"
                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md shadow-md">
                <i class="fas fa-arrow-left mr-2"></i> Trở về danh sách
            </a>
        </div>

        <div class="flex justify-center">
            <div class="w-full max-w-4xl">
                <div class="bg-white shadow-xl rounded-lg overflow-hidden border border-gray-100">
                    <div class="p-8">
                        <form action="{{ route('sinhvien.store') }}" method="post">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Mã số sinh viên -->
                                <div class="mb-4">
                                    <label for="mssv" class="block text-gray-700 font-bold mb-2">Mã số sinh viên:</label>
                                    <input type="text" name="mssv" id="mssv" placeholder="Nhập MSSV"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        value="{{ old('mssv') }}" required>
                                    @error('mssv')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Mật khẩu -->
                                <div class="mb-4">
                                    <label for="password" class="block text-gray-700 font-bold mb-2">Mật khẩu:</label>
                                    <input type="password" name="password" id="password" placeholder="Nhập mật khẩu"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        required>
                                    @error('password')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Họ tên -->
                                <div class="mb-4">
                                    <label for="hoten" class="block text-gray-700 font-bold mb-2">Họ tên:</label>
                                    <input type="text" name="hoten" id="hoten" placeholder="Nhập họ và tên"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        value="{{ old('hoten') }}" required>
                                    @error('hoten')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Ngày sinh -->
                                <div class="mb-4">
                                    <label for="ngaysinh" class="block text-gray-700 font-bold mb-2">Ngày sinh:</label>
                                    <input type="date" name="ngaysinh" id="ngaysinh"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        value="{{ old('ngaysinh') }}" required>
                                    @error('ngaysinh')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Giới tính -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-bold mb-4">Giới tính:</label>
                                    <div class="flex items-center space-x-6">
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="radio" name="gioitinh" value="Nam" id="nam"
                                                class="form-radio h-5 w-5 text-blue-600" {{ old('gioitinh') == 'Nam' ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700">Nam</span>
                                        </label>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="radio" name="gioitinh" value="Nữ" id="nu"
                                                class="form-radio h-5 w-5 text-pink-600" {{ old('gioitinh') == 'Nữ' ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700">Nữ</span>
                                        </label>
                                    </div>
                                    @error('gioitinh')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Khoa -->
                                <div class="mb-4">
                                    <label for="makhoa" class="block text-gray-700 font-bold mb-2">Khoa:</label>
                                    <select name="makhoa" id="makhoa"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white"
                                        required>
                                        <option value="">Chọn khoa</option>
                                        @foreach ($khoas as $khoa)
                                            <option value="{{ $khoa->makhoa }}" {{ old('makhoa') == $khoa->makhoa ? 'selected' : '' }}>{{ $khoa->tenkhoa }}</option>
                                        @endforeach
                                    </select>
                                    @error('makhoa')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Lớp -->
                                <div class="mb-4">
                                    <label for="malop" class="block text-gray-700 font-bold mb-2">Lớp:</label>
                                    <select name="malop" id="malop"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white"
                                        required>
                                        <option value="">Chọn lớp</option>
                                    </select>
                                    @error('malop')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Quê quán -->
                                <div class="mb-4">
                                    <label for="quequan" class="block text-gray-700 font-bold mb-2">Quê quán:</label>
                                    <input type="text" name="quequan" id="quequan" placeholder="Nhập quê quán"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        value="{{ old('quequan') }}" required>
                                    @error('quequan')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Học kỳ nhập học -->
                                <div class="mb-4 col-span-1 md:col-span-2">
                                    <label for="mahocky" class="block text-gray-700 font-bold mb-2">Học kỳ nhập học:</label>
                                    <select name="mahocky" id="mahocky"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white"
                                        required>
                                        <option value="">Chọn học kỳ</option>
                                        @foreach ($hockys as $hocky)
                                            <option value="{{ $hocky->mahocky }}" {{ old('mahocky') == $hocky->mahocky ? 'selected' : '' }}>
                                                {{ $hocky->tenhocky }} - {{ $hocky->namhoc }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('mahocky')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-8 flex justify-center">
                                <button type="submit"
                                    class="w-full md:w-1/2 bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg shadow-lg uppercase tracking-wide">
                                    <i class="fas fa-plus-circle mr-2"></i> Thêm Sinh Viên
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('makhoa').addEventListener('change', function () {
            var makhoa = this.value;
            var malopSelect = document.getElementById('malop');
            malopSelect.innerHTML = '<option value="">Chọn lớp</option>'; // Clear previous options

            if (makhoa) {
                // Show loading state if needed
                fetch(`/getLops/${makhoa}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(lop => {
                            var option = document.createElement('option');
                            option.value = lop.malop;
                            option.text = lop.tenlop;
                            @if(old('malop'))
                                if (lop.malop == "{{ old('malop') }}") {
                                    option.selected = true;
                                }
                            @endif
                            malopSelect.appendChild(option);
                        });
                    });
            }
        });

        // Trigger change on page load if makhoa has a value (e.g., from old input)
        window.addEventListener('load', function () {
            var makhoaSelect = document.getElementById('makhoa');
            if (makhoaSelect.value) {
                makhoaSelect.dispatchEvent(new Event('change'));
            }
        });
    </script>
@endsection