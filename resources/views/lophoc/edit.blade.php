@extends('layouts.main-admin')

@section('title', 'Chỉnh Sửa Lớp học')

@section('content')
    <div class="container mx-auto p-4">
        <!-- Header section with title and button -->
        <div class="flex justify-between items-center text-white p-4 rounded-md shadow-md mb-8"
            style="background-color: #002244">
            <h2 class="text-2xl font-semibold uppercase tracking-wider">Chỉnh Sửa Lớp học</h2>
            <a href="{{ route('lophoc.index') }}"
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
                        <form action="{{ route('lophoc.update', $lop->malop) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="grid grid-cols-1 gap-6">
                                <!-- Tên Lớp Học -->
                                <div class="mb-4">
                                    <label for="tenlop" class="block text-gray-700 font-bold mb-2">Tên Lớp học</label>
                                    <input type="text" name="tenlop" id="tenlop" placeholder="Nhập tên lớp học"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        value="{{ $lop->tenlop }}" required>
                                </div>


                                <!-- Khoa -->
                                <div class="mb-4">
                                    <label for="makhoa" class="block text-gray-700 font-bold mb-2">Khoa:</label>
                                    <select name="makhoa" id="makhoa"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white">
                                        <option value="">Chọn khoa</option>
                                        @foreach ($khoas as $khoa)
                                            <option value="{{ $khoa->makhoa }}" {{ $lop->makhoa == $khoa->makhoa ? 'selected' : '' }}>
                                                {{ $khoa->tenkhoa }}
                                            </option>
                                        @endforeach
                                    </select>
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