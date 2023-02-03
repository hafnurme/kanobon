<x-layout>
  <x-slot:title>
    {{$title}}
    </x-slot>
    <div class="flex flex-col w-full flex-1">
      <div class="w-full flex-1 flex">
        <div class="w-[50%]">
          <form method="post" class="p-4" action="tambah-produk/simpan">
            @csrf
            <label class="mb-2 block" for="nama_produk">
              <span class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Produk</span>
              <input type="text" name="nama_produk" id="nama_produk"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
            </label>
            <label class="mb-2 block" for="harga_satuan">
              <span class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Satuan</span>
              <input type="number" name="harga_satuan" id="harga_satuan"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
            </label>
            <label class="mb-2 block" for="stok">
              <span class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok</span>
              <input type="number" name="stok" id="stok"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
            </label>
            <label class="mb-2 block" for="stok_min">
              <span class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok Minimal</span>
              <input type="text" name="stok_min" id="stok_min"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
            </label>
            <label class="mb-2 block" for="satuan">
              <span class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Satuan</span>
              <input type="text" name="satuan" id="satuan"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
              </select>
            </label>
            <div class="mt-4">
              <button
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tambah</button>
              <button type="reset"
                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Reset</button>
            </div>
          </form>
        </div>
        <div
          class="w-[50%] m-4 p-4 flex-1 flex flex-col gap-4  bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
          <h2 class="text-white font-semibold text-xl">Baru Ditambahkan</h2>
          <div class="relative overflow-x-auto shadow-md sm:rounded-lg h-full bg-gray-700">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
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
                    Satuan
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($produk_terbaru as $produk)
                <tr
                  class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                  <td class="px-6 py-4">
                    {{ $produk['nama_produk']}}
                  </td>
                  <td class="px-6 py-4">
                    {{$produk['harga_satuan']}}
                  </td>
                  <td class="px-6 py-4">
                    {{$produk['stok']}}
                  </td>
                  <td class="px-6 py-4">
                    {{$produk['satuan']}}
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
</x-layout>