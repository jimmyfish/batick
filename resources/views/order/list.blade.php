<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mb-6 p-6">
                    <button type="button" data-modal-target="defaultModal" data-modal-toggle="defaultModal"
                        class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5">
                        Add Portfolio
                    </button>
                </div>
                <div class="p-6">
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Symbol
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Size
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Buy Price
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Sell Price
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Profit
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr class="bg-white border-b bg-gray-800 border-gray-100">
                                        <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                            {{ $order->symbol->symbol }}
                                        </td>
                                        <td class="px-6 py-2">
                                            @if ($order->is_closed)
                                                <span
                                                    class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Closed</span>
                                            @else
                                                <span
                                                    class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Open</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-2">
                                            {{ $order->size }}
                                        </td>
                                        <td class="px-6 py-2">
                                            {{ $order->buy_price }}
                                        </td>
                                        <td class="px-6 py-2">
                                            @if ($order->is_closed)
                                                {{ $order->sell_price }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="px-6 py-2">
                                            @if ($order->is_closed)
                                                @php $profit = round($order->size * $order->sell_price - $order->size * $order->buy_price, 3) @endphp
                                                <span
                                                    class="@if ($profit > 0) text-green-600 @else text-red-600 @endif">
                                                    @if ($profit < 0)
                                                        -
                                                    @endif
                                                    <small><strong>$</strong></small>
                                                    {{ abs($profit) }}
                                                </span>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="px-6 py-2">
                                            <a href="{{ route('order.close', ['order_id' => $order->id]) }}">
                                                @if (!$order->is_closed)
                                                    <ion-icon name="stop-circle-outline"></ion-icon>
                                                @else
                                                    -
                                                @endif
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="px-6 mt-6">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="defaultModal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Add Portfolio
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="defaultModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form method="POST" action="{{ route('order.create') }}">
                    <div class="p-6 space-y-6">
                        {{ csrf_field() }}
                        <div class="relative z-0 w-full mb-6 group">
                            <select name="symbol" id="symbol"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach ($symbols as $symbol)
                                    <option value="{{ $symbol->id }}">
                                        {{ $symbol->symbol }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="relative z-0 w-full mb-6 group">
                            <input type="number" name="amount" id="amount"
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " required />
                            <label for="amount"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Amount</label>
                        </div>


                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex pl-auto items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
