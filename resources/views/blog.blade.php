<x-app-layout>
    <div class="p-4">
        <h2 class="text-lg font-semibold mb-4">Seznam akcí</h2>

        <!-- Seznam uložených akcí -->
        <ul class="bg-white rounded-md shadow divide-y divide-gray-200">
            @forelse($actions as $action)
                <li class="p-4 flex items-center justify-between">
                    <div>
                        <strong>{{ $action->date }}</strong> - {{ $action->action }}
                    </div>
                    <div>
                        <!-- Tlačítko pro úpravu -->
                        <button onclick="openEditModal({{ $action->id }}, '{{ $action->action }}', '{{ $action->date }}')"
                                class="text-blue-500 hover:text-blue-700 mr-2">Upravit</button>

                        <!-- Formulář pro smazání -->
                        <form method="POST" action="{{ route('actions.destroy', $action->id) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Opravdu smazat?')">Smazat</button>
                        </form>
                    </div>
                </li>
            @empty
                <li class="p-4 text-gray-500">Žádné záznamy k zobrazení.</li>
            @endforelse
        </ul>

        <!-- Tlačítko pro přidání -->
        <div class="fixed bottom-6 right-6">
            <button onclick="openCreateModal()"
                    class="w-16 h-16 bg-red-600 text-white rounded-full shadow-lg flex items-center justify-center hover:bg-red-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                     stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.75v14.5M4.75 12h14.5"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Modal pro přidání -->
    <div id="createModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4 py-6">
            <div class="fixed inset-0 bg-gray-500 opacity-50" onclick="closeCreateModal()"></div>
            <div class="bg-white rounded-lg shadow-xl w-full max-w-lg relative z-20">
                <div class="p-4">
                    <form id="createForm" method="POST" action="{{ route('actions.store') }}">
                        @csrf
                        <h2 class="text-lg font-semibold mb-4">Nový záznam</h2>

                        <!-- Textarea pro akci -->
                        <div class="mb-4">
                            <label for="createAction" class="block text-sm font-medium text-gray-700">Co jsem udělal</label>
                            <textarea id="createAction" name="action" rows="3"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                      placeholder="Popište, co jste udělali"></textarea>
                        </div>

                        <!-- Input pro datum -->
                        <div class="mb-4">
                            <label for="createDate" class="block text-sm font-medium text-gray-700">Vyberte datum</label>
                            <input type="date" id="createDate" name="date"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div class="flex justify-end">
                            <button type="button" onclick="closeCreateModal()"
                                    class="px-4 py-2 mr-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">Zrušit</button>
                            <button type="submit"
                                    class="px-4 py-2 bg-gray-300 text-gray-700  rounded-md hover:bg-gray-400">Uložit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal pro úpravu -->
    <div id="editModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4 py-6">
            <div class="fixed inset-0 bg-gray-500 opacity-50" onclick="closeEditModal()"></div>
            <div class="bg-white rounded-lg shadow-xl w-full max-w-lg relative z-20">
                <div class="p-4">
                    <form id="editForm" method="POST" action="">
                        @csrf
                        @method('PUT')
                        <h2 class="text-lg font-semibold mb-4">Upravit akci</h2>

                        <!-- Textarea pro akci -->
                        <div class="mb-4">
                            <label for="editAction" class="block text-sm font-medium text-gray-700">Co jsem udělal</label>
                            <textarea id="editAction" name="action" rows="3"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                        </div>

                        <!-- Input pro datum -->
                        <div class="mb-4">
                            <label for="editDate" class="block text-sm font-medium text-gray-700">Vyberte datum</label>
                            <input type="date" id="editDate" name="date"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div class="flex justify-end">
                            <button type="button" onclick="closeEditModal()"
                                    class="px-4 py-2 mr-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">Zrušit</button>
                            <button type="submit"
                                    class="px-4 py-2  bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">Uložit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Skripty pro modal -->
    <script>
        function openCreateModal() {
            const modal = document.getElementById('createModal');
            modal.classList.remove('hidden');
        }

        function closeCreateModal() {
            const modal = document.getElementById('createModal');
            modal.classList.add('hidden');
        }

        function openEditModal(id, action, date) {
            const modal = document.getElementById('editModal');
            const form = document.getElementById('editForm');
            const actionInput = document.getElementById('editAction');
            const dateInput = document.getElementById('editDate');

            // Nastavení hodnot formuláře
            actionInput.value = action;
            dateInput.value = date;

            // Nastavení akčního URL pro odeslání formuláře
            form.action = `/actions/${id}`;

            // Zobrazení modalu
            modal.classList.remove('hidden');
        }

        function closeEditModal() {
            const modal = document.getElementById('editModal');
            modal.classList.add('hidden');
        }
    </script>
</x-app-layout>
