@inject('carbon', 'Carbon\Carbon')

<x-layout>
  <x-slot:title>
    {{$title}}
    </x-slot>
    <div class="p-4 h-full  flex flex-col">


      <div class="mb-4 flex items-center justify-between">



        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
          class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
          type="button">Month <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor"
            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
          </svg>
        </button>


        <div id="dropdown"
          class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
          <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
            @foreach ($list_bulan as $item)
            <li>
              <a href="#" type="button"
                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                {{$carbon::create()->month($item['bulan'])->format('F')}}
              </a>
            </li>
            @endforeach
          </ul>
        </div>


        <div class="flex gap-2">

          <a href="{{url('/riwayat-transaksi/print')}}" type="button"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            Print
          </a>

          <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button">Download <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor"
              viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
          </button>


          <div id="dropdown"
            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
              <li>
                <a href="{{url('/riwayat-transaksi/download_pdf')}}" type="button"
                  class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">PDF</a>
              </li>
              <li>
                <a href="{{url('/riwayat-transaksi/download_excel')}}" type="button"
                  class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                  Excel</a>
              </li>
            </ul>
          </div>

        </div>


      </div>




      {{-- table --}}
      <div class="relative overflow-x-auto sm:rounded-lg flex-1 flex flex-col justify-between">
        <table class="w-full text-sm text-left text-gray-500 dark:text-white">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
            <tr>
              <th class="p-4"></th>
              <th scope="col" class="px-6 py-3">
                Tanggal Penjualan
              </th>
              <th scope="col" class="px-6 py-3">
                Kode Transaksi
              </th>
              <th scope="col" class="px-6 py-3">
                Subtotal
              </th>
              <th scope="col" class="px-6 py-3">
                Uang Dibayar
              </th>
              <th scope="col" class="px-6 py-3">
                Kembali
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data_riwayat as $index => $value)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
              <td class="p-4">{{ $value['id'] }}</td>
              <td class="px-6 py-4">
                {{$carbon::parse($value['tanggal_penjualan'])->format('d M Y')}}
              </td>
              <td class="px-6 py-4">
                {{$value['kode_transaksi']}}
              </td>
              <td class="px-6 py-4">
                {{$value['harus_dibayar']}}
              </td>
              <td class="px-6 py-4">
                {{$value['uang_dibayar']}}
              </td>
              <td class="px-6 py-4">
                {{$value['kembalian']}}
              </td>
            </tr>
            @endforeach

          </tbody>
        </table>
        <div class="p-4 ">
          {{ $data_riwayat->links() }}
        </div>
      </div>
    </div>
</x-layout>