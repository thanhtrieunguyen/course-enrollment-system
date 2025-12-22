@extends('layouts.main-admin')

@section('title', 'Chỉnh Sửa Môn Học')

@section('content')
<div class="container mx-auto p-4">
    <!-- Header section with title and button -->
    <div class="flex justify-between items-center text-white p-4 rounded-md shadow-md mb-8"
        style="background-color: #002244">
        <h2 class="text-2xl font-semibold uppercase tracking-wider">Chỉnh Sửa Môn Học</h2>
        <a href="{{ route('monhoc.index') }}"
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
                    <form action="{{ route('monhoc.update', $monhoc->mamonhoc) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Mã Môn Học -->
                            <div class="mb-4">
                                <label for="mamonhoc" class="block text-gray-700 font-bold mb-2">Mã Môn Học</label>
                                <input type="text" name="mamonhoc" id="mamonhoc" placeholder="Nhập mã môn học"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    value="{{ $monhoc->mamonhoc }}" required>
                            </div>

                            <!-- Tên Môn Học -->
                            <div class="mb-4">
                                <label for="tenmonhoc" class="block text-gray-700 font-bold mb-2">Tên Môn Học</label>
                                <input type="text" name="tenmonhoc" id="tenmonhoc" placeholder="Nhập tên môn học"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    value="{{ $monhoc->tenmonhoc }}" required>
                            </div>

                            <!-- Giảng Viên -->
                            <div class="mb-4">
                                <label for="giangvien" class="block text-gray-700 font-bold mb-2">Giảng Viên</label>
                                <input type="text" name="giangvien" id="giangvien" placeholder="Nhập tên giảng viên"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    value="{{ $monhoc->giangvien }}" required>
                            </div>

                            <!-- Số Tín Chỉ -->
                            <div class="mb-4">
                                <label for="sotinchi" class="block text-gray-700 font-bold mb-2">Số Tín Chỉ</label>
                                <input type="number" name="sotinchi" id="sotinchi" placeholder="Nhập số tín chỉ"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    value="{{ $monhoc->sotinchi }}" required>
                            </div>

                            <!-- Số Lượng Sinh Viên -->
                            <div class="mb-4">
                                <label for="soluongsinhvien" class="block text-gray-700 font-bold mb-2">Số Lượng Sinh Viên</label>
                                <input type="number" name="soluongsinhvien" id="soluongsinhvien" placeholder="Nhập số lượng sinh viên"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    value="{{ $monhoc->soluongsinhvien }}" required>
                            </div>

                            <!-- Khoa -->
                            <div class="mb-4">
                                <label for="makhoa" class="block text-gray-700 font-bold mb-2">Khoa:</label>
                                <select name="makhoa" id="makhoa"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white">
                                    <option value="">Chọn khoa</option>
                                    @foreach ($khoas as $khoa)
                                        <option value="{{ $khoa->makhoa }}"
                                            {{ $monhoc->makhoa == $khoa->makhoa ? 'selected' : '' }}>
                                            {{ $khoa->tenkhoa }}</option>
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
                                        <option value="{{ $hocky->mahocky }}"
                                            {{ $monhoc->mahocky == $hocky->mahocky ? 'selected' : '' }}>
                                            {{ $hocky->tenhocky }} - Năm học {{ $hocky->namhoc }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                         <!-- Lịch Học (Full width) -->
                         <div class="mb-6 mt-4 border-t pt-4">
                            <div class="flex justify-between items-center mb-4">
                                <div class="flex items-center">
                                    <label class="block text-gray-700 font-bold text-lg mr-6">Lịch Học</label>
                                    <div class="inline-flex items-center">
                                         <label class="inline-flex items-center cursor-pointer relative">
                                            <input type="checkbox" id="noSchedule" name="noSchedule" class="sr-only peer" {{ $monhoc->lichhoc === null ? 'checked' : '' }}>
                                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                            <span class="ml-3 text-sm font-medium text-gray-700">Không có lịch học</span>
                                          </label>
                                    </div>
                                </div>
                                <button type="button" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold px-4 py-2 rounded shadow transition-colors" id="addScheduleRow">
                                    <i class="fas fa-plus mr-1"></i> Thêm lịch học
                                </button>
                            </div>
                            
                            <div id="scheduleContainer" class="space-y-3" {{ $monhoc->lichhoc === null ? 'style=display:none;' : '' }}>
                                <!-- Các hàng lịch học sẽ được thêm vào đây bằng JavaScript -->
                            </div>
                            
                        </div>


                        <input type="hidden" name="lichhoc" id="lichhocJson">

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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const scheduleContainer = document.getElementById('scheduleContainer');
        const addButton = document.getElementById('addScheduleRow');
        const lichhocJsonInput = document.getElementById('lichhocJson');
        const noScheduleCheckbox = document.getElementById('noSchedule');
        
        const removeButton = document.querySelector('.remove-row');
        if(removeButton){
             removeButton.addEventListener('click', function() {
                // Logic removal
             });
        }

        // Hàm để thêm hàng lịch học mới
        function addScheduleRow(day = '', startTime = '', endTime = '') {
            const row = document.createElement('div');
            row.className = 'schedule-row flex flex-wrap md:flex-nowrap items-center gap-4 p-3 bg-gray-50 rounded-lg border border-gray-200';
            row.innerHTML = `
        <div class="w-full md:w-1/4">
            <label class="block text-xs font-semibold text-gray-600 mb-1">Thứ</label>
            <select class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" name="day">
                <option value="2" ${day === '2' ? 'selected' : ''}>Thứ 2</option>
                <option value="3" ${day === '3' ? 'selected' : ''}>Thứ 3</option>
                <option value="4" ${day === '4' ? 'selected' : ''}>Thứ 4</option>
                <option value="5" ${day === '5' ? 'selected' : ''}>Thứ 5</option>
                <option value="6" ${day === '6' ? 'selected' : ''}>Thứ 6</option>
                <option value="7" ${day === '7' ? 'selected' : ''}>Thứ 7</option>
                <option value="8" ${day === '8' ? 'selected' : ''}>Chủ nhật</option>
            </select>
        </div>
        <div class="w-full md:w-1/3">
            <label class="block text-xs font-semibold text-gray-600 mb-1">Bắt đầu</label>
            <input type="time" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" name="start_time" value="${startTime}">
        </div>
        <div class="w-full md:w-1/3">
             <label class="block text-xs font-semibold text-gray-600 mb-1">Kết thúc</label>
            <input type="time" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" name="end_time" value="${endTime}">
        </div>
        <div class="w-full md:w-auto flex items-end">
            <button type="button" class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded shadow mb-0.5 remove-row transition-colors">
                 <i class="fas fa-trash"></i>
            </button>
        </div>
    `;
            scheduleContainer.appendChild(row);

            row.querySelector('.remove-row').addEventListener('click', function() {
                scheduleContainer.removeChild(row);
                updateLichhocJson();
            });

            updateLichhocJson();
        }

        // Hàm để cập nhật trường lichhocJson
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

        noScheduleCheckbox.addEventListener('change', function() {
            if (this.checked) {
                scheduleContainer.style.display = 'none';
                lichhocJsonInput.value = '';
            } else {
                scheduleContainer.style.display = 'block';
                if (scheduleContainer.children.length === 0) {
                    addScheduleRow();
                } else {
                    updateLichhocJson();
                }
            }
        });

        // Thêm sự kiện lắng nghe cho nút "Thêm lịch học"
        addButton.addEventListener('click', () => addScheduleRow());

        // Thêm sự kiện lắng nghe cho các thay đổi trong scheduleContainer
        scheduleContainer.addEventListener('change', updateLichhocJson);

        // Khởi tạo lịch học hiện tại
        const currentSchedule = @json($parsedSchedule);
        if (currentSchedule.length > 0) {
            currentSchedule.forEach(schedule => {
                addScheduleRow(schedule.day, schedule.start_time, schedule.end_time);
            });
        } else if (!noScheduleCheckbox.checked) {
            addScheduleRow(); // Thêm một hàng trống nếu không có lịch học
        }
    });
</script>
@endsection
