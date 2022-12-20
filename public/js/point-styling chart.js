var pointstyle_chart_draw = function (content, idx) {
    let data1 = [];

    let color_1 = $('#color_1').val();
    let color_2 = $('#color_2').val();
    let position = $('#chart_position').val();
    for(i=0;i<6;i++)
    {
        data1.push(Math.floor((Math.random() * 100) + 1));
    }

    const data = {
        labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6'],
        datasets: [
            {
                label: 'Dataset',
                data: data1,
                borderColor: color_1,
                backgroundColor: color_1,
                pointStyle: 'circle',
                pointRadius: 10,
                pointHoverRadius: 15
            }
        ]
    };

    const config = {
        type: 'line',
        data: data,
        options: {
            responsive: true,

            plugins: {
                legend: {
                    position: position,
                },
                title: {
                    display: true,
                    text: (ctx) => 'Point Style: ' + ctx.chart.data.datasets[0].pointStyle,
                }
            }
        }
    };

    return config;

}