let currentColumn = -1;
let currentOrder = 1;

function sortTable(column) {
    const table = document.getElementById("tableSort");
    const tbody = table.querySelector("tbody");
    const rows = Array.from(tbody.querySelectorAll("tr"));
    const ths = table.querySelectorAll("th .arrow");

    ths.forEach(arrow => arrow.textContent = "");

    if (column === currentColumn) {
        currentOrder *= -1;
    } else {
        currentColumn = column;
        currentOrder = 1;
    }

    //ths[column].textContent = currentOrder === 1 ? "↓" : "↑";
    //ths[column].innerHTML = currentOrder === 1 ? "&#9660;" : "&#9650;";
    ths[column].innerHTML = currentOrder === 1 ? "&#11167;" : "&#11165;";

    rows.sort((a, b) => {
        const cellA = a.cells[column].textContent.trim();
        const cellB = b.cells[column].textContent.trim();

        const isNumber = !isNaN(cellA) && !isNaN(cellB);

        if (isNumber) {
            return (parseInt(cellA) - parseInt(cellB)) * currentOrder;
        } else {
            return cellA.localeCompare(cellB) * currentOrder;
        }
    });

    rows.forEach(row => tbody.removeChild(row));

    rows.forEach(row => tbody.appendChild(row));
}