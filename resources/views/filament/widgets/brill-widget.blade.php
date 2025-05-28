<x-filament-widgets::widget>
    @vite('resources/css/app.css')
    <x-filament::section>
        <div class="flex flex-col">
            <h3 class="text-xl font-semibold mb-6">Brilliant</h3>

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
    </x-filament::section>
    @vite('resources/js/app.js')
</x-filament-widgets::widget>