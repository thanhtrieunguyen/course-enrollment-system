@extends('layouts.main-admin')

@section('title', 'Thêm Môn Học')

@section('content')
    <div class="container mx-auto p-4">
        <!-- Header section with title and button -->
        <div class="flex justify-between items-center text-white p-4 rounded-md shadow-md mb-8"
            style="background-color: #002244">
            <h2 class="text-2xl font-semibold uppercase tracking-wider">Thêm Môn Học</h2>
            <a href="{{ route('monhoc.index') }}"
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
            <div class="w-full max-w-5xl">
                <div class="bg-white shadow-xl rounded-lg overflow-hidden border border-gray-100">
                    <div class="p-8">
                        <form action="{{ route('monhoc.store') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Mã Môn Học -->
                                <div class="mb-4">
                                    <label for="mamonhoc" class="block text-gray-700 font-bold mb-2">Mã Môn Học</label>
                                    <input type="text" name="mamonhoc" id="mamonhoc" placeholder="Nhập mã môn học"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        value="{{ old('mamonhoc') }}">
                                </div>

                                <!-- Tên Môn Học -->
                                <div class="mb-4">
                                    <label for="tenmonhoc" class="block text-gray-700 font-bold mb-2">Tên Môn Học</label>
                                    <input type="text" name="tenmonhoc" id="tenmonhoc" placeholder="Nhập tên môn học"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        value="{{ old('tenmonhoc') }}">
                                </div>

                                <!-- Giảng Viên -->
                                <div class="mb-4">
                                    <label for="giangvien" class="block text-gray-700 font-bold mb-2">Giảng Viên</label>
                                    <input type="text" name="giangvien" id="giangvien" placeholder="Nhập tên giảng viên"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        value="{{ old('giangvien') }}">
                                </div>

                                <!-- Số Tín Chỉ -->
                                <div class="mb-4">
                                    <label for="sotinchi" class="block text-gray-700 font-bold mb-2">Số Tín Chỉ</label>
                                    <input type="number" name="sotinchi" id="sotinchi" placeholder="Nhập số tín chỉ"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        value="{{ old('sotinchi') }}">
                                </div>

                                <!-- Số Lượng Sinh Viên -->
                                <div class="mb-4">
                                    <label for="soluongsinhvien" class="block text-gray-700 font-bold mb-2">Số Lượng Sinh
                                        Viên</label>
                                    <input type="number" name="soluongsinhvien" id="soluongsinhvien"
                                        placeholder="Nhập số lượng sinh viên"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        value="{{ old('soluongsinhvien') }}">
                                </div>

                                <!-- Khoa -->
                                <div class="mb-4">
                                    <label for="makhoa" class="block text-gray-700 font-bold mb-2">Khoa:</label>
                                    <select name="makhoa" id="makhoa"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white">
                                        <option value="">Chọn khoa</option>
                                        @foreach ($khoas as $khoa)
                                            <option value="{{ $khoa->makhoa }}" {{ old('makhoa') == $khoa->makhoa ? 'selected' : '' }}>{{ $khoa->tenkhoa }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Học kỳ -->
                                <div class="mb-4">
                                    <label for="mahocky" class="block text-gray-700 font-bold mb-2">Học kỳ:</label>
                                    <select name="mahocky" id="mahocky"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white">
                                        <option value="">Chọn học kỳ</option>
                                        @foreach ($hockys as $hocky)
                                            <option value="{{ $hocky->mahocky }}" {{ old('mahocky') == $hocky->mahocky ? 'selected' : '' }}>{{ $hocky->tenhocky }} - Năm học {{ $hocky->namhoc }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Lịch Học (Full width) -->
                            <div class="mb-6 mt-4 border-t pt-4">
                                <div class="flex justify-between items-center mb-4">
                                    <label for="lichhoc" class="block text-gray-700 font-bold text-lg">Lịch Học</label>
                                    <button type="button"
                                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold px-4 py-2 rounded shadow transition-colors"
                                        id="addScheduleRow">
                                        <i class="fas fa-plus mr-1"></i> Thêm lịch học
                                    </button>
                                </div>

                                <div id="scheduleContainer" class="space-y-3">
                                    <!-- Các hàng lịch học sẽ được thêm vào đây bằng JavaScript -->
                                </div>

                            </div>

                            <input type="hidden" name="lichhoc" id="lichhocJson">

                            <div class="mt-8 flex justify-center">
                                <button type="submit"
                                    class="w-full md:w-1/2 bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg shadow-lg uppercase tracking-wide">
                                    <i class="fas fa-save mr-2"></i> Lưu Môn Học
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const scheduleContainer = document.getElementById('scheduleContainer');
            const addButton = document.getElementById('addScheduleRow');
            const lichhocJsonInput = document.getElementById('lichhocJson');

            addButton.addEventListener('click', addScheduleRow);

            function addScheduleRow() {
                const row = document.createElement('div');
                row.className = 'schedule-row flex flex-wrap md:flex-nowrap items-center gap-4 p-3 bg-gray-50 rounded-lg border border-gray-200';
                row.innerHTML = `
                        <div class="w-full md:w-1/4">
                            <label class="block text-xs font-semibold text-gray-600 mb-1">Thứ</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" name="day">
                                <option value="2">Thứ 2</option>
                                <option value="3">Thứ 3</option>
                                <option value="4">Thứ 4</option>
                                <option value="5">Thứ 5</option>
                                <option value="6">Thứ 6</option>
                                <option value="7">Thứ 7</option>
                                 <option value="8">Chủ nhật</option>
                            </select>
                        </div>
                        <div class="w-full md:w-1/3">
                            <label class="block text-xs font-semibold text-gray-600 mb-1">Bắt đầu</label>
                            <input type="time" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" name="start_time">
                        </div>
                        <div class="w-full md:w-1/3">
                            <label class="block text-xs font-semibold text-gray-600 mb-1">Kết thúc</label>
                            <input type="time" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" name="end_time">
                        </div>
                        <div class="w-full md:w-auto flex items-end">
                             <button type="button" class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded shadow mb-0.5 remove-row transition-colors">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    `;
                scheduleContainer.appendChild(row);

                row.querySelector('.remove-row').addEventListener('click', function () {
                    scheduleContainer.removeChild(row);
                    updateLichhocJson();
                });

                updateLichhocJson();
            }

            function updateLichhocJson() {
                const rows = scheduleContainer.querySelectorAll('.schedule-row');
                const scheduleData = Array.from(rows).map(row => {
                    return {
                        day: row.querySelector('[name="day"]').value,
                        start_time: row.querySelector('[name="start_time"]').value,
                        end_time: row.querySelector('[name="end_time"]').value
                    };
                });
                lichhocJsonInput.value = JSON.stringify(scheduleData);
            }

            scheduleContainer.addEventListener('change', updateLichhocJson);

            // Thêm một hàng lịch học mặc định nếu chưa có (tùy chọn, remove nếu không muốn mặc định 1 dòng)
            if (scheduleContainer.children.length === 0) {
                addScheduleRow();
            }
        });
    </script>
@endsection