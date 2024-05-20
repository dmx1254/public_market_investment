document.addEventListener("DOMContentLoaded", function () {
  // Initialiser Chart.js pour les données historiques
  var ctx1 = document.getElementById("publicMarketsChart").getContext("2d");
  var publicMarketsChart = new Chart(ctx1, {
    type: "line",
    data: {
      labels: [
        "2016",
        "2017",
        "2018",
        "2019",
        "2020",
        "2021",
        "2022",
        "2023",
        "2024",
      ],
      datasets: [
        {
          label: "Marchés publics (en milliards de MAD)",
          data: [500, 600, 700, 800, 850, 900, 950, 1000, 1100],
          backgroundColor: "rgba(54, 162, 235, 0.2)",
          borderColor: "rgba(54, 162, 235, 1)",
          borderWidth: 3,
          pointBackgroundColor: "rgba(54, 162, 235, 1)",
          pointBorderColor: "#fff",
          pointHoverBackgroundColor: "#fff",
          pointHoverBorderColor: "rgba(54, 162, 235, 1)",
          fill: true,
        },
      ],
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: true,
          position: "top",
          labels: {
            color: "rgba(54, 162, 235, 1)",
            font: {
              size: 14,
              weight: "bold",
            },
          },
        },
        title: {
          display: true,
          text: "Évolution des marchés publics marocains (2016-2024)",
          color: "#2C3E50",
          font: {
            size: 18,
            weight: "bold",
          },
          padding: {
            top: 10,
            bottom: 30,
          },
        },
        tooltip: {
          backgroundColor: "#2C3E50",
          titleFont: {
            size: 16,
            weight: "bold",
          },
          bodyFont: {
            size: 14,
          },
          cornerRadius: 4,
          caretPadding: 10,
        },
      },
      scales: {
        x: {
          title: {
            display: true,
            text: "Année",
            color: "#2C3E50",
            font: {
              size: 16,
              weight: "bold",
            },
          },
          ticks: {
            color: "#2C3E50",
            font: {
              size: 14,
            },
          },
        },
        y: {
          title: {
            display: true,
            text: "Valeur (en milliards de MAD)",
            color: "#2C3E50",
            font: {
              size: 16,
              weight: "bold",
            },
          },
          ticks: {
            color: "#2C3E50",
            font: {
              size: 14,
            },
          },
        },
      },
    },
  });

  // Calcul de la croissance annuelle moyenne
  var dataHistorical = [500, 600, 700, 800, 850, 900, 950, 1000, 1100];
  var totalGrowth = 0;
  for (var i = 1; i < dataHistorical.length; i++) {
    totalGrowth +=
      (dataHistorical[i] - dataHistorical[i - 1]) / dataHistorical[i - 1];
  }
  var avgAnnualGrowth = totalGrowth / (dataHistorical.length - 1);

  // Projections futures basées sur la croissance annuelle moyenne
  var projectedData = [1100]; // Dernière valeur connue pour 2024
  for (var year = 2025; year <= 2030; year++) {
    projectedData.push(
      projectedData[projectedData.length - 1] * (1 + avgAnnualGrowth)
    );
  }

  // Initialiser Chart.js pour les projections futures
  var ctx2 = document
    .getElementById("publicMarketsProjectionChart")
    .getContext("2d");
  var publicMarketsProjectionChart = new Chart(ctx2, {
    type: "line",
    data: {
      labels: ["2024", "2025", "2026", "2027", "2028", "2029", "2030"],
      datasets: [
        {
          label: "Projections des marchés publics (en milliards de MAD)",
          data: projectedData,
          backgroundColor: "rgba(255, 99, 132, 0.2)",
          borderColor: "rgba(255, 99, 132, 1)",
          borderWidth: 3,
          pointBackgroundColor: "rgba(255, 99, 132, 1)",
          pointBorderColor: "#fff",
          pointHoverBackgroundColor: "#fff",
          pointHoverBorderColor: "rgba(255, 99, 132, 1)",
          fill: true,
        },
      ],
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: true,
          position: "top",
          labels: {
            color: "rgba(255, 99, 132, 1)",
            font: {
              size: 14,
              weight: "bold",
            },
          },
        },
        title: {
          display: true,
          text: "Projections des marchés publics marocains (2025-2030)",
          color: "#2C3E50",
          font: {
            size: 18,
            weight: "bold",
          },
          padding: {
            top: 10,
            bottom: 30,
          },
        },
        tooltip: {
          backgroundColor: "#1b4332",
          titleFont: {
            size: 16,
            weight: "bold",
          },
          bodyFont: {
            size: 14,
          },
          cornerRadius: 4,
          caretPadding: 10,
        },
      },
      scales: {
        x: {
          title: {
            display: true,
            text: "Année",
            color: "#2C3E50",
            font: {
              size: 16,
              weight: "bold",
            },
          },
          ticks: {
            color: "#2C3E50",
            font: {
              size: 14,
            },
          },
        },
        y: {
          title: {
            display: true,
            text: "Valeur (en milliards de MAD)",
            color: "#2C3E50",
            font: {
              size: 16,
              weight: "bold",
            },
          },
          ticks: {
            color: "#2C3E50",
            font: {
              size: 14,
            },
          },
        },
      },
    },
  });

  // Initialiser FullCalendar avec les heures d'ouverture et de fermeture
  var calendarEl = document.getElementById("calendar");
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: "timeGridWeek",
    headerToolbar: {
      left: "prev,next today",
      center: "title",
      right: "dayGridMonth,timeGridWeek,timeGridDay",
    },
    locale: "fr",
    businessHours: [
      {
        // Lundi - Vendredi
        daysOfWeek: [1, 2, 3, 4, 5],
        startTime: "08:00",
        endTime: "16:00",
      },
      {
        // Samedi
        daysOfWeek: [6],
        startTime: "09:00",
        endTime: "12:00",
      },
    ],
    events: [
      {
        title: "Heures d'ouverture",
        startTime: "08:00",
        endTime: "16:00",
        daysOfWeek: [1, 2, 3, 4, 5],
        display: "background",
        backgroundColor: "#2ecc71",
        textColor: "#FFFFFF",
      },
      {
        title: "Heures d'ouverture",
        startTime: "09:00",
        endTime: "12:00",
        daysOfWeek: [6],
        display: "background",
        backgroundColor: "#2ecc71",
        textColor: "#FFFFFF",
      },
      {
        title: "Heures de fermeture",
        startTime: "16:00",
        endTime: "16:15",
        daysOfWeek: [1, 2, 3, 4, 5],
        display: "background",
        backgroundColor: "#FFFFFF",
        textColor: "#000000",
      },
      {
        title: "Heures de fermeture",
        startTime: "16:00",
        endTime: "16h:15",
        daysOfWeek: [6],
        display: "background",
        backgroundColor: "#FFFFFF",
        textColor: "#000000",
      },
    ],
  });
  calendar.render();
});
