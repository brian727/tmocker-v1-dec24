<div>
    <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Summits') }}
        </h2>
    </x-slot>
    <div class="p-16">
        <h2 class="text-2xl font-bold mb-4">Recorded Summits</h2>
        <div class="grid gap-4">
            @foreach($summits as $summit)
                <div class="bg-white shadow rounded-lg p-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-600">Start Time</p>
                            <p class="font-semibold">{{ $summit->start_time->format('M d, Y H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">End Time</p>
                            <p class="font-semibold">{{ $summit->end_time->format('M d, Y H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Temperature</p>
                            <p class="font-semibold">{{ $summit->temp }}°</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Duration</p>
                            <p class="font-semibold">{{ $summit->duration }} minutes</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
</div>
