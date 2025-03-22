document.addEventListener('DOMContentLoaded', function() {
//     // Simulated data
//     const totalProducts = 150; // Example data
//     const lowStockAlerts = 5; // Example data
//     const salesToday = 20; // Example data

//     // Update the dashboard with simulated data
//     document.getElementById('total-products').textContent = totalproducts;
//     document.getElementById('low-stock-alerts').textContent = lowStockAlerts;
//     document.getElementById('sales-today').textContent = salesToday;
// });


    const totalProducts = 150; // Example data
    const lowStockAlerts = 5; // Example data
    const salesToday = 20; // Example data

    // Update the dashboard with simulated data
    document.getElementById('total-products').textContent = totalProducts;
    document.getElementById('low-stock-alerts').textContent = lowStockAlerts;
    document.getElementById('sales-today').textContent = salesToday;

    // Add click event to buttons for interactivity
    const buttons = document.querySelectorAll('.button');
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            alert(`You clicked on ${this.textContent}`);
        });
    });
});