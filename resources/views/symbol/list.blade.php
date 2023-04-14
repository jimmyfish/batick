<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Symbol') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mb-6 p-6">
                    <form method="get">
                        {{-- <label for="search"><small>Search</small></label>
                        <input type="text" name="search" id="search"> --}}
                        <div class="relative z-0 w-full group ml-auto">
                            <div class="grid md:grid-cols-2 md:gap-6">
                                <input type="text"
                                    class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " name="search" id="search" autocomplete="off" value="{{ strtoupper(request()->search) }}" />
                                <label for="search"
                                    class="peer-focus:font-medium absolute text-sm dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Search
                                </label>
                            </div>
                            <a href="{{ route('symbol.list') }}" class="text-right">
                                <small>reset</small>
                            </a>
                        </div>
                    </form>
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
                                        Source
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($symbols as $symbol)
                                    <tr class="bg-white border-b bg-gray-800 border-gray-100">
                                        <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                            {{ $symbol->symbol }}
                                        </td>
                                        <td class="px-6 py-2">
                                            {{ $symbol->source }}
                                        </td>
                                        <td class="px-6 py-2">
                                            <a href="{{ route('symbol.toggle', ['id' => $symbol->id]) }}">
                                                @if (!$symbol->trashed())
                                                    <ion-icon class="text-green-500" name="toggle"
                                                        style="font-size: 24px"></ion-icon>
                                                @else
                                                    <ion-icon class="text-gray-500" name="toggle-outline"
                                                        style="font-size: 22px;transform: rotate(180deg);"></ion-icon>
                                                @endif
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="px-6 mt-6">
                            {{ $symbols->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
