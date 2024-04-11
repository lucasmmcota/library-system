let demo = {
    initDashboardPageCharts: function() {
        let chart_data = JSON.parse(document.getElementById("array-number-of-loans").value);

        let gradientChartOptionsConfigurationWithTooltipPurple = {
            maintainAspectRatio: false,
            legend: {display: false},

            tooltips: {
                backgroundColor: '#f5f5f5',
                titleFontColor: '#333',
                bodyFontColor: '#666',
                bodySpacing: 4,
                xPadding: 12,
                mode: "nearest",
                intersect: 0,
                position: "nearest"
            },

            responsive: true,
            scales: {
                yAxes: [{
                    barPercentage: 1.6,
                    gridLines: {
                        drawBorder: false,
                        color: 'rgba(29,140,248,0.0)',
                        zeroLineColor: "transparent"
                    },
                    ticks: {
                        suggestedMin: 0,
                        suggestedMax: Math.max(...chart_data) + 5,
                        padding: 20,
                        fontColor: "#9a9a9a"
                    }
                }],

                xAxes: [{
                    barPercentage: 1.6,
                    gridLines: {
                        drawBorder: false,
                        color: 'rgba(225,78,202,0.1)',
                        zeroLineColor: "transparent"
                    },
                    ticks: {padding: 20, fontColor: "#9a9a9a"}
                }]
            }
        };

        let ctx = document.getElementById("chartBig1").getContext('2d');
        
        let gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);
        gradientStroke.addColorStop(1, 'rgba(72,72,176,0.1)');
        gradientStroke.addColorStop(0.4, 'rgba(72,72,176,0.0)');
        gradientStroke.addColorStop(0, 'rgba(119,52,169,0)');

        let chart_labels = [
            'JAN', 'FEV', 'MAR', 'ABR', 'MAI', 'JUN', 'JUL', 'AGO', 'SET', 'OUT', 'NOV', 'DEZ'
        ];

        let config = {
            type: 'line',
            data: {
                labels: chart_labels,
                datasets: [{
                    label: "Número de Empréstimos",
                    fill: true,
                    backgroundColor: gradientStroke,
                    borderColor: '#40b17e',
                    borderWidth: 2,
                    borderDash: [],
                    borderDashOffset: 0.0,
                    pointBackgroundColor: '#40b17e',
                    pointBorderColor: 'rgba(255,255,255,0)',
                    pointHoverBackgroundColor: '#40b17e',
                    pointBorderWidth: 20,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 15,
                    pointRadius: 4,
                    data: chart_data
                }]
            },
            options: gradientChartOptionsConfigurationWithTooltipPurple
        };

        let myChartData = new Chart(ctx, config);
        let data = myChartData.config.data;
        data.datasets[0].data = chart_data;
        data.labels = chart_labels;
        myChartData.update();
    }
};