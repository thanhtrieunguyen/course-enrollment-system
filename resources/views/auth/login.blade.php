<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('css/util.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box
        }


        .hd-logo .logo-txt {
            font-size: 1.85rem;
            color: #B3995D;
            font-weight: 600;
            line-height: 130%;
            text-transform: uppercase;
            transition: all .4s;
        }
    </style>
    <title>Trang đăng nhập</title>
</head>

<body>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif

    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="rounded-lg shadow-lg p-8 w-full max-w-screen-sm bg-white" style="
                       ">
            <div class="hd-logo flex items-center mb-6 p-2">
                <div
                    class="bg-blue-900 text-white rounded-full w-12 h-12 flex items-center justify-center font-bold text-xl mr-3">
                    {{ substr(config('app.name'), 0, 1) }}
                </div>
                <a class="logo-txt font-second text-blue-900 font-bold text-xl uppercase" href="#">
                    {{ config('app.name') }}
                </a>
            </div>

            <h2 class="mt-4 text-2xl font-semibold text-center text-gray-800">Đăng nhập</h2>

            @if (session('error'))
                <div class="text-red-500 text-center mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <form action="/login" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Mã số sinh viên:</label>
                    <input
                        class="input99 border border-gray-300 rounded w-full p-2 focus:outline-none focus:ring focus:ring-blue-300"
                        type="text" name="mssv" id="mssv" placeholder="Nhập Mã số sinh viên" value="{{ old('mssv')}}"
                        required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Mật khẩu:</label>
                    <input
                        class="input99 border border-gray-300 rounded w-full p-2 focus:outline-none focus:ring focus:ring-blue-300"
                        type="password" name="password" placeholder="Nhập mật khẩu" required>
                </div>

                <div class="flex items-center justify-center mb-4">
                    <input type="submit"
                        class="bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 transition duration-200"
                        name="dangnhap" value="Đăng nhập">
                </div>


            </form>
        </div>
    </div>
</body>

</html>