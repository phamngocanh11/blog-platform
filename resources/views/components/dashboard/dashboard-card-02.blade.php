<div class="max-w-lg w-full bg-white rounded-lg shadow p-4 md:p-6">
    <div class="flex justify-between">
        <div>
            <h5 class="leading-none text-3xl font-bold text-gray-900 pb-2">{{ number_format($data['viewsCount']) }}</h5>
            <p class="text-base font-normal text-gray-500">Tổng lượt views</p>
        </div>
    </div>
    <div id="view-chart" class="w-fit"></div>
</div>

<script>
    const viewsGrowthData = @json(array_column($data['viewsGrowth'], 'count'));
    const viewsGrowthCategories = @json(array_map(function($item) {
        return \Carbon\Carbon::parse($item['month'])->format('m');
    }, $data['viewsGrowth']));

    const view_options = {
        chart: {
            width: "100%",
            height: "100%",
            type: "line",
            fontFamily: "Inter, sans-serif",
            toolbar: false,
        },
        xaxis: {
            categories: viewsGrowthCategories,
        },
        series: [{
            name: "Views",
            data: viewsGrowthData,
        }],
        colors: ["#1C64F2"],
        dataLabels: {
            enabled: true,
        },
        legend: {
            position: 'top',
        },
    }

    if (document.getElementById("view-chart") && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(document.getElementById("view-chart"), view_options);
        chart.render();
    }
</script>
