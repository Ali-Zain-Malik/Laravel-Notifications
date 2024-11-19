<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
                <div class="flex w-full justify-center">
                    <table class="border-separate border-spacing-2 border border-slate-500 w-3/4">
                        <thead>
                            <tr>
                                <th class="border border-slate-600">Name</th>
                                <th class="border border-slate-600">Email</th>
                                <th class="border border-slate-600">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="border border-slate-700 py-2">{{ $user->name }}</td>
                                    <td class="border border-slate-700 py-2">{{ $user->email }}</td>
                                    <td class="border border-slate-700 py-2 flex justify-center"><a href="{{ route("toggle-like") }}"><img role="button" src="{{ asset("Icons/heart.svg") }}" alt=""></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
