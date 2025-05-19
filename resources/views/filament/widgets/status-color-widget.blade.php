<x-filament-widgets::widget>
    @vite('resources/css/app.css')
    <x-filament::section>
        <div class="flex flex-col items-center space-y-6">
            <h2 class="text-2xl font-bold">Status Color</h2>

            <div class="grid grid-cols-3 gap-x-24">
                <div class="flex flex-col items-center gap-3">
                    <div class="w-20 h-20 bg-green-500 rounded-lg"></div>
                    <span class="text-sm font-medium">Tersedia (Kosong)</span>
                </div>

                <div class="flex flex-col items-center gap-3">
                    <div class="w-20 h-20 bg-amber-500 rounded-lg"></div>
                    <span class="text-sm font-medium">Terisi</span>
                </div>

                <div class="flex flex-col items-center gap-3">
                    <div class="w-20 h-20 bg-red-500 rounded-lg"></div>
                    <span class="text-sm font-medium">Penuh</span>
                </div>
            </div>
        </div>
    </x-filament::section>
    @vite('resources/js/app.js')
</x-filament-widgets::widget>