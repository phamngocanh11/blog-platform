<div class="max-w-lg w-full bg-white rounded-lg shadow p-4 md:p-6">
    <div class="flex justify-between">
        <div>
            <h5 class="leading-none text-3xl font-bold text-gray-900 pb-2">{{ number_format($data['userCount']) }}</h5>
            <p class="text-base font-normal text-gray-500">Người dùng</p>
        </div>
    </div>
    <div id="user-chart" class="w-fit"></div> <!-- Make the chart responsive -->
</div>

<script>
    const userGrowthData = @json(array_column($data['userGrowth'], 'count'));
    const userGrowthCategories = @json(array_map(function($item) {
        return \Carbon\Carbon::parse($item['month'])->format('m'); // Display the month as a number
    }, $data['userGrowth']));

    const options = {
        chart: {
            height: "100%",
            width: "100%",
            type: "bar",
            fontFamily: "Inter, sans-serif",
            dropShadow: {
                enabled: false,
            },
            toolbar: {
                show: false,
            },
        },
        tooltip: {
            enabled: true,
            x: {
                show: true,
            },
        },
        plotOptions: {
            bar: {
                borderRadius: 4,
                horizontal: false,
                columnWidth: '50%',
            },
        },
        fill: {
            colors: ["#1C64F2"],
            opacity: 0.9,
        },
        dataLabels: {
            enabled: true,
        },
        stroke: {
            width: 2,
            colors: ["transparent"],
        },
        grid: {
            show: false,
            strokeDashArray: 4,
            padding: {
                left: 0,
                right: 0,
                top: 0
            },
        },
        series: [
            {
                name: "Người dùng mới",
                data: userGrowthData,
                color: "#1A56DB",
            },
        ],
        xaxis: {
            categories: userGrowthCategories,
            labels: {
                show: true,
            },
            axisBorder: {
                show: true,
            },
            axisTicks: {
                show: true,
            },
        },
        yaxis: {
            show: true,
        },
    }

    if (document.getElementById("user-chart") && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(document.getElementById("user-chart"), options);
        chart.render();
    }
</script>
