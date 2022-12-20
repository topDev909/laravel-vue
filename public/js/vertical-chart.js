var vertical_chart_draw = function(content, idx) {
  const DATA_COUNT = 2;
  let dataArray1 = [];
  let dataArray2 = [];
  let labelArray = [];
  let position = $('#chart_position').val();
  for(i=0; i<DATA_COUNT;i++)
  {
    dataArray1.push(Math.floor((Math.random() * 100) + 1));
    dataArray2.push(Math.floor((Math.random() * 100) + 1));
    labelArray.push($('#label_' + (i+1)).val());
  }
  let color_1 = $('#color_1').val();
  let color_2 = $('#color_2').val();

  const data = {
    labels: labelArray,
    datasets: [
      {
        label: labelArray[0],
        data: dataArray1,
        borderColor: color_1,
        backgroundColor: color_1,
      },
      {
        label: labelArray[1],
        data: dataArray2,
        borderColor: color_2,
        backgroundColor: color_2,
      }
    ]
  };

  const config = {
    type: 'bar',
    data: data,
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: position,
        },
        title: {
          display: true,
          text: 'Chart.js Bar Chart'
        }
      }
    },
  };

  return config;

};

