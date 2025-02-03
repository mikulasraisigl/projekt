<x-app-layout>
    <div class="container">

        <!-- Tlačítko pro zobrazení formuláře -->
        <button id="toggleFormButton" class="btn btn-primary mb-3">Přidat novou statistiku</button>

        <!-- Skrytý formulář pro zadání nové statistiky -->
        <form id="newStatForm" action="{{ route('statistika.store') }}" method="POST" style="display: none;">
            @csrf
            <div class="mb-3">
                <label for="typ_cviceni" class="form-label">Typ cvičení</label>
                <select name="typ_cviceni" id="typ_cviceni" class="form-select" required>
                    <option value="běh">Běh</option>
                    <option value="dřepy">Dřepy</option>
                    <option value="bench_press">Bench Press</option>
                    <option value="plavání">Plavání</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="datum" class="form-label">Datum</label>
                <input type="date" name="datum" id="datum" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="cas" class="form-label">Čas (pokud běh/plavání)</label>
                <input type="time" name="cas" id="cas" class="form-control">
            </div>

            <div class="mb-3">
                <label for="vaha" class="form-label">Vzdálenost/Váha (km/kg)</label>
                <input type="number" step="0.1" name="vaha" id="vaha" class="form-control">
            </div>

            <div class="mb-3">
                <label for="opakovani" class="form-label">Opakování</label>
                <input type="number" name="opakovani" id="opakovani" class="form-control">
            </div>

            <button type="submit" class="btn btn-success">Uložit statistiku</button>
        </form>

        <hr>

        <h2>Přehled</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Typ cvičení</th>
                <th>Datum</th>
                <th>Čas</th>
                <th>Vzdálenost/Váha</th>
                <th>Opakování</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($statistiky as $statistika)
                <tr>
                    <td>{{ $statistika->typ_cviceni }}</td>
                    <td>{{ $statistika->datum }}</td>
                    <td>{{ $statistika->cas }}</td>
                    <td>{{ $statistika->vaha }}</td>
                    <td>{{ $statistika->opakovani }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <hr/>

        <h2>Grafy</h2>

        <div class="charts-container">
            <canvas id="grafBehPlavani"></canvas>
            <canvas id="grafDrepyBenchPress"></canvas>
        </div>
    </div>
</x-app-layout>

<style>
    .charts-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        gap: 20px;
    }
    canvas {
        max-width: 500px;
        max-height: 400px;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Skrytí a zobrazení formuláře
    document.getElementById('toggleFormButton').addEventListener('click', () => {
        const form = document.getElementById('newStatForm');
        if (form.style.display === 'none' || form.style.display === '') {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    });

    const data = @json($statistiky);


    const behPlavaniData = data.filter(item => item.typ_cviceni === 'běh' || item.typ_cviceni === 'plavání');

    const drepyBenchPressData = data.filter(item => item.typ_cviceni === 'dřepy' || item.typ_cviceni === 'bench_press');

    function formatDate(dateStr) {
        const date = new Date(dateStr);
        return new Intl.DateTimeFormat('cs-CZ', { day: '2-digit', month: 'short' }).format(date);
    }

    function createDataset(activityData, isBehPlavani) {
        return {
            labels: activityData.map(item => formatDate(item.datum)),
            value1: activityData.map(item => item.vaha || 0),
            value2: isBehPlavani
                ? activityData.map(item => parseTimeToMinutes(item.cas) || 0)
                : activityData.map(item => item.opakovani || 0),
        };
    }

    function parseTimeToMinutes(timeStr) {
        if (!timeStr) return null;
        const [hours, minutes] = timeStr.split(':').map(Number);
        return hours * 60 + minutes;
    }

    const behPlavaniDataset = createDataset(behPlavaniData, true);
    const drepyBenchPressDataset = createDataset(drepyBenchPressData, false);

    function createMixedChart(ctxId, label1, label2, dataset, barColor, lineColor) {
        const ctx = document.getElementById(ctxId).getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: dataset.labels,
                datasets: [
                    {
                        type: 'bar',
                        label: label1,
                        data: dataset.value1,
                        backgroundColor: barColor,
                        yAxisID: 'y1',
                    },
                    {
                        type: 'line',
                        label: label2,
                        data: dataset.value2,
                        borderColor: lineColor,
                        borderWidth: 2,
                        tension: 0.3,
                        yAxisID: 'y2',
                    },
                ],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                },
                scales: {
                    x: { title: { display: true, text: 'Datum' } },
                    y1: {
                        type: 'linear',
                        position: 'left',
                        title: { display: true, text: label1 },
                        beginAtZero: true,
                    },
                    y2: {
                        type: 'linear',
                        position: 'right',
                        title: { display: true, text: label2 },
                        beginAtZero: true,
                        grid: { drawOnChartArea: false },
                    },
                },
            },
        });
    }

    createMixedChart(
        'grafBehPlavani',
        'Vzdálenost (km)',
        'Čas (minuty)',
        behPlavaniDataset,
        'rgba(54, 162, 235, 0.5)',
        'rgba(255, 99, 132, 1)'
    );

    createMixedChart(
        'grafDrepyBenchPress',
        'Váha (kg)',
        'Opakování',
        drepyBenchPressDataset,
        'rgba(153, 102, 255, 0.5)',
        'rgba(255, 159, 64, 1)'
    );
</script>
