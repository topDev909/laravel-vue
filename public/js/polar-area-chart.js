var polar_area_chart_draw= function(content, idx) {

    const DATA_COUNT = 2;
    let dataArray1 = [];
    let dataArray2 = [];
    let labelArray = [];
    for(i=0; i<DATA_COUNT;i++)
    {
        dataArray1.push(Math.floor((Math.random() * 100) + 1));
        dataArray2.push(Math.floor((Math.random() * 100) + 1));
    }
    let color_1 = $('#color_1').val();
    let color_2 = $('#color_2').val();
    let position = $('#chart_position').val();
    let label_1 = $('#label_1').val();
    let label_2 = $('#label_2').val();

    const labels = [color_1, color_2];
    const data = {
        labels: labels,
        datasets: [
            {
                label: label_1,
                data: dataArray1,
                backgroundColor: labels
            }
        ]
    };

    const config = {
        type: 'polarArea',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: position,
                },
                title: {
                    display: true,
                    text: 'Chart.js Polar Area Chart'
                }
            }
        },
    };

    return config;


}; // end am4core.ready()

