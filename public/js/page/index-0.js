"use strict";

document.addEventListener("DOMContentLoaded", function () {
    var statistics_chart = document.getElementById("myChart").getContext("2d");
    var currentChart;

    function fetchData(period) {
        fetch(`/chart?period=${period}`)
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.json();
            })
            .then((data) => {
                var labels = Object.keys(data);
                var values = Object.values(data);

                if (currentChart) {
                    currentChart.destroy();
                }
                var monthName = new Date().toLocaleString("default", {
                    month: "long",
                });

                currentChart = new Chart(statistics_chart, {
                    type: "line",
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: `Items Sold in ${
                                    period === "month" ? monthName : "the Week"
                                }`,
                                data: values,
                                fill: false,
                                borderColor: "rgb(75, 192, 192)",
                                tension: 0.1,
                            },
                        ],
                    },
                    options: {
                        legend: {
                            display: false,
                        },
                        scales: {
                            yAxes: [
                                {
                                    gridLines: {
                                        display: false,
                                        drawBorder: false,
                                    },
                                    ticks: {
                                        stepSize: 1,
                                    },
                                },
                            ],
                            xAxes: [
                                {
                                    gridLines: {
                                        color: "#fbfbfb",
                                        lineWidth: 2,
                                    },
                                },
                            ],
                        },
                        title: {
                            display: true,
                            text:
                                period === "month"
                                    ? `Statistics for ${monthName}`
                                    : "Statistics for the Week",
                        },
                    },
                });
            })
            .catch((error) =>
                console.error("Error fetching statistics data:", error)
            );
    }

    fetchData("week");

    document.querySelectorAll(".btn-group .btn").forEach((button) => {
        button.addEventListener("click", function (event) {
            event.preventDefault();

            document
                .querySelectorAll(".btn-group .btn")
                .forEach((btn) => btn.classList.remove("btn-primary"));

            this.classList.add("btn-primary");

            var period = this.getAttribute("data-period");
            fetchData(period);
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    var statistics_chart = document.getElementById("myChart2").getContext("2d");
    var currentChart;

    function getRandomColor() {
        var letters = "0123456789ABCDEF";
        var color = "#";
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    fetch(`/sold-items`)
        .then((response) => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json();
        })
        .then((data) => {
            var labels = Object.keys(data);
            var values = Object.values(data);

            var monthName = new Date().toLocaleString("default", {
                month: "long",
            });

            if (currentChart) {
                currentChart.destroy();
            }

            currentChart = new Chart(statistics_chart, {
                type: "bar",
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: `Items Sold Favorites`,
                            data: values,
                            borderWidth: 1,
                            backgroundColor: getRandomColor(),
                        },
                    ],
                },
                options: {
                    legend: {
                        display: false,
                    },
                    scales: {
                        yAxes: [
                            {
                                gridLines: {
                                    display: false,
                                    drawBorder: false,
                                },
                                ticks: {
                                    beginAtZero: true,
                                },
                            },
                        ],
                        xAxes: [
                            {
                                gridLines: {
                                    color: "#fbfbfb",
                                    lineWidth: 2,
                                },
                            },
                        ],
                    },
                },
            });
        })
        .catch((error) =>
            console.error("Error fetching sold items data:", error)
        );

    // Fetch data for the initial load (default to week)
});

document.addEventListener("DOMContentLoaded", function () {
    var statistics_chart = document.getElementById("myChart3").getContext("2d");
    var currentChart;

    var predefinedColors = [
        "#FF6384",
        "#36A2EB",
        "#FFCE56",
        "#4BC0C0",
        "#9966FF",
        "#FF9F40",
        "#E7E9ED",
    ];

    fetch(`/category-data`)
        .then((response) => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json();
        })
        .then((data) => {
            var labels = Object.keys(data);
            var values = Object.values(data);

            var monthName = new Date().toLocaleString("default", {
                month: "long",
            });

            if (currentChart) {
                currentChart.destroy();
            }

            currentChart = new Chart(statistics_chart, {
                type: "doughnut",
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: `Items Sold Favorite`,
                            data: values,
                            borderWidth: 1,
                            backgroundColor: predefinedColors,
                        },
                    ],
                },
                options: {
                    legend: { display: false },
                },
            });
            var legendHtml = chart.generateLegend();
            document.getElementById("chartLegend").innerHTML = legendHtml;
        })

        .catch((error) =>
            console.error("Error fetching sold items data:", error)
        );
});

$("#visitorMap").vectorMap({
    map: "world_en",
    backgroundColor: "#ffffff",
    borderColor: "#f2f2f2",
    borderOpacity: 0.8,
    borderWidth: 1,
    hoverColor: "#000",
    hoverOpacity: 0.8,
    color: "#ddd",
    normalizeFunction: "linear",
    selectedRegions: false,
    showTooltip: true,
    pins: {
        id: '<div class="jqvmap-circle"></div>',
        my: '<div class="jqvmap-circle"></div>',
        th: '<div class="jqvmap-circle"></div>',
        sy: '<div class="jqvmap-circle"></div>',
        eg: '<div class="jqvmap-circle"></div>',
        ae: '<div class="jqvmap-circle"></div>',
        nz: '<div class="jqvmap-circle"></div>',
        tl: '<div class="jqvmap-circle"></div>',
        ng: '<div class="jqvmap-circle"></div>',
        si: '<div class="jqvmap-circle"></div>',
        pa: '<div class="jqvmap-circle"></div>',
        au: '<div class="jqvmap-circle"></div>',
        ca: '<div class="jqvmap-circle"></div>',
        tr: '<div class="jqvmap-circle"></div>',
    },
});

// weather
getWeather();
setInterval(getWeather, 600000);

function getWeather() {
    $.simpleWeather({
        location: "Bogor, Indonesia",
        unit: "c",
        success: function (weather) {
            var html = "";
            html += '<div class="weather">';
            html +=
                '<div class="weather-icon text-primary"><span class="wi wi-yahoo-' +
                weather.code +
                '"></span></div>';
            html += '<div class="weather-desc">';
            html +=
                "<h4>" + weather.temp + "&deg;" + weather.units.temp + "</h4>";
            html += '<div class="weather-text">' + weather.currently + "</div>";
            html += "<ul><li>" + weather.city + ", " + weather.region + "</li>";
            html +=
                '<li> <i class="wi wi-strong-wind"></i> ' +
                weather.wind.speed +
                " " +
                weather.units.speed +
                "</li></ul>";
            html += "</div>";
            html += "</div>";

            $("#myWeather").html(html);
        },
        error: function (error) {
            $("#myWeather").html(
                '<div class="alert alert-danger">' + error + "</div>"
            );
        },
    });
}
