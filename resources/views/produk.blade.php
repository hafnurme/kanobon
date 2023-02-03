<x-layout>
  <x-slot:title>
    {{$title}}
    </x-slot>
    <div class="p-4 h-full flex flex-col">


      <div class="mb-4 flex justify-between items-center">

        <div class="flex items-center justify-between">
          <div>
            <a href="{{url('/produk/print')}}" type="button"
              class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Print</a>
            <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
              class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
              type="button">Download <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg></button>
          </div>
          <div id="dropdown"
            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
              <li>
                <a href="{{url('/produk/download_pdf')}}" type="button"
                  class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">PDF</a>
              </li>
              <li>
                <a href="{{url('/produk/download_excel')}}" type="button"
                  class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                  Excel</a>
              </li>
            </ul>
          </div>
        </div>

        <div class="sticky top-0 flex gap-2 items-center">
          <a href="{{ url('/produk')  }}" class="bg-gray-700 rounded-lg border border-gray-600 p-2 text-gray-400"
            @click="window.document.location.reload()">
            <x-icons.refresh />
          </a>
          <form action="/produk/search" method="post" class="mb-0">
            @csrf
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative flex gap-2">
              <button type="submit"
                class="absolute z-20 inset-y-0 right-0 flex items-center px-2 border-l border-gray-600 rounded-r-lg  hover:bg-gray-600">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                  viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                    clip-rule="evenodd"></path>
                </svg>
              </button>
              <input type="text" id="table-search" name="item"
                class="block p-2 pl-2 text-sm text-gray-900 border border-gray-300 rounded-lg w-48  sm:w-64 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Search for items">
            </div>
          </form>
        </div>
      </div>




      <div class="relative overflow-x-auto flex-1 flex flex-col justify-between">
        <table class="w-full text-sm text-left text-gray-500 dark:text-white">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
            <tr>
              <th class="p-4"></th>
              <th scope="col" class="px-6 py-3">
                Nama Produk
              </th>
              <th scope="col" class="px-6 py-3">
                Harga Satuan
              </th>
              <th scope="col" class="px-6 py-3">
                Stok
              </th>
              <th scope="col" class="px-6 py-3">
                Stok Minimal
              </th>
              <th scope="col" class="px-6 py-3">
                Satuan
              </th>
              <th scope="col" class="px-6 py-3"> </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data_produk as $index => $value)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
              <td class="p-4">{{ $value['id'] }}</td>
              <td class="px-6 py-4">
                {{$value['nama_produk']}}
              </td>
              <td class="px-6 py-4">
                {{$value['harga_satuan']}}
              </td>
              <td class="px-6 py-4">
                {{$value['stok']}}
              </td>
              <td class="px-6 py-4">
                {{$value['stok_min']}}
              </td>
              <td class="px-6 py-4">
                {{$value['satuan']}}
              </td>
              <td class="px-6 py-0">
                <x-edit-produk-drawer :produk="$value" />
              </td>
            </tr>
            @endforeach

          </tbody>
        </table>
        <div class="p-4 ">
          {{ $data_produk->links() }}
        </div>
      </div>

    </div>
</x-layout>