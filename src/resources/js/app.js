import "./bootstrap";

import "flowbite";

import Chart from "chart.js/auto";

window.renderSalesChart = (labels, totals) => {
    const ctx = document.getElementById("salesChart")?.getContext("2d");
    if (!ctx) return;

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: labels,
            datasets: [
                {
                    label: "Total de Vendas (R$)",
                    data: totals,
                    backgroundColor: "rgba(16, 185, 129, 1)",
                    borderColor: "rgba(16, 185, 129, 1)",
                    borderWidth: 2,
                    borderRadius: Number.MAX_VALUE,
                    borderSkipped: false,
                },
            ],
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true },
            },
        },
    });
};

// import Alpine from "alpinejs";

// window.Alpine = Alpine;

// Alpine.start();
