@extends('layouts.main-admin')

@section('title', 'Danh sách sinh viên')

@section('content')
    <div class="container min-w-full mx-auto p-4">

        <!-- Header section with title and button -->
        <div class="flex justify-between items-center  text-white p-4 rounded-md shadow-md"
            style="background-color: #002244">
            <h2 class="text-2xl font-semibold">Danh Sách Sinh Viên</h2>
            <a href="{{ route('sinhvien.create') }}"
                class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-md shadow-md">Thêm Sinh
                Viên</a>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-md shadow-md mt-8 p-6">
            <div class="overflow-x-auto">
                <table class=" w-full table-fixed border-collapse border border-gray-200 rounded-md overflow-hidden">
                    <thead>
                        <tr class=" text-white text-left" style="background-color: #002244">
                            <th class="py-3 px-4 w-16">STT</th>
                            <th class="py-3 px-4 w-36">MSSV</th>
                            <th class="py-3 px-4 w-48">Họ tên</th>
                            <th class="py-3 px-4 w-24 text-center">Giới tính</th>
                            <th class="py-3 px-4 w-32">Ngày sinh</th>
                            <th class="py-3 px-4 w-24 text-center">Lớp</th>
                            <th class="py-3 px-4 w-36">Khoa</th>
                            <th class="py-3 px-4 w-48">Quê quán</th>
                            <th class="py-3 px-4 w-24 text-center">Sửa</th>
                            <th class="py-3 px-4 w-24 text-center">Xóa</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-50">
                        @foreach ($sinhviens as $index => $sinhvien)
                            <tr class="border-b border-gray-200 hover:bg-yellow-100 transition-all duration-200">
                                <td class="py-2 px-4 truncate text-center">{{ $index + 1 }}</td>
                                <td class="py-2 px-4 truncate">{{ $sinhvien->mssv }}</td>
                                <td class="py-2 px-4 ">{{ $sinhvien->hoten }}</td>
                                <td class="py-2 px-4 truncate text-center">{{ $sinhvien->gioitinh }}</td>
                                <td class="py-2 px-4 truncate">{{ Carbon\Carbon::parse($sinhvien->ngaysinh)->format('d-m-Y') }}
                                </td>
                                <td class="py-2 px-4 truncate">{{ $sinhvien->lop->tenlop }}</td>
                                <td class="py-2 px-4">{{ $sinhvien->lop->khoa->tenkhoa }}</td>
                                <td class="py-2 px-4 truncate" title="{{ $sinhvien->quequan }}">{{ $sinhvien->quequan }}</td>

                                <td class="py-2 px-4 text-center">
                                    <a href="{{ route('sinhvien.edit', $sinhvien->mssv) }}"
                                        class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded-md">Sửa</a>
                                </td>
                                <td class="py-2 px-4 text-center">
                                    <form action="{{ route('sinhvien.destroy', $sinhvien->mssv) }}" method="POST"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded-md">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="my-4 -mt-4">
                    {{ $sinhviens->links() }}
                </div>
            </div>

        </div>
    </div>

@endsection