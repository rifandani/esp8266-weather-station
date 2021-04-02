<?php

$servername = "localhost";

// REPLACE with your Database name
$dbname = "id13842533_esp_data"; // esp_data
// REPLACE with Database user
$username = "id13842533_esp_board"; // esp_board
// REPLACE with Database user password
$password = "rifandani098765Aa@"; //098765Aa@

// Keep this API Key value to be compatible with the ESP32 code provided in the project page. If you change this value, the ESP32 sketch needs to match
$api_key_value = "tPmAT5Ab3j7F9";

$api_key = $value1 = $value2 = $value3 = $value4 = $value5 = $value6 = $value7 = $value8 = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {     //mengecek apakah data sudah di submit atau belum
    $api_key = test_input($_POST["api_key"]);
    if($api_key == $api_key_value) {
        $value1 = test_input($_POST["value1"]); //temp BMP280
        $value2 = test_input($_POST["value2"]); //altitude BMP280
        $value3 = test_input($_POST["value3"]); //pressure BMP280
        $value4 = test_input($_POST["value4"]); //heatindex DHT11
        $value5 = test_input($_POST["value5"]); //humidity DHT11
        $value6 = test_input($_POST["value6"]); //temp DHT11
        $value7 = test_input($_POST["value7"]); //lux BH1750
        $value8 = test_input($_POST["value8"]); //flame

        // Create connection using OOP
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO Sensor (value1, value2, value3, value4, value5, value6, value7, value8) VALUES ('" . $value1 . "', '" . $value2 . "', '" . $value3 . "', '" . $value4 . "', '" . $value5 . "', '" . $value6 . "', '" . $value7 . "', '" . $value8 . "')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        }
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    else {
        echo "Wrong API Key provided.";
    }

}
else {
    echo "No data posted with HTTP POST.";
}

function test_input($data) {                    //fungsi (test_input) dengan parameter (data) untuk alasan keamanan input data yang masuk
    $data = trim($data);                        //strip unnecessary characters (extra space, tab, newline) dari awal sampai akhir data String
    $data = stripslashes($data);                //Remove backslashes (\) from the user input data / Un-quotes a quoted string
    $data = htmlspecialchars($data);            //Convert special character menjadi HTML entities, sehingga lebih aman mencegah XSS
    return $data;
}