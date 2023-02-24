<x-layout>
  <x-slot:title>
    {{$title}}
  </x-slot:title>
  <div class="h-full">
    <div class="flex flex-col p-4 h-full">

      <div class="flex gap-4 mb-4">
        <div
          class="w-40 h-40 p-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 text-white ">
          <x-icons.archive :size="8" />
          <h2 class="text-5xl my-4"> {{ $data_statistik['total_produk'] }}</h2>
          <span class="text-[12px] block">Total Produk</span>
        </div>
        <div
          class="w-40 h-40 p-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 text-white ">
          <x-icons.desktop-computer :size="8" />
          <h2 class="text-5xl my-4"> {{ $data_statistik['transaksi_hari_ini'] }}</h2>
          <span class="text-[12px] block">Transaksi Hari Ini</span>
        </div>
        <div
          class="w-40 h-40 p-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 text-white ">
          <x-icons.exclamation :size="8" />
          <h2 class="text-5xl my-4"> {{ $data_statistik['stok_rendah'] }}</h2>
          <span class="text-[12px] block">Produk Stok Menipis</span>
        </div>
        <div
          class="min-w-[10rem] max-w-lf h-40 p-4 flex flex-col  bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 text-white justify-between">
          <div class="flex flex-col flex-1 mb-4 justify-between overflow-x-hidden">
            <x-icons.currency-dollar size="8" />
            <h2 class="text-5xl truncate"> {{$data_statistik['pemasukan']}} </h2>
          </div>
          <span class="text-[12px] block">Pendapatan Hari ini</span>
        </div>
      </div>

      <div class="flex gap-4 h-full">

        <div
          class="w-[32rem] h-full overflow-y-scroll p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-5 dark:bg-gray-800 dark:border-gray-700">
          <div class="flex items-center justify-between mb-4">
            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Stok Rendah</h5>
            <a href="#" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
              View all
            </a>
          </div>
          <div class="flow-root">
            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
              @foreach ($stok_rendah as $item)
              <li class="py-3 sm:py-4">
                <div class="flex items-center space-x-">
                  <div class="flex-1 min-w-0">
                    <p class="font-medium text-gray-900 truncate dark:text-white">
                      {{ $item['nama_produk'] }}
                    </p>
                  </div>
                  <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                    {{ $item['stok'] }}
                  </div>
                </div>
              </li>
              @endforeach
            </ul>
          </div>
        </div>


        <div class="pr-4 flex-1">
          <div
            class="p-4 bg-white text-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <h1 class="mb-2 text-lg font-semibold">Profile</h1>
            <div>
              <h3 class="mb-2"><span class="w-32 inline-block">Nama Toko</span> : {{ $profile->name }}</h3>
            </div>
            <div>
              <h3 class="mb-2">
                <span class="w-32 inline-block">Alamat</span> : {{ $profile->adress }}
              </h3>
            </div>
            <div>
              <h3 class="mb-2"><span class="w-32 inline-block">No Telp</span> : {{ $profile->contact }}</h3>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
</x-layout>