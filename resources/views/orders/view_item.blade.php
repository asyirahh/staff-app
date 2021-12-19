<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Item Pesanan') . ': ' . \App\Http\Controllers\Controller::order_num($item->order_id) }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- start component -->
                    <div class="flex items-center justify-center">
                        <div class="grid bg-white rounded-lg shadow-xl w-full">

                            <div class="flex justify-center">
                                <div class="flex">
                                    <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Item:
                                        {{ $item->product }}</h1>
                                </div>
                            </div>

                            <div class="w-full">
                                <div class="mt-10 mx-7">
                                    {{ __('Saiz: '). $item->size }} <br>
                                    {{ __('Kuantiti: '). $item->quantity }}
                                </div>
                                <div class="mt-5 mx-7">
                                    <div
                                        class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold border p-2">
                                        {!! $item->remarks !!}
                                    </div>
                                </div>
                            </div>
                            <hr class="mt-10 mx-10" />

                            @if (auth()->user()->isAdmin)
                                <div class="grid grid-cols-1 md:grid-cols-2 mt-5 mx-7">
                                    <div class="mb-5">
                                        <form action="/orders/item/{{ $item->id }}/user" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <label for="user_id">Tugasan: </label><br />
                                            <select name="user_id" id="user_id" class="">
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}"
                                                        {{ $user->id == $item->user_id ? 'selected' : '' }}
                                                        {{ $item->isPrinting ? 'disabled' : '' }}>
                                                        {{ $user->name }}</option>
                                                @endforeach
                                            </select>

                                            <x-button class="h-10">Simpan</x-button>
                                        </form>
                                    </div>
                                    {{-- <div class="mb-5">
                                        @php
                                            $last_stat = '';
                                            if ($item->isDone) {
                                                $last_stat = 'isDone';
                                            } elseif ($item->isPrinting) {
                                                $last_stat = 'isPrinting';
                                            } elseif ($item->isDesign) {
                                                $last_stat = 'isDesign';
                                            }

                                        @endphp
                                        <form action="/orders/item/{{ $item->id }}/status" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <label for="status">Status: </label><br />
                                            <select name="status" id="status">
                                                @foreach ($status as $stat => $stat_val)
                                                    <option value="{{ $stat }}"
                                                        {{ $stat == $last_stat ? 'selected' : '' }}>
                                                        {{ $stat_val }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            <x-button class="h-10">Simpan</x-button>
                                        </form>
                                    </div> --}}
                                </div>
                            @else
                                @unless(auth()->user()->id == $item->user_id)
                                    <div class="w-full m-5">
                                        <div class="mb-5">
                                            <form action="/orders/item/{{ $item->id }}/takeover" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <x-button onclick="return confirm('Sahkan ambil alih item')">
                                                    {{ __('Ambil Alih') }}</x-button>
                                            </form>
                                        </div>
                                    </div>
                                @endunless
                            @endif

                            <div class='flex gap-5 items-center justify-center p-5 pb-5'>
                                <a href="/orders/view/{{ $item->order_id }}"
                                    class='w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>
                                    Kembali ke senarai pesanan
                                </a>
                            </div>

                        </div>
                    </div> <!-- end components -->
                    <div class="mt-5 flex justify-between">
                        <div class="p-5">
                            @if(count($pictures))
                                <h2 class="text-xl font-bold">{{ __('Senarai gambar') }}</h2>
                            @endif
                        </div>
                        <div class="">
                            <form action="/orders/item/{{ $item->id }}/foto" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <x-form.input name="picture" label="{{ __('Muat Naik Foto:') }}" type="file" />
                                <x-button class="mt-2">Muat naik</x-button>
                            </form>
                        </div>
                    </div>
                    <div class="mt-3">
                        @foreach ($pictures as $pic)
                            <img src="{{ asset('storage/' . $pic->picture) }}" alt="" class="w-full p-5 border">
                        @endforeach
                    </div>
                    {{-- {{ __('Tiada gambar dimuat naik')}} --}}

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
