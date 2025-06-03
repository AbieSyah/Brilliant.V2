<x-filament-widgets::widget>
    <x-filament::section>
        <div class="bg-white dark:bg-gray-800 p-6">
            <!-- Section 1: Header dan Search -->
            <div class="mb-8">
                <h2 class="mb-4">
                    <span class="text-xl font-semibold">Ketersediaan Kamar</span>
                </h2>

                <!-- Search Bar -->
                <div class="mb-6">
                    <div class="relative max-w-md">
                        <input type="text" wire:model.live="search"
                            placeholder="Cari berdasarkan nama camp, nama kamar, atau tipe kamar..."
                            class="w-full px-4 py-2 pl-12 pr-4 text-sm border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 placeholder-gray-500 dark:placeholder-gray-400">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        @if($search)
                            <button wire:click="$set('search', '')"
                                class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <svg class="w-4 h-4 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Section 2: Keterangan Warna -->
            <div class="mb-12">
                <div class="text-sm">
                    <h2 class="text-xl font-semibold mb-6">Keterangan Warna</h2>

                    <div class="grid grid-cols-3 gap-x-24 mb-6">
                        <div class="flex flex-col items-center gap-3">
                            <div class="w-20 h-20 bg-green-500 rounded-lg"></div>
                            <span class="text-sm font-semibold">Tersedia (Kosong)</span>
                        </div>

                        <div class="flex flex-col items-center gap-3">
                            <div class="w-20 h-20 bg-amber-500 rounded-lg"></div>
                            <span class="text-sm font-semibold">Terisi</span>
                        </div>

                        <div class="flex flex-col items-center gap-3">
                            <div class="w-20 h-20 bg-red-500 rounded-lg"></div>
                            <span class="text-sm font-semibold">Penuh</span>
                        </div>
                    </div>
                    <p class="mb-2">Data difilter untuk kategori: Regular, Regular+, Homestay, Homestay+, VIP</p>
                    <h2 class="text-blue-600 dark:text-blue-400 font-medium">Total Booking Aktif:
                        {{ $this->getTotalActiveBookings() }} booking
                    </h2>
                </div>
            </div>

            <!-- Section 3: Status Camp -->
            <div class="mb-16">
                <h3 class="mb-6">
                    <span class="text-lg font-semibold">Status Camp</span>
                </h3>
                <div class="grid grid-cols-12 gap-3">
                    @foreach($this->getCamps() as $camp)
                        <div class="relative">
                            <div
                                class="aspect-square w-full rounded-lg {{ $camp['color'] }} flex flex-col items-center justify-center">
                                <span class="text-white text-sm">{{ $camp['label'] }}</span>
                                <span class="text-white text-xs mt-1">{{ $camp['bookingInfo'] }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Summary statistik -->
            <div class="mt-6 bg-gray-50 dark:bg-gray-700 rounded p-4">
                <h4 class="mb-2">
                    <span class="font-semibold">Ringkasan Ketersediaan</span>
                </h4>
                <div class="grid grid-cols-5 gap-4 text-sm">
                    @foreach($this->getCategoryStats() as $category => $stats)
                        <div class="text-center">
                            <div class="font-semibold uppercase text-xs">{{ $category }}</div>
                            <div class="text-lg font-bold text-blue-600 dark:text-blue-400">{{ $stats['occupied_beds'] }}
                            </div>
                            <div class="text-xs">dari {{ $stats['total_beds'] }} kasur</div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Section 4: Status Kamar -->
            <div class="mb-8">
                <h3 class="mb-6">
                    <span class="text-lg font-semibold">Status Kamar</span>
                </h3>
            </div>

            @foreach($this->getRoomsByCategory() as $category => $genderRooms)
                <div class="mb-8 border-b border-gray-200 dark:border-gray-700 pb-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-center">
                            <span class="text-lg font-semibold uppercase">{{ $category }}</span>
                        </h3>
                        @php
                            $categoryStats = $this->getCategoryStats()[$category] ?? [];
                        @endphp
                        @if(!empty($categoryStats))
                            <div class="text-sm">
                                <span class="font-semibold">Terisi:
                                    {{ $categoryStats['occupied_beds'] }}/{{ $categoryStats['total_beds'] }}</span>
                                <span
                                    class="ml-2 text-blue-600 dark:text-blue-400">({{ $categoryStats['occupancy_rate'] }}%)</span>
                            </div>
                        @endif
                    </div>

                    <div class="grid grid-cols-2 gap-25">
                        <!-- Putri -->
                        <div>
                            <h4 class="text-center font-semibold mb-4 text-pink-600 dark:text-pink-400">Putri
                                ({{ count($genderRooms['putri']) }} kamar)</h4>
                            <div class="grid grid-cols-4 gap-3">
                                @forelse($genderRooms['putri'] as $room)
                                    <div class="text-center">
                                        <div class="w-full h-16 mx-auto mb-1 rounded flex items-center justify-center text-white text-xs font-bold {{ $room['color'] }} px-2"
                                            title="Camp: {{ $room['camp_nama'] }} | Type: {{ $room['type_kamar'] }} | Harga: Rp {{ number_format($room['harga'] ?? 0, 0, ',', '.') }}">
                                            <span class="text-center leading-tight break-words">{{ $room['nama'] }}</span>
                                        </div>
                                        <div class="text-xs">{{ $room['bookingInfo'] }}</div>
                                    </div>
                                @empty
                                    <div class="col-span-4 text-center text-sm py-4">
                                        <div class="bg-gray-100 dark:bg-gray-700 rounded p-2">Tidak ada kamar putri</div>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Putra -->
                        <div>
                            <h4 class="text-center font-semibold mb-4 text-blue-600 dark:text-blue-400">Putra
                                ({{ count($genderRooms['putra']) }} kamar)</h4>
                            <div class="grid grid-cols-4 gap-3">
                                @forelse($genderRooms['putra'] as $room)
                                    <div class="text-center">
                                        <div class="w-full h-16 mx-auto mb-1 rounded flex items-center justify-center text-white text-xs font-bold {{ $room['color'] }} px-2"
                                            title="Camp: {{ $room['camp_nama'] }} | Type: {{ $room['type_kamar'] }} | Harga: Rp {{ number_format($room['harga'] ?? 0, 0, ',', '.') }}">
                                            <span class="text-center leading-tight break-words">{{ $room['nama'] }}</span>
                                        </div>
                                        <div class="text-xs">{{ $room['bookingInfo'] }}</div>
                                    </div>
                                @empty
                                    <div class="col-span-4 text-center text-sm py-4">
                                        <div class="bg-gray-100 dark:bg-gray-700 rounded p-2">Tidak ada kamar putra</div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </x-filament::section>
</x-filament-widgets::widget>