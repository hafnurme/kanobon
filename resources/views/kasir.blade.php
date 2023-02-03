<style>
    input[type=number] {
        -moz-appearance: textfield;
        appearance: textfield;
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

<x-layout>
    <x-slot:title> {{ $title }} </x-slot>
        <div class="flex w-full h-full" x-data="podukCart">
            <x-alert />

            <div class="w-[50%] h-full">
                <div class="p-4 flex flex-col h-full overflow-y-scroll">
                    <div class="sticky top-0 flex justify-end z-50">
                        <a href="{{ url('/')  }}"
                            class="mb-4 mr-2 bg-gray-700 rounded-lg border border-gray-600 p-2 text-gray-400"
                            @click="window.document.location.reload()">
                            <x-icons.refresh />
                        </a>
                        <form action="/search" method="post">
                            @csrf
                            <label for="table-search" class="sr-only">Search</label>
                            <div class="relative flex gap-2">
                                <button type="submit"
                                    class="absolute z-20 inset-y-0 right-0 flex items-center px-2 border-l border-gray-600 rounded-r-lg  hover:bg-gray-600">
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
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
                    <div class="grid grid-cols-1 sm:grid-cols-2  lg:grid-cols-3 gap-4">
                        @foreach ($data_produk as $produk)
                        <div
                            class="relative flex flex-col justify-between p-4 aspect-square text-white bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                            <div>

                                <span class="text-xl block mb-3 font-semibold">{{$produk['nama_produk']}}</span>
                                <span class="text-sm block mb-2"><span class="w-12 inline-block">Harga</span> :
                                    {{$produk['harga_satuan']}}</span>
                                <span class="text-sm block mb-2"><span class="w-12 inline-block">Stock</span> :
                                    {{$produk['stok']}}</span>
                            </div>

                            <div class="flex justify-end">
                                @if ($produk['stok'] >0) <button type="button" {{ $produk['stok'] <=0 ? 'hidden' : '' }}
                                    class="text-gray-900 bg-white border border-gray-300 focus:outline-none
                                hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm
                                px-5 py-1 dark:bg-gray-800 dark:text-white dark:border-gray-600
                                dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                    @click="add({{ $produk }})">
                                    Add
                                </button>
                                @else
                                <div class="flex">
                                    <x-icons.exclamation :size="5" />
                                    <p class="text-sm">Stok Habis</p>
                                </div>
                                @endif

                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>


            <div class="w-[50%] flex flex-col p-4 overflow-hidden">
                <div
                    class="h-full flex flex-col border-l bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <h2 class="text-xl font-semibold text-white p-4">Billing</h2>
                    <div class="p-4 flex-1 overflow-y-scroll">
                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                            <template x-for="(produk, index) in cart" :key="produk.id">
                                <template x-if="produk">
                                    <div>
                                        <li class="py-3 sm:py-3">
                                            <div class="flex items-center space-x-4 mb-2">
                                                <div class="flex-1 min-w-0">
                                                    <p class="font-medium text-gray-900 truncate dark:text-white"
                                                        x-text=" produk['nama_produk']">
                                                    </p>
                                                </div>
                                                <template x-if="produk">
                                                    <div class=" inline-flex items-center text-base font-semibold text-gray-900
                                                    dark:text-white">
                                                        <span x-text="price(index)"></span>
                                                    </div>
                                                </template>
                                            </div>
                                            <div class="flex justify-between">
                                                <div class="flex">
                                                    <button @click="removeFromCart(index)"
                                                        class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm px-1 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                                                        <x-icons.trash />
                                                    </button>
                                                </div>
                                                <div class="flex gap-2">
                                                    <button @click="minByIndex(index)"
                                                        class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm px-1 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                                                        <x-icons.minus-sm />
                                                    </button>
                                                    <template x-if="produk">
                                                        <input type="number"
                                                            class="text-black p-1 text-center rounded-full w-10 border-none appearance-none"
                                                            x-model="cart[index].count" min="1"
                                                            @input="maxInput($event,produk,index)">
                                                    </template>
                                                    <button @click="addByIndex(index)"
                                                        class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm px-1 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                                                        <x-icons.plus-sm />
                                                    </button>
                                                </div>
                                            </div>
                                        </li>
                                    </div>
                                </template>
                            </template>
                        </ul>
                    </div>
                    <div class="p-4 dark:text-white font-semibold">
                        <div class="flex justify-between pb-2 mb-4 border-b border-gray-600">
                            <h3>Total</h3>
                            <p x-text="total(true)"></p>
                        </div>
                        <div class="flex justify-end">
                            <x-bayar-modal />
                        </div>
                    </div>
                </div>
            </div>


        </div>
</x-layout>
<x-kasir-data />