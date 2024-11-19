<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @forelse (auth()->user()->notifications as $notif)
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-3">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 flex justify-between">
                        <strong>{{ $notif->data["name"] . " " . $notif->data["message"] }}</strong>
                        <button type="button"><a href="">Mark as Read</a></button>
                    </div>
                </div>
            </div>
            @empty
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-3">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 flex justify-between">
                            No new notifications
                        </div>
                    </div>
                </div>
        @endforelse
    </div>
</x-app-layout>
