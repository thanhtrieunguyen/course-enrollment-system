@extends('layouts.main-admin')

@section('title', 'Thêm mới Học kỳ')

@section('content')
<div class="container mx-auto p-4">
    <!-- Header section with title and button -->
    <div class="flex justify-between items-center text-white p-4 rounded-md shadow-md mb-8"
        style="background-color: #002244">
        <h2 class="text-2xl font-semibold uppercase tracking-wider">Thêm mới Học kỳ</h2>
        <a href="{{ route('hocky.index') }}"
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
                    <form action="{{ route('hocky.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Mã Học kỳ -->
                            <div class="mb-4">
                                <label for="mahocky" class="block text-gray-700 font-bold mb-2">Mã Học kỳ</label>
                                <input type="text" name="mahocky" id="mahocky"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="Nhập mã học kỳ" value="{{ old('mahocky') }}">
                            </div>

                            <!-- Tên Học kỳ -->
                            <div class="mb-4">
                                <label for="tenhocky" class="block text-gray-700 font-bold mb-2">Tên Học kỳ</label>
                                <input type="text" name="tenhocky" id="tenhocky"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="Nhập tên học kỳ" value="{{ old('tenhocky') }}">
                            </div>

                            @php
                                $currentYear = date('Y');
                                $years = [$currentYear - 1, $currentYear, $currentYear + 1, $currentYear + 2];
                            @endphp

                            <!-- Năm học -->
                            <div class="mb-4">
                                <label for="namhoc" class="block text-gray-700 font-bold mb-2">Năm học</label>
                                <select name="namhoc" id="namhoc"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white">
                                    @foreach ($years as $year)
                                        <option value="{{ $year }}"
                                            {{ old('namhoc', $currentYear) == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <!-- Empty div to balance grid if needed, or spans 2 cols -->
                            <div class="hidden md:block"></div>

                            <!-- Ngày bắt đầu -->
                            <div class="mb-4">
                                <label for="ngaybatdau" class="block text-gray-700 font-bold mb-2">Ngày bắt đầu:</label>
                                <input type="date" name="ngaybatdau" id="ngaybatdau"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    value="{{ old('ngaybatdau') }}">
                            </div>

                            <!-- Ngày kết thúc -->
                            <div class="mb-4">
                                <label for="ngayketthuc" class="block text-gray-700 font-bold mb-2">Ngày kết thúc:</label>
                                <input type="date" name="ngayketthuc" id="ngayketthuc"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    value="{{ old('ngayketthuc') }}">
                            </div>
                        </div>

                        <div class="mt-8 flex justify-center">
                            <button type="submit"
                                class="w-full md:w-1/2 bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg shadow-lg uppercase tracking-wide">
                                <i class="fas fa-plus-circle mr-2"></i> Lưu Học Kỳ
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Hàm để tính toán ngày kết thúc là cuối tháng sau 3 tháng
    function setEndDate() {
        var startDate = document.getElementById('ngaybatdau').value;
        if (startDate) {
            var start = new Date(startDate);
            start.setMonth(start.getMonth() + 3); // Cộng 3 tháng

            // Lấy ngày cuối cùng của tháng mới
            var lastDay = new Date(start.getFullYear(), start.getMonth() + 1, 0);

            // Đặt ngày kết thúc vào ô input
            // Cần định dạng lại thành YYYY-MM-DD
             var year = lastDay.getFullYear();
            var month = ("0" + (lastDay.getMonth() + 1)).slice(-2);
            var day = ("0" + lastDay.getDate()).slice(-2);
            var endDate = `${year}-${month}-${day}`;
            
            document.getElementById('ngayketthuc').value = endDate;
        }
    }

    // Lắng nghe sự kiện thay đổi của ngày bắt đầu
    document.getElementById('ngaybatdau').addEventListener('change', setEndDate);

    // Gọi hàm khi trang tải để set ngày kết thúc nếu đã có giá trị ngày bắt đầu
    window.onload = setEndDate;
</script>
@endsection
