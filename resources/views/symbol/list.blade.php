<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Symbol') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Symbol
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($symbols as $symbol)
                                    <tr class="bg-white border-b bg-gray-800 border-gray-100">
                                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                            {{ $symbol->symbol }}
                                        </th>
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
