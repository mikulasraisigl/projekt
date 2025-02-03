<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="text-lg font-semibold">Dnes je {{ now()->format('d.m') }}</p>

                </div>
            </div>

            <div class="mt-6 bg-white shadow-sm rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Cviky a videa</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Seznam jednotlivých cviků -->
                        @php
                            $exercises = [
                                [
                                    'name' => 'Bench Press',
                                    'video_url' => 'https://www.youtube.com/embed/vthMCtgVtFw',
                                ],
                                [
                                    'name' => 'Deadlift',
                                    'video_url' => 'https://www.youtube.com/embed/gtevYqq4G3s',
                                ],
                                [
                                    'name' => 'Dřepy',
                                    'video_url' => 'https://www.youtube.com/embed/gsNoPYwWXeM',
                                ],
                                [
                                    'name' => 'Shyby',
                                    'video_url' => 'https://www.youtube.com/embed/eGo4IYlbE5g',
                                ],
                            ];
                        @endphp

                        @foreach ($exercises as $exercise)
                            <div class="border rounded-lg p-4 shadow-md">
                                <h4 class="text-md font-semibold mb-2">{{ $exercise['name'] }}</h4>
                                <div class="video-container">
                                    <iframe
                                        src="{{ $exercise['video_url'] }}"
                                        frameborder="0"
                                        allowfullscreen
                                        class="rounded-lg w-full h-48"></iframe>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
































