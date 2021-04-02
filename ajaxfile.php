<?php
$servername = "localhost";
$dbname = "id13842533_esp_data";
$username = "id13842533_esp_board";
$password = "rifandani098765Aa@";

// Create connection dengan OOP
$con = new mysqli($servername, $username, $password, $dbname);     // membuat object baru dengan nama conn dari class bawaan mysqli
// Check connection jika terjadi kesalahan
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value

## Search
$searchQuery = " ";
if($searchValue != ''){
   $searchQuery .= " and (id like '%".$searchValue."%' or
      value1 like '%".$searchValue."%' or
      value2 like '%".$searchValue."%' or
      value3 like '%".$searchValue."%' or
      value4 like '%".$searchValue."%' or
      value5 like '%".$searchValue."%' or
      value6 like '%".$searchValue."%' or
      value7 like '%".$searchValue."%' or
      value8 like '%".$searchValue."%' or
      reading_time like'%".$searchValue."%' ) ";
}

## Total number of records without filtering
$sel = mysqli_query($con,"select count(*) as allcount from Sensor");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($con,"select count(*) as allcount from Sensor WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$senQuery = "select * from Sensor WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$senRecords = mysqli_query($con, $senQuery);
$data = array();

while ($row = mysqli_fetch_assoc($senRecords)) {
   $data[] = array(
     "id"=>$row['id'],
     "value1"=>$row['value1'],
     "value2"=>$row['value2'],
     "value3"=>$row['value3'],
     "value4"=>$row['value4'],
     "value5"=>$row['value5'],
     "value6"=>$row['value6'],
     "value7"=>$row['value7'],
     "value8"=>$row['value8'],
     "reading_time"=>$row['reading_time']
   );
}

## Response
$response = array(
  "draw" => intval($draw),
  "iTotalRecords" => $totalRecords,
  "iTotalDisplayRecords" => $totalRecordwithFilter,
  "aaData" => $data
);

echo json_encode($response);