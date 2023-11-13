function barChartHorizontal(series, locations, selector) {
    barChart(series, locations, selector, true, 'info');
}

function barChartVertical(series, locations, selector) {
    barChart(series, locations, selector, false, 'primary');
}

function barChart(series, locations, selector, horizontal, color) {
    var element = document.getElementById(selector);

    if (!element) {
        return;
    }
    // console.log(series,locations);
    var options = {
        series: series,
        chart: {
            type: 'bar',
            height: 370,
            toolbar: {
                show: true
            }
        },
        plotOptions: {
            bar: {
                horizontal: horizontal,
                columnWidth: ['30%'],
                endingShape: 'rounded'
            },
        },
        legend: {
            show: true
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: locations,
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false
            },
            labels: {
                style: {
                    colors: [SettingColor.primary_color, SettingColor.secondary_color, SettingColor.tertiary_color],
                    fontSize: '12px',
                     fontFamily: (LANG == 'ar' ? "Codec Pro" : KTAppSettings['font-family']),
                    rotate: LANG === "ar" ? 75 : -75
                }
            }
        },
        yaxis: {
            labels: {
                style: {
                    colors: [SettingColor.secondary_color, SettingColor.primary_color, SettingColor.tertiary_color],
                    fontSize: '12px',
                     fontFamily: (LANG == 'ar' ? "Codec Pro" : KTAppSettings['font-family']),
                }
            },
            opposite: LANG == 'ar'
        },
        fill: {
            opacity: 1
        },
        states: {
            normal: {
                filter: {
                    type: 'none',
                    value: 0
                }
            },
            hover: {
                filter: {
                    type: 'none',
                    value: 0
                }
            },
            active: {
                allowMultipleDataPointsSelection: false,
                filter: {
                    type: 'none',
                    value: 0
                }
            }
        },
        tooltip: {
            style: {
                fontSize: '12px',
                 fontFamily: (LANG == 'ar' ? "Codec Pro" : KTAppSettings['font-family']),
            },
            y: {
                formatter: function (val) {
                    return val
                }
            }
        },
        colors: [SettingColor.primary_color, SettingColor.secondary_color, SettingColor.tertiary_color],
        grid: {
            borderColor: KTAppSettings['colors']['gray']['gray-200'],
            strokeDashArray: 4,
            yaxis: {
                lines: {
                    show: true
                }
            }
        }
    };

    var chart = new ApexCharts(element, options);
    chart.render();
}

function areaChart(series, locations, selector){
    var element = document.getElementById(selector);

    if (!element) {
        return;
    }
    var options = {
        series: series,
        chart: {
            type: 'area',
            height: 350,
            toolbar: {
                show: true
            }
        },
        // plotOptions: {
        //     bar: {
        //         horizontal: false,
        //         columnWidth: ['30%'],
        //         endingShape: 'rounded'
        //     },
        // },
        legend: {
            show: false
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            // show: true,
            // width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: locations,
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false
            },
            labels: {
                style: {
                    colors: [SettingColor.primary_color, SettingColor.secondary_color, SettingColor.tertiary_color],
                    fontSize: '12px',
                    fontFamily: (LANG == 'ar' ? "Codec Pro" : KTAppSettings['font-family']),
                    rotate: LANG === "ar" ? 75 : -75
                }
            }
        },
        yaxis: {
            labels: {
                style: {
                    colors: [SettingColor.secondary_color, SettingColor.primary_color, SettingColor.tertiary_color],
                    fontSize: '12px',
                     fontFamily: (LANG == 'ar' ? "Codec Pro" : KTAppSettings['font-family']),
                }
            },

            opposite:LANG == 'ar'
        },
        fill: {
            opacity: 1
        },
        states: {
            normal: {
                filter: {
                    type: 'none',
                    value: 0
                }
            },
            hover: {
                filter: {
                    type: 'none',
                    value: 0
                }
            },
            active: {
                allowMultipleDataPointsSelection: false,
                filter: {
                    type: 'none',
                    value: 0
                }
            }
        },
        tooltip: {
            style: {
                fontSize: '12px',
                 fontFamily: (LANG == 'ar' ? "Codec Pro" : KTAppSettings['font-family']),
            },
            y: {
                formatter: function (val) {
                    return  val
                }
            }
        },
        colors: [SettingColor.primary_color, SettingColor.secondary_color, SettingColor.tertiary_color],
        grid: {
            borderColor: KTAppSettings['colors']['gray']['gray-200'],
            strokeDashArray: 4,
            yaxis: {
                lines: {
                    show: true
                }
            },
            padding: {
                left: 30,
                right: 30
              }
        }
    };

    var chart = new ApexCharts(element, options);
    chart.render();
}

function pieChart(result, selector) {
    var element = document.getElementById(selector);

    let options3 = {
        chart: {
            toolbar: {
                show: true
            },
            type: 'pie',
            width: "65%"
        },
        series: result.value,
        labels: result.name,
        plotOptions: {
            pie: {
                donut: {
                    size: '65%'
                }
            }
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val;
                }
            }
        },
        colors: [SettingColor.secondary_color, SettingColor.secondary_color, SettingColor.tertiary_color],
        grid: {
            borderColor: KTAppSettings['colors']['gray']['gray-200'],
            strokeDashArray: 4,
            yaxis: {
                lines: {
                    show: true
                }
            }
        }
    }

    var chart = new ApexCharts(element, options3);
    chart.render()
}
