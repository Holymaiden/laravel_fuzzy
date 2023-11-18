"use strict";

var ctx = document.getElementById("myChart1").getContext('2d');
var myChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: [1, 1.5, 2.0, 2.5, 3.0, 3.5, 4.0],
    datasets: [{
      label: 'Sangat Baik',
      data: [0.0, 0.0, 0.0, 0.25, 0.5, 0.75, 1.0],
      borderWidth: 2,
      backgroundColor: 'transparent',
      borderColor: 'rgba(254,86,83,.7)',
      borderWidth: 2.5,
      pointBackgroundColor: 'transparent',
      pointBorderColor: 'transparent',
      pointRadius: 4
    },
    {
      label: 'Perlu Bimbingan',
      data: [1.0, 0.75, 0.5, 0.25, 0.0, 0.0,0.0],
      borderWidth: 2,
      backgroundColor: 'transparent',
      borderColor: 'rgba(63,82,227,.8)',
      borderWidth: 2.5,
      pointBackgroundColor: 'transparent',
      pointBorderColor: 'transparent',
      pointRadius: 4
    },
    ]
  },
  options: {
    legend: {
      display: true
    },
    scales: {
      yAxes: [{
        gridLines: {
          drawBorder: false,
          color: '#f2f2f2',
        },
        ticks: {
          beginAtZero: true,
          stepSize: 0.2
        }
      }],
      xAxes: [{
        gridLines: {
          display: false
        }
      }]
    },
  }
});

var ctx = document.getElementById("myChart2").getContext('2d');
var myChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: [1, 1.5, 2.0, 2.5, 3.0, 3.5, 4.0],
    datasets: [{
      label: 'Sangat Baik',
      data: [0.0, 0.0, 0.0, 0.25, 0.5, 0.75, 1.0],
      borderWidth: 2,
      backgroundColor: 'transparent',
      borderColor: 'rgba(254,86,83,.7)',
      borderWidth: 2.5,
      pointBackgroundColor: 'transparent',
      pointBorderColor: 'transparent',
      pointRadius: 4
    },
    {
      label: 'Perlu Bimbingan',
      data: [1.0, 0.75, 0.5, 0.25, 0.0, 0.0,0.0],
      borderWidth: 2,
      backgroundColor: 'transparent',
      borderColor: 'rgba(63,82,227,.8)',
      borderWidth: 2.5,
      pointBackgroundColor: 'transparent',
      pointBorderColor: 'transparent',
      pointRadius: 4
    },
    ]
  },
  options: {
    legend: {
      display: true
    },
    scales: {
      yAxes: [{
        gridLines: {
          drawBorder: false,
          color: '#f2f2f2',
        },
        ticks: {
          beginAtZero: true,
          stepSize: 0.2
        }
      }],
      xAxes: [{
        gridLines: {
          display: false
        }
      }]
    },
  }
});

var ctx = document.getElementById("myChart3").getContext('2d');
var myChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: [0, 20, 55, 60, 69, 83, 97 ,100],
    datasets: [{
      label: 'Sangat Baik',
      data: [0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.5, 1.0],
      borderWidth: 2,
      backgroundColor: 'transparent',
      borderColor: 'rgba(254,86,83,.7)',
      borderWidth: 2.5,
      pointBackgroundColor: 'transparent',
      pointBorderColor: 'transparent',
      pointRadius: 4
    },
    {
      label: 'Baik',
      data: [0.0, 0.0, 0.0, 0.0, 0.0, 1.0 , 0.0, 0.0],
      borderWidth: 2,
      backgroundColor: 'transparent',
      borderColor: 'rgba(124,252,0)',
      borderWidth:2.5,
      pointBackgroundColor: 'transparent',
      pointBorderColor: 'transparent',
      pointRadius: 4
      },
      {
        label: 'Cukup',
        data: [0.0, 0.0, 0.0, 0.5, 1.0, 0.0, 0.0,0.0],
        borderWidth: 2,
        backgroundColor: 'transparent',
        borderColor: 'rgba(255, 191, 0)',
        borderWidth: 2.5,
        pointBackgroundColor: 'transparent',
        pointBorderColor: 'transparent',
        pointRadius: 4
      },
      {
        label: 'Perlu Bimbingan',
        data: [1.0, 0.75, 0.50, 0.25, 0.0 ,0.0, 0.0,0.0],
        borderWidth: 2,
        backgroundColor: 'transparent',
        borderColor: 'rgba(63,82,227,.8)',
        borderWidth: 2.5,
        pointBackgroundColor: 'transparent',
        pointBorderColor: 'transparent',
        pointRadius: 4
      },
    ]
  },
  options: {
    legend: {
      display: true
    },
    scales: {
      yAxes: [{
        gridLines: {
          drawBorder: false,
          color: '#f2f2f2',
        },
        ticks: {
          beginAtZero: true,
          stepSize: 0.2
        }
      }],
      xAxes: [{
        gridLines: {
          display: false
        }
      }]
    },
  }
});

var ctx = document.getElementById("myChart4").getContext('2d');
var myChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: [0, 20, 57, 60, 70, 83, 96 ,100],
    datasets: [{
      label: 'Sangat Baik',
      data: [0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.5, 1.0],
      borderWidth: 2,
      backgroundColor: 'transparent',
      borderColor: 'rgba(254,86,83,.7)',
      borderWidth: 2.5,
      pointBackgroundColor: 'transparent',
      pointBorderColor: 'transparent',
      pointRadius: 4
    },
    {
      label: 'Baik',
      data: [0.0, 0.0, 0.0, 0.0, 0.0, 1.0 , 0.0, 0.0],
      borderWidth: 2,
      backgroundColor: 'transparent',
      borderColor: 'rgba(124,252,0)',
      borderWidth:2.5,
      pointBackgroundColor: 'transparent',
      pointBorderColor: 'transparent',
      pointRadius: 4
      },
      {
        label: 'Cukup',
        data: [0.0, 0.0, 0.0, 0.5, 1.0, 0.0, 0.0,0.0],
        borderWidth: 2,
        backgroundColor: 'transparent',
        borderColor: 'rgba(255, 191, 0)',
        borderWidth: 2.5,
        pointBackgroundColor: 'transparent',
        pointBorderColor: 'transparent',
        pointRadius: 4
      },
      {
        label: 'Perlu Bimbingan',
        data: [1.0, 0.75, 0.50, 0.25, 0.0 ,0.0, 0.0,0.0],
        borderWidth: 2,
        backgroundColor: 'transparent',
        borderColor: 'rgba(63,82,227,.8)',
        borderWidth: 2.5,
        pointBackgroundColor: 'transparent',
        pointBorderColor: 'transparent',
        pointRadius: 4
      },
    ]
  },
  options: {
    legend: {
      display: true
    },
    scales: {
      yAxes: [{
        gridLines: {
          drawBorder: false,
          color: '#f2f2f2',
        },
        ticks: {
          beginAtZero: true,
          stepSize: 0.2
        }
      }],
      xAxes: [{
        gridLines: {
          display: false
        }
      }]
    },
  }
});

var ctx = document.getElementById("myChart5").getContext('2d');
var myChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: [0, 20, 40, 60, 70, 77,80, 100],
    datasets: [{
      label: 'Berprestasi',
      data: [0.0, 0.0, 0.0, 0.0,0.0, 0.33,0.66, 1.0],
      borderWidth: 2,
      backgroundColor: 'transparent',
      borderColor: 'rgba(254,86,83,.7)',
      borderWidth: 2.5,
      pointBackgroundColor: 'transparent',
      pointBorderColor: 'transparent',
      pointRadius: 4
    },
    {
      label: 'Tidak Berpestasi',
      data: [1.0, 1.0, 1.0, 0.66, 0.33,0.0, 0.0,0.0],
      borderWidth: 2,
      backgroundColor: 'transparent',
      borderColor: 'rgba(124,252,0)',
      borderWidth: 2.5,
      pointBackgroundColor: 'transparent',
      pointBorderColor: 'transparent',
      pointRadius: 4
      },
    ]
  },
  options: {
    legend: {
      display: true
    },
    scales: {
      yAxes: [{
        gridLines: {
          drawBorder: false,
          color: '#f2f2f2',
        },
        ticks: {
          beginAtZero: true,
          stepSize: 0.2
        }
      }],
      xAxes: [{
        gridLines: {
          display: false
        }
      }]
    },
  }
});