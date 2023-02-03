<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Kanobon - {{ $title ?? '' }}</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <style>
        ::-webkit-scrollbar {
            width: 0
        }
    </style>
</head>

<body>
    <div class="flex flex-col h-screen overflow-hidden bg-slate-800">
        <nav class="bg-white h-16 dark:bg-gray-900 border-gray-200 dark:border-gray-600">
            <div class="h-full p-4">
                <h1 class="flex items-center">
                    <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">{{ $title
                        }}</span>
                </h1>
            </div>
        </nav>
        <div class="flex flex-1 overflow-y-scroll relative">
            <aside class="w-14 flex flex-col sticky left-0 top-0">
                <nav class="flex-1 bg-gray-900 text-white">
                    <div class="h-full  bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                        <a class="grid place-items-center hover:bg-slate-600 py-4" href="{{ url('') }}">
                            <x-icons.desktop-computer />
                        </a>
                        <a class="grid place-items-center hover:bg-slate-600 py-4" href="{{ url('dashboard') }}">
                            <x-icons.home />
                        </a>
                        <a class="grid place-items-center hover:bg-slate-600 py-4" href="{{ url('produk') }}">
                            <x-icons.archive />
                        </a>
                        <a class="grid place-items-center hover:bg-slate-600 py-4" href="{{ url('tambah-produk') }}">
                            <x-icons.plus />
                        </a>
                        <a class="grid place-items-center hover:bg-slate-600 py-4"
                            href="{{ url('riwayat-transaksi') }}">
                            <x-icons.clock />
                        </a>
                        <a class="grid place-items-center hover:bg-slate-600 py-4"
                            href="{{ url('laporan-penjualan') }}">
                            <x-icons.document />
                        </a>
                    </div>
                </nav>
            </aside>
            <main class="flex-1 flex flex-col">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>