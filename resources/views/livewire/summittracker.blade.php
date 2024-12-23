<div>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Start a New Hike') }}
            </h2>
        </x-slot>

        <div class="flex p-16 mx-auto justify-center items-center gap-4">
            @if(!$isTracking)
                <div>
                    <button 
                        class="bg-green-500 hover:bg-green-800 text-white font-bold py-2 px-4 rounded" 
                        onclick="startSummit()">
                        Start 
                    </button>
                </div>
            @else
                <div>
                    Started at: {{ $startTime }}
                    <input type="number" wire:model="temp" placeholder="Temperature">
                    <button class="bg-red-500 hover:bg-red-800 text-white font-bold py-2 px-4 rounded" wire:click="stop">Stop Summit</button>
                </div>
            @endif
        </div>

        @if(session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('message') }}</span>
            </div>
        @endif

        @if($showLeaderboard)
            <div class="mt-8">
                <h2 class="text-2xl font-bold mb-4">Latest Rankings</h2>
                @livewire('leaderboard')
            </div>
        @endif
    </x-app-layout>

    <script>
        function startSummit() {
            console.log('Starting summit check...');
            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    console.log('Got location:', position.coords);
                    @this.setLocation(
                        position.coords.latitude,
                        position.coords.longitude
                    ).then(() => {
                        console.log('Location set, starting...');
                        @this.start();
                    });
                }, function(error) {
                    console.error('Geolocation error:', error);
                    alert('Error getting location: ' + error.message);
                });
            }
        }

        document.addEventListener('livewire:initialized', () => {
            @this.on('showError', (message) => {
                console.log('Error:', message);
                alert(message);
            });
        });
    </script>
</div>