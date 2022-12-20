var scatter_chart_draw = function (content, idx) {

    const DATA_COUNT = 7;
    let dataArray1 = [];
    let dataArray2 = [];
    let position = $('#chart_position').val();

    for(i=0; i<DATA_COUNT;i++)
    {
        dataArray1.push(Math.floor((Math.random() * 100) + 1));
        dataArray2.push(Math.floor((Math.random() * 100) + 1));
    }
    let color_1 = $('#color_1').val();
    let color_2 = $('#color_2').val();
    let label_1 = $('#label_1').val();
    let label_2 = $('#label_2').val();
    let labels  = ['January', 'February', 'March', 'April', 'May', 'June', 'July'];
    // alert(dataArray2);
    // alert(dataArray1);
    const data = {
        labels: labels,
        datasets: [
            {
                label: label_1,
                data: dataArray1,
                borderColor: color_1,
                backgroundColor: color_1,
            },
            {
                label: label_2,
                data: dataArray2,
                borderColor: color_2,
                backgroundColor: color_2,
            }
        ]
    };

    const config = {
        type: 'scatter',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: position,
                },
                title: {
                    display: true,
                    text: 'Chart.js Scatter Chart'
                }
            }
        },
    };

    return config;
}