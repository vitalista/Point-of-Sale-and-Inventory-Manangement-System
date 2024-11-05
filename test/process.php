<?php
// Connect to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mnj_inventory";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get selected week from the form
if(isset($_GET['week'])) {
    $selected_week = $_GET['week'];
    
    // Format the selected week to match MySQL format
    $selected_week = date('Y-m-d', strtotime($selected_week));
    
    // Query to retrieve items for the selected week
    $sql = "SELECT * FROM order_items WHERE WEEK(item_date) = WEEK('$selected_week')";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "Item: " . $row["product_id"]. "<br>";
            // Output other item details as needed
        }
    } else {
        echo "No items found for the selected week.";
    }
} else {
    echo "Please select a week.";
}

$conn->close();
?>

<div id="chart_div" style="width: 900px; height: 500px;"></div>

    <script type="text/javascript">
        // Load the Visualization API and the corechart package.
        google.charts.load('current', {'packages':['corechart']});

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            // Sample data
            var data = google.visualization.arrayToDataTable([
                ['Date', 'Product A', 'Product B', 'Product C'],
                [new Date('2024-05-01'), 12, 5, 10],
                [new Date('2024-05-02'), 19, 8, 15],
                [new Date('2024-05-03'), 3, 15, 7],
                [new Date('2024-05-04'), 5, 10, 8],
                [new Date('2024-05-05'), 2, 3, 20]
            ]);

            // Set chart options
            var options = {
                title: 'Product Quantity',
                hAxis: {
                    title: 'Date'
                },
                vAxis: {
                    title: 'Quantity'
                },
                pointSize: 10
            };

            // Instantiate and draw the chart.
            var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>