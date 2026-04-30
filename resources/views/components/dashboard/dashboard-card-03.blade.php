<div class="max-w-lg md:max-w-full w-full bg-white rounded-lg shadow p-4 md:p-6">
  <div class="flex justify-between">
    <div>
      <h5 class="leading-none text-3xl font-bold text-gray-900 pb-2">{{ number_format($data['postCount']) }}</h5>
      <p class="text-base font-normal text-gray-500">Tổng bài viết</p>
    </div>
  </div>
  <div id="post-chart"></div>
</div>

<script>
  const postsData = [
      @json($data['postsLast7Days']),
      @json($data['postCount'])
  ];

  const posts_options = {
    chart: {
      height: "100%",
      maxWidth: "100%",
      type: "area",
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
        show: false,
      },
    },
    fill: {
      type: "gradient",
      gradient: {
        opacityFrom: 0.55,
        opacityTo: 0,
        shade: "#1C64F2",
        gradientToColors: ["#1C64F2"],
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      width: 6,
    },
    grid: {
      show: false,
      strokeDashArray: 4,
      padding: {
        left: 2,
        right: 2,
        top: 0
      },
    },
    series: [
      {
        name: "Tổng bài viết",
        data: postsData,
          colors: ["#1C64F2"],
      },
    ],
    xaxis: {
      categories: ['7 ngày', 'Tổng'],
      labels: {
        show: true,
      },
      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
    },
    yaxis: {
      show: true,
    },
  }

  if (document.getElementById("post-chart") && typeof ApexCharts !== 'undefined') {
    const chart = new ApexCharts(document.getElementById("post-chart"), posts_options);
    chart.render();
  }
</script>
