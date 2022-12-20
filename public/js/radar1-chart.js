var radar1_chart_draw = function (content, idx) {
    const inputs = {
        min: 8,
        max: 16,
        count: 7,
        decimals: 2,
        continuity: 1
    };

    const generateLabels = () => {
        return ['January', 'February', 'March', 'April', 'May', 'June', 'July'];
    };

    let dataArray1 = [];
    let dataArray2 = [];
    let dataArray3 = [];
    let dataArray4 = [];
    let dataArray5 = [];
    let dataArray6 = [];
    let dataArray7 = [];
    let position = $('#chart_position').val();

    for(i=0; i<inputs.count;i++)
    {
        dataArray1.push(Math.floor((Math.random() * 100) + 1));
        dataArray2.push(Math.floor((Math.random() * 100) + 1));
        dataArray3.push(Math.floor((Math.random() * 100) + 1));
        dataArray4.push(Math.floor((Math.random() * 100) + 1));
        dataArray5.push(Math.floor((Math.random() * 100) + 1));
        dataArray6.push(Math.floor((Math.random() * 100) + 1));
        dataArray7.push(Math.floor((Math.random() * 100) + 1));
    }
    let color_1 = $('#color_1').val();
    let color_2 = $('#color_2').val();
    let label_1 = $('#label_1').val();
    let label_2 = $('#label_2').val();
    //
    // const generateData = () => {
    //     const values = Utils.numbers(inputs);
    //     inputs.from = values;
    //     return values;
    // };

    // const labels = Utils.months({count: 8});
    const data = {
        labels: generateLabels(),
        datasets: [
            {
                label: 'D0',
                data: dataArray1,
                borderColor: color_1,
                backgroundColor: color_1,
            },
            {
                label: 'D1',
                data: dataArray2,
                borderColor: color_2,
                hidden: true,
                backgroundColor: color_2,
                fill: '-1'
            },
            {
                label: 'D2',
                data: dataArray3,
                borderColor: 'yellow',
                backgroundColor: 'yellow',
                fill: 1
            },
            {
                label: 'D3',
                data: dataArray4,
                borderColor: 'green',
                backgroundColor: 'green',
                fill: false
            },
            {
                label: 'D4',
                data: dataArray5,
                borderColor: 'blue',
                backgroundColor: 'blue',
                fill: '-1'
            },
            {
                label: 'D5',
                data: dataArray6,
                borderColor: 'purple',
                backgroundColor: 'purple',
                fill: '-1'
            },
            {
                label: 'D6',
                data: dataArray7,
                borderColor: 'grey',
                backgroundColor: 'grey',
                fill: {value: 85}
            }
        ]
    };

    const config = {
        type: 'radar',
        data: data,
        options: {
            plugins: {
                legend: {
                    position: position,
                },
                filler: {
                    propagate: false
                },
                'samples-filler-analyser': {
                    target: 'chart-analyser'
                }
            },
            interaction: {
                intersect: false
            }
        }
    };

    return config;
}