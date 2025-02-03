<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Plánovač tréninků</h1>

        <!-- Zobrazení úspěšné zprávy -->
        @if (session('success'))
            <div class="bg-green-500 text-white p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulář pro vytvoření nového tréninku -->
        <form method="POST" action="{{ route('events.store') }}" class="mb-4">
            @csrf
            <div>
                <label for="title" class="block font-bold">Název tréninku</label>
                <input type="text" name="title" id="title" class="border rounded w-full p-2" required>
            </div>
            <div>
                <label for="start" class="block font-bold">Začátek</label>
                <input type="datetime-local" name="start" id="start" class="border rounded w-full p-2" required>
            </div>
            <div>
                <label for="repeat" class="block font-bold">Opakování</label>
                <input type="text" name="repeat" id="repeat" class="border rounded w-full p-2">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-2 rounded">Přidat trénink</button>
        </form>

        <!-- Kalendář pro zobrazení tréninků -->
        <h2 class="text-xl font-bold mb-2">Kalendář tréninků</h2>
        <div id="calendar"></div> <!-- Kontejner pro FullCalendar -->

        <!-- Seznam událostí -->
        <h2 class="text-xl font-bold mb-2 mt-4">Vaše tréninky</h2>
        @foreach ($events as $event)
            <div class="border-b py-2">
                <h3 class="font-bold">{{ $event->title }}</h3>
                <p>Začátek: {{ $event->start }}</p>
                <p>Opakuje se: {{ $event->repeat ?? 'Ne' }}</p>
                <p>Dokončeno: {{ $event->completed ? 'Ano' : 'Ne' }}</p>
                <form method="POST" action="{{ route('events.update', $event) }}">
                    @csrf
                    @method('PUT')
                    <input type="checkbox" name="completed" value="1" {{ $event->completed ? 'checked' : '' }}> Dokončeno
                    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 ml-2 rounded">Aktualizovat</button>
                </form>
                <form method="POST" action="{{ route('events.destroy', $event) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 mt-2 rounded">Smazat</button>
                </form>
            </div>
        @endforeach
    </div>

    <!-- FullCalendar -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth', // Měsíční přehled
                locale: 'cs', // Čeština
                events: [
                        @foreach ($events as $event)
                    {
                        title: '{{ $event->title }}',
                        start: '{{ $event->start }}',
                        allDay: false,
                    },
                    @endforeach
                ],
            });
            calendar.render();
        });
    </script>
</x-app-layout>
