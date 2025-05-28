<x-filament-widgets::widget >
    @vite('resources/css/app.css')
    <x-filament::section>
        <div class="flex flex-col">
            <h3 class="text-xl font-semibold mb-6">Bieplus</h3>
            
            <div class="flex gap-6">
                @foreach($this->getData() as $item)
                    <div class="w-[120px] h-[120px] rounded-lg {{ $item['color'] }} p-6 flex flex-col justify-center items-center">
                        <span class="text-white text-2xl font-medium text-center">{{ $item['type'] }}</span>
                        <span class="text-white text-lg text-center">{{ $item['count'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </x-filament::section>
    @vite('resources/js/app.js')    
</x-filament-widgets::widget>