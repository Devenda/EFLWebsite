 <?php
function getNr() {    
    include "serverInfo.php";

    $lastScan = date('Y-m-d H:i:s', strtotime('-5 seconds'));

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT row_id FROM test_presence WHERE scan_time >= '$lastScan' AND processed IS NULL";
    //echo $sql;

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo json_encode($row["row_id"]);
        }
    } else {
        echo json_encode("no entries");
    }
    $conn->close();
}


getNr();
?> 

