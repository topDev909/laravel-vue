var line_chart_draw = function (content, idx) {
    const DATA_COUNT = 2;
    let data1 = [];
    let data2 = [];
    let labels = [];
    let position = $('#chart_position').val();
    for(i=0; i<DATA_COUNT;i++)
    {
        for(j=0; j<3; j++)
        {
            data1.push(Math.floor((Math.random() * 100) + 1));
            data2.push(Math.floor((Math.random() * 100) + 1));
        }
        labels.push($('#label_' + (i+1)).val());
    }
    let color_1 = $('#color_1').val();
    let color_2 = $('#color_2').val();

    const data = {
        labels: ['1', '2', '3', '4'],
        datasets: [
            {
                label: labels[0],
                data: data1,
                borderColor: color_1,
                backgroundColor: color_1,
            },
            {
                label: labels[1],
                data: data2,
                borderColor: color_2,
                backgroundColor: color_2,
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
                    text: 'Chart.js Line Chart'
                }
            }
        },
    };

    return config;

}