<x-filament-widgets::widget>
    @vite('resources/css/app.css')
    <x-filament::section>
        <div class="bg-white dark:bg-gray-800 p-6">
            <!-- Section 1: Header -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h2>
                        <span class="text-xl font-semibold">Statistik keseluruhan</span>
                    </h2>
                </div>
                
                <p class="text-sm">Informasi harian tentang terisinya kamar / terisinya member</p>
            </div>

            <!-- Section 2: Circular Statistics -->
            <div class="mb-12">
                <div class="flex justify-center items-center gap-8">
                    @foreach($this->getStatistics()['categories'] as $category => $stat)
                        <div class="text-center">
                            <div class="relative w-20 h-20 mx-auto mb-3">
                                <svg class="w-20 h-20 transform -rotate-90" viewBox="0 0 36 36">
                                    <path
                                        d="M18 2.0845
                                           a 15.9155 15.9155 0 0 1 0 31.831
                                           a 15.9155 15.9155 0 0 1 0 -31.831"
                                        fill="none"
                                        stroke="#e5e5e5"
                                        stroke-width="2"
                                        class="dark:stroke-gray-600"/>
                                    <path
                                        d="M18 2.0845
                                           a 15.9155 15.9155 0 0 1 0 31.831
                                           a 15.9155 15.9155 0 0 1 0 -31.831"
                                        fill="none"
                                        stroke="{{ $stat['color'] }}"
                                        stroke-width="2"
                                        stroke-dasharray="{{ $stat['percentage'] }}, 100"
                                        stroke-linecap="round"/>
                                </svg>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <span class="text-sm font-semibold">{{ $stat['occupied'] }}/{{ $stat['total'] }}</span>
                                </div>
                            </div>
                            <div class="text-sm font-semibold uppercase">{{ strtoupper($category) }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Section 3: Total Members -->
            <div class="mb-12">
                <div class="text-center">
                    <div class="text-sm mb-1">Total Seluruh Member</div>
                    <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $this->getStatistics()['totalMembers'] }} orang</div>
                </div>
            </div>

            <!-- Section 4: Category Details -->
            <div class="grid grid-cols-5 gap-4">
                @foreach($this->getStatistics()['categories'] as $category => $stat)
                    <div class="text-center">
                        <div class="text-xs mb-1">Total Member</div>
                        <div class="text-xs mb-1">{{ strtoupper($category) }}</div>
                        <div class="text-lg font-bold" style="color: {{ $stat['color'] }}">{{ $stat['occupied'] }} orang</div>
                    </div>
                @endforeach
            </div>
        </div>
    </x-filament::section>
    @vite('resources/js/app.js')
</x-filament-widgets::widget>