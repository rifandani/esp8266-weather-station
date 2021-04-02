<?php

  $servername = "localhost";

  // REPLACE with your Database name
  $dbname = "id13842533_esp_data"; // esp_data
  // REPLACE with Database user
  $username = "id13842533_esp_board"; // esp_board
  // REPLACE with Database user password
  $password = "rifandani098765Aa@"; //098765Aa@

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // sql query
  $sql = "SELECT id, value1, value2, value3, value4, value5, value6, value7, value8, reading_time FROM Sensor order by reading_time desc limit 40";

  $result = $conn->query($sql);

  while ($data = $result->fetch_assoc()){
    $sensor_data[] = $data;
  }

  $readings_time = array_column($sensor_data, 'reading_time');

  $i = 0;
  foreach ($readings_time as $reading){
    $readings_time[$i] = date("Y-m-d H:i:s", strtotime("$reading + 7 hours"));
    $i += 1;
  }

  $value1 = json_encode(array_reverse(array_column($sensor_data, 'value1')), JSON_NUMERIC_CHECK);
  $value2 = json_encode(array_reverse(array_column($sensor_data, 'value2')), JSON_NUMERIC_CHECK);
  $value3 = json_encode(array_reverse(array_column($sensor_data, 'value3')), JSON_NUMERIC_CHECK);
  $value4 = json_encode(array_reverse(array_column($sensor_data, 'value4')), JSON_NUMERIC_CHECK);
  $value5 = json_encode(array_reverse(array_column($sensor_data, 'value5')), JSON_NUMERIC_CHECK);
  $value6 = json_encode(array_reverse(array_column($sensor_data, 'value6')), JSON_NUMERIC_CHECK);
  $value7 = json_encode(array_reverse(array_column($sensor_data, 'value7')), JSON_NUMERIC_CHECK);
  $value8 = json_encode(array_reverse(array_column($sensor_data, 'value8')), JSON_NUMERIC_CHECK);
  $reading_time = json_encode(array_reverse($readings_time), JSON_NUMERIC_CHECK);

  /*echo $value1;
  echo $value2;
  echo $value3;
  echo $value4;
  echo $value5;
  echo $value6;
  echo $value7;
  echo $value8;
  echo $reading_time; */

  $result->free();
  $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta
      name="description"
      content="ESP8266 Weather Station Web Application"
    />
    <meta name="author" content="Tri Rizeki Rifandani" />

    <title>Weather Station</title>

    <!-- Custom fonts for this template-->
    <link
      href="vendor/fontawesome-free/css/all.min.css"
      rel="stylesheet"
      type="text/css"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
      rel="stylesheet"
    />

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet" />

    <!-- Highcharts -->
    <script src="https://code.highcharts.com/highcharts.js"></script>

    <!-- Icons-->
    <link rel="icon" sizes="32x32" href="img/icons/icon-32x32.png" />
    <link
      rel="apple-touch-icon"
      sizes="32x32"
      href="img/icons/icon-32x32.png"
    />
    <link rel="icon" sizes="128x128" href="img/icons/icon-128x128.png" />
    <link
      rel="apple-touch-icon"
      sizes="128x128"
      href="img/icons/icon-128x128.png"
    />
    <link rel="icon" sizes="144x144" href="img/icons/icon-144x144.png" />
    <link
      rel="apple-touch-icon"
      sizes="144x144"
      href="img/icons/icon-144x144.png"
    />
    <link rel="icon" sizes="152x152" href="img/icons/icon-152x152.png" />
    <link
      rel="apple-touch-icon"
      sizes="152x152"
      href="img/icons/icon-152x152.png"
    />
    <link rel="icon" sizes="192x192" href="img/icons/icon-192x192.png" />
    <link
      rel="apple-touch-icon"
      sizes="192x192"
      href="img/icons/icon-192x192.png"
    />
    <link rel="icon" sizes="256x256" href="img/icons/icon-256x256.png" />
    <link
      rel="apple-touch-icon"
      sizes="256x256"
      href="img/icons/icon-256x256.png"
    />
    <link rel="icon" sizes="512x512" href="img/icons/icon-512x512.png" />
    <link
      rel="apple-touch-icon"
      sizes="512x512"
      href="img/icons/icon-512x512.png"
    />

    <style>
      html {
        scroll-behavior: smooth;
      }
    </style>
  </head>

  <body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
      <!-- Sidebar -------------------------------------------------------------------------------------------------------------------------------------->
      <ul
        class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
        id="accordionSidebar"
      >
        <!-- Sidebar - Brand -->
        <a
          class="sidebar-brand d-flex align-items-center justify-content-center"
          href="index.html"
        >
          <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-cloud-sun"></i>
          </div>
          <div class="sidebar-brand-text mx-3">Weather Station</div>
        </a>

        <!-- Divider ---->
        <hr class="sidebar-divider my-0" />

        <!-- Nav Item - Home -->
        <li class="nav-item active">
          <a class="nav-link" href="#page-top">
            <i class="fas fa-fw fa-home"></i>
            <span>Home</span></a
          >
        </li>

        <!-- Nav Item - Chart -->
        <li class="nav-item">
          <a class="nav-link" href="#chart-section">
            <i class="fas fa-fw fa-chart-line"></i>
            <span>Chart</span></a
          >
        </li>

        <!-- Nav Item - Forecast -->
        <li class="nav-item">
          <a class="nav-link" href="#forecast-section">
            <i class="fas fa-fw fa-sun"></i>
            <span>Forecast</span></a
          >
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider" />

        <!-- Heading -->
        <div class="sidebar-heading">
          Pages
        </div>

        <!-- Nav Item - Tables -->
        <li class="nav-item">
          <a
            class="nav-link"
            href="https://rifandani2505.000webhostapp.com/tabel.html"
          >
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a
          >
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block" />

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
      </ul>
      <!-- End of Sidebar -------------------------------------------------------------------------------------------------------------------------------------->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column mt-4">
        <!-- Main Content -->
        <div id="content">
          <!-- Begin Page Content -->
          <div class="container-fluid">
            <!-- Page Heading -->
            <div
              class="d-sm-flex align-items-center justify-content-between mb-4"
            >
              <h1 class="h3 mb-0 text-gray-800">Home</h1>
            </div>

            <!-- Author & Latar Belakang Row -->
            <div class="row" id="about-section">
              <!-- Author Column -->
              <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                <div class="card shadow mb-4 border-left-primary">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                      Author
                    </h6>
                  </div>
                  <!-- Card Body -->
                  <div class="card-body">
                    <div class="row justify-content-center align-items-center">
                      <div class="col align-self-center text-center">
                        <img
                          class="img-fluid"
                          style="width: 9rem; border-radius: 1rem;"
                          src="img/team/blue.png"
                          alt="Tri Rizeki Rifandani"
                        />
                      </div>

                      <div class="col align-self-center text-center">
                        <p class="text-center">
                          <strong>Tri Rizeki Rifandani</strong>
                          <br />
                          <br />
                          Pendidikan Teknik Mekatronika
                          <br />
                          Universitas Negeri Yogyakarta
                        </p>
                        <div class="text-center">
                          <a
                            href="https://github.com/rifandani"
                            class="btn btn-secondary btn-circle mr-2"
                            target="_blank"
                            rel="nofollow"
                          >
                            <i class="fab fa-github"></i>
                          </a>
                          <a
                            href="https://linkedin.com/in/rifandani"
                            class="btn btn-primary btn-circle mr-2"
                            target="_blank"
                            rel="nofollow"
                          >
                            <i class="fab fa-linkedin"></i>
                          </a>
                          <a
                            href="https://rifandani-blog.netlify.app/"
                            class="btn btn-info btn-circle"
                            target="_blank"
                            rel="nofollow"
                          >
                            <i class="fas fa-link"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- End Card Body -->
                </div>
              </div>
              <!-- End Author Column -->

              <!-- Latar Belakang Column -->
              <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                <div class="card shadow mb-4 border-left-info">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">
                      Latar Belakang
                    </h6>
                  </div>
                  <div class="card-body">
                    <p>
                      Belum lama ini Negara Australia mengalami kebakaran hutan
                      yang sangat dahsyat tepatnya sejak akhir July 2019. Hal
                      ini sangat disayangkan, karenanya sebanyak 27 orang
                      meninggal dunia dan lebih dari 2000 rumah hancur, belum
                      lagi hewan dan tanaman yang ikut terkena dampaknya.
                      Kebakaran ini disebabkan suhu panas yang tinggi dan
                      kekeringan serta perubahan iklim mengubah kondisinya
                      menjadi lebih buruk.
                    </p>
                    <p class="mb-0">
                      Project ini terinspirasi oleh peristiwa tersebut dengan
                      harapan project ini dapat memantau kondisi cuaca &
                      lingkungan sekitar sehingga dapat mencegah jika
                      sewaktu-waktu suhu mencapai titik yang mengkhawatirkan.
                      Project ini juga dapat diimplementasikan di berbagai
                      sektor, baik itu untuk kebun, sawah, hutan, ataupun tempat
                      lainnya yang sekiranya butuh untuk dimonitoring secara
                      real-time.
                    </p>
                  </div>
                </div>
              </div>
              <!-- End Latar Belakang Column -->
            </div>
            <!-- End Author & Latar Belakang Row ------------------------------------------------------------------------------------>

            <!-- Panduan & Jobsheet Row -->
            <div class="row" id="panduan-section">
              <!-- Panduan Column -->
              <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                <div class="card shadow mb-4 border-left-warning">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-warning">
                      Panduan
                    </h6>
                  </div>
                  <!-- Card Body -->
                  <div class="card-body">
                    <div class="row justify-content-center align-items-center">
                      <div class="col align-self-center text-center">
                        <img
                          class="img-fluid"
                          style="width: 9rem; border-radius: 1rem;"
                          src="img/undraw_posting_photo.svg"
                          alt="Panduan"
                        />
                      </div>

                      <div class="col align-self-center text-center">
                        <p class="text-left">
                          Untuk memudahkan para siswa dalam mempelajari media,
                          maka developer menyediakan buku panduan yang dapat di
                          download secara online. Panduan penggunaan modul ini
                          dapat anda download melalui tombol berikut.
                        </p>
                        <div class="text-left">
                          <a href="#" class="btn btn-warning btn-icon-split">
                            <span class="icon text-white-50">
                              <i class="fas fa-cloud-download-alt"></i>
                            </span>
                            <span class="text">Download</span>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- End Card Body -->
                </div>
              </div>
              <!-- End Panduan Column -->

              <!-- Jobsheet Column -->
              <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                <div class="card shadow mb-4 border-left-success">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">
                      Jobsheet
                    </h6>
                  </div>
                  <!-- Card Body -->
                  <div class="card-body">
                    <div class="row justify-content-center align-items-center">
                      <div class="col align-self-center text-center">
                        <img
                          class="img-fluid"
                          style="width: 9rem; border-radius: 1rem;"
                          src="img/undraw_posting_photo.svg"
                          alt="Jobsheet"
                        />
                      </div>

                      <div class="col align-self-center text-center">
                        <p class="text-left">
                          Untuk memudahkan para siswa dalam mempelajari media,
                          maka developer menyediakan modul jobsheet yang dapat
                          di download secara online. Modul ini dapat anda
                          download melalui tombol berikut.
                        </p>
                        <div class="text-left">
                          <a href="#" class="btn btn-success btn-icon-split">
                            <span class="icon text-white-50">
                              <i class="fas fa-cloud-download-alt"></i>
                            </span>
                            <span class="text">Download</span>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- End Card Body -->
                </div>
              </div>
              <!-- End Jobsheet Column -->
            </div>
            <!-- End Panduan & Jobsheet Row -->

            <!-- Temperature Chart ---------------------------------------------------------------------------------------->
            <div class="row" id="chart-section">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card shadow mb-4 border-bottom-warning">
                  <!-- Card Header - Dropdown -->
                  <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                  >
                    <h6 class="m-0 font-weight-bold text-warning">
                      Temperature Charts
                    </h6>
                    <div class="dropdown no-arrow">
                      <a
                        class="dropdown-toggle"
                        href="#"
                        role="button"
                        id="dropdownMenuLink"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i
                          class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"
                        ></i>
                      </a>
                      <div
                        class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink"
                      >
                        <div class="dropdown-header">
                          Delay antara pembacaan sensor yaitu 10 detik
                        </div>
                        <a class="dropdown-item" href="#">Sensor BMP280</a>
                      </div>
                    </div>
                  </div>
                  <!-- End Card Header - Dropdown -->

                  <!-- Card Body -->
                  <div class="card-body">
                    <div class="container">
                      <div id="chart-temperature"></div>
                    </div>
                  </div>
                  <!-- End Card Body -->
                </div>
              </div>
            </div>
            <!-- End Temperature Chart -->

            <!-- Altitude Chart ---------------------------------------------------------------------------------------->
            <div class="row">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card shadow mb-4 border-bottom-success">
                  <!-- Card Header - Dropdown -->
                  <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                  >
                    <h6 class="m-0 font-weight-bold text-success">
                      Altitude Charts
                    </h6>
                    <div class="dropdown no-arrow">
                      <a
                        class="dropdown-toggle"
                        href="#"
                        role="button"
                        id="dropdownMenuLink"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i
                          class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"
                        ></i>
                      </a>
                      <div
                        class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink"
                      >
                        <div class="dropdown-header">
                          Delay antara pembacaan sensor yaitu 10 detik
                        </div>
                        <a class="dropdown-item" href="#">Sensor BMP280</a>
                      </div>
                    </div>
                  </div>
                  <!-- End Card Header - Dropdown -->

                  <!-- Card Body -->
                  <div class="card-body">
                    <div class="container">
                      <div id="chart-altitude"></div>
                    </div>
                  </div>
                  <!-- End Card Body -->
                </div>
              </div>
            </div>
            <!-- End Altitude Chart -->

            <!-- Pressure Chart ---------------------------------------------------------------------------------------->
            <div class="row">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card shadow mb-4 border-bottom-primary">
                  <!-- Card Header - Dropdown -->
                  <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                  >
                    <h6 class="m-0 font-weight-bold text-primary">
                      Pressure Charts
                    </h6>
                    <div class="dropdown no-arrow">
                      <a
                        class="dropdown-toggle"
                        href="#"
                        role="button"
                        id="dropdownMenuLink"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i
                          class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"
                        ></i>
                      </a>
                      <div
                        class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink"
                      >
                        <div class="dropdown-header">
                          Delay antara pembacaan sensor yaitu 10 detik
                        </div>
                        <a class="dropdown-item" href="#">Sensor BMP280</a>
                      </div>
                    </div>
                  </div>
                  <!-- End Card Header - Dropdown -->

                  <!-- Card Body -->
                  <div class="card-body">
                    <div class="container">
                      <div id="chart-pressure"></div>
                    </div>
                  </div>
                  <!-- End Card Body -->
                </div>
              </div>
            </div>
            <!-- End Pressure Chart -->

            <!-- Heat Chart ---------------------------------------------------------------------------------------->
            <div class="row">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card shadow mb-4 border-bottom-danger">
                  <!-- Card Header - Dropdown -->
                  <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                  >
                    <h6 class="m-0 font-weight-bold text-danger">
                      Heat Charts
                    </h6>
                    <div class="dropdown no-arrow">
                      <a
                        class="dropdown-toggle"
                        href="#"
                        role="button"
                        id="dropdownMenuLink"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i
                          class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"
                        ></i>
                      </a>
                      <div
                        class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink"
                      >
                        <div class="dropdown-header">
                          Delay antara pembacaan sensor yaitu 10 detik
                        </div>
                        <a class="dropdown-item" href="#">Sensor DHT11</a>
                      </div>
                    </div>
                  </div>
                  <!-- End Card Header - Dropdown -->

                  <!-- Card Body -->
                  <div class="card-body">
                    <div class="container">
                      <div id="chart-heat"></div>
                    </div>
                  </div>
                  <!-- End Card Body -->
                </div>
              </div>
            </div>
            <!-- End Heat Chart -->

            <!-- Humidity Chart ---------------------------------------------------------------------------------------->
            <div class="row">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card shadow mb-4 border-bottom-warning">
                  <!-- Card Header - Dropdown -->
                  <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                  >
                    <h6 class="m-0 font-weight-bold text-warning">
                      Humidity Charts
                    </h6>
                    <div class="dropdown no-arrow">
                      <a
                        class="dropdown-toggle"
                        href="#"
                        role="button"
                        id="dropdownMenuLink"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i
                          class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"
                        ></i>
                      </a>
                      <div
                        class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink"
                      >
                        <div class="dropdown-header">
                          Delay antara pembacaan sensor yaitu 10 detik
                        </div>
                        <a class="dropdown-item" href="#">Sensor DHT11</a>
                      </div>
                    </div>
                  </div>
                  <!-- End Card Header - Dropdown -->

                  <!-- Card Body -->
                  <div class="card-body">
                    <div class="container">
                      <div id="chart-humidity"></div>
                    </div>
                  </div>
                  <!-- End Card Body -->
                </div>
              </div>
            </div>
            <!-- End Humidity Chart -->

            <!-- DHT11 Temperature Chart ---------------------------------------------------------------------------------------->
            <div class="row">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card shadow mb-4 border-bottom-warning">
                  <!-- Card Header - Dropdown -->
                  <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                  >
                    <h6 class="m-0 font-weight-bold text-warning">
                      Temperature Charts
                    </h6>
                    <div class="dropdown no-arrow">
                      <a
                        class="dropdown-toggle"
                        href="#"
                        role="button"
                        id="dropdownMenuLink"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i
                          class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"
                        ></i>
                      </a>
                      <div
                        class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink"
                      >
                        <div class="dropdown-header">
                          Delay antara pembacaan sensor yaitu 10 detik
                        </div>
                        <a class="dropdown-item" href="#">Sensor DHT11</a>
                      </div>
                    </div>
                  </div>
                  <!-- End Card Header - Dropdown -->

                  <!-- Card Body -->
                  <div class="card-body">
                    <div class="container">
                      <div id="chart-dht-temperature"></div>
                    </div>
                  </div>
                  <!-- End Card Body -->
                </div>
              </div>
            </div>
            <!-- End Temperature Chart -->

            <!-- Lux Chart ---------------------------------------------------------------------------------------->
            <div class="row">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card shadow mb-4 border-bottom-info">
                  <!-- Card Header - Dropdown -->
                  <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                  >
                    <h6 class="m-0 font-weight-bold text-info">
                      Lux Charts
                    </h6>
                    <div class="dropdown no-arrow">
                      <a
                        class="dropdown-toggle"
                        href="#"
                        role="button"
                        id="dropdownMenuLink"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i
                          class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"
                        ></i>
                      </a>
                      <div
                        class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink"
                      >
                        <div class="dropdown-header">
                          Delay antara pembacaan sensor yaitu 10 detik
                        </div>
                        <a class="dropdown-item" href="#">Sensor BH1750</a>
                      </div>
                    </div>
                  </div>
                  <!-- End Card Header - Dropdown -->

                  <!-- Card Body -->
                  <div class="card-body">
                    <div class="container">
                      <div id="chart-lux"></div>
                    </div>
                  </div>
                  <!-- End Card Body -->
                </div>
              </div>
            </div>
            <!-- End Lux Chart -->

            <!-- Flame Chart ---------------------------------------------------------------------------------------->
            <div class="row">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card shadow mb-4 border-bottom-secondary">
                  <!-- Card Header - Dropdown -->
                  <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                  >
                    <h6 class="m-0 font-weight-bold text-secondary">
                      Flame Charts
                    </h6>
                    <div class="dropdown no-arrow">
                      <a
                        class="dropdown-toggle"
                        href="#"
                        role="button"
                        id="dropdownMenuLink"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i
                          class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"
                        ></i>
                      </a>
                      <div
                        class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink"
                      >
                        <div class="dropdown-header">
                          Delay antara pembacaan sensor yaitu 10 detik
                        </div>
                        <a class="dropdown-item" href="#">Sensor Infrared</a>
                      </div>
                    </div>
                  </div>
                  <!-- End Card Header - Dropdown -->

                  <!-- Card Body -->
                  <div class="card-body">
                    <div class="container">
                      <div id="chart-flame"></div>
                    </div>
                  </div>
                  <!-- End Card Body -->
                </div>
              </div>
            </div>
            <!-- End Flame Chart -->

            <!-- Forecast ------------------------------------------------------------------------------------------------------>
            <div class="row" id="forecast-section">
              <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4 border-left-primary">
                  <!-- Card Header - Dropdown -->
                  <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                  >
                    <h6 class="m-0 font-weight-bold text-primary">
                      Forecast
                    </h6>
                    <div class="dropdown no-arrow">
                      <a
                        class="dropdown-toggle"
                        href="#"
                        role="button"
                        id="dropdownMenuLink"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i
                          class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"
                        ></i>
                      </a>
                      <div
                        class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink"
                      >
                        <div class="dropdown-header">
                          Weather Forecast sebagai rujukan akurasi sensor
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- End Card Header - Dropdown -->

                  <!-- Card Body -->
                  <div class="card-body mb-3">
                    <div class="chart-area">
                      <script src="https://darksky.net/widget/graph-bar/-7.7713974,110.3902062/si12/en.js?width=100%&height=400&title=FullForecast&textColor=333333&bgColor=transparent&transparency=true&skyColor=undefined&fontFamily=Georgia&customFont=&units=si&timeColor=333333&tempColor=ff2406&currentDetailsOption=true"></script>
                    </div>
                  </div>
                  <!-- End Card Body -->
                </div>
              </div>
            </div>
            <!-- End Forecast -->
          </div>
          <!-- container-fluid wrapper -->
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>&copy; Tri Rizeki Rifandani | 2020</span>
            </div>
          </div>
        </footer>
        <!-- End of Footer -->
      </div>
      <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <!-- <script src="vendor/chart.js/Chart.min.js"></script> -->

    <!-- Custom Scripts --------------------------------------------------------------------------------------------------->
    <script>

      var value1 = <?php echo $value1; ?>;
      var value2 = <?php echo $value2; ?>;
      var value3 = <?php echo $value3; ?>;
      var value4 = <?php echo $value4; ?>;
      var value5 = <?php echo $value5; ?>;
      var value6 = <?php echo $value6; ?>;
      var value7 = <?php echo $value7; ?>;
      var value8 = <?php echo $value8; ?>;
      var reading_time = <?php echo $reading_time; ?>;

      var chart1 = new Highcharts.Chart({
        chart: {
          renderTo : 'chart-temperature'
        },
        title: { text: 'BMP280 Temperatur' },
        series: [{
          type: 'areaspline',
          threshold: null,
          fillColor: {
            linearGradient: {
              x1: 0,
              y1: 0,
              x2: 0,
              y2: 1
            },
            stops: [
              [0, Highcharts.getOptions().colors[3]],
              [1, Highcharts.color(Highcharts.getOptions().colors[3]).setOpacity(0).get('rgba')]
            ]
          },
          showInLegend: false,
          data: value1
        }],
        tooltip: {
          crosshairs: [true]
        },
        plotOptions: {
          line: {
            animation: false,
            dataLabels: { enabled: true }
          },
          series: { color: '#ffa500' }
        },
        xAxis: {
          type: 'datetime',
          dateTimeLabelFormats: { second: '%H:%M:%S' },
          categories: reading_time
        },
        yAxis: {
          title: { text: 'Temperatur (Celsius)' }
        },
        credits: { enabled: false }
      });

      var chart2 = new Highcharts.Chart({
        chart:{ renderTo:'chart-altitude' },
        title: { text: 'BMP280 Altitude' },
        series: [{
          type: 'areaspline',
          threshold: null,
          fillColor: {
            linearGradient: {
              x1: 0,
              y1: 0,
              x2: 0,
              y2: 1
            },
            stops: [
              [0, Highcharts.getOptions().colors[7]],
              [1, Highcharts.color(Highcharts.getOptions().colors[7]).setOpacity(0).get('rgba')]
            ]
          },
          showInLegend: false,
          data: value2
        }],
        tooltip: {
          crosshairs: [true]
        },
        plotOptions: {
          line: { animation: false,
            dataLabels: { enabled: true }
          },
          series: { color: '#059e8a' }
        },
        xAxis: {
          type: 'datetime',
          dateTimeLabelFormats: { second: '%H:%M:%S' },
          categories: reading_time
        },
        yAxis: {
          title: { text: 'Altitude (m)' }
        },
        credits: { enabled: false }
      });

      var chart3 = new Highcharts.Chart({
        chart:{ renderTo:'chart-pressure' },
        title: { text: 'BMP280 Tekanan' },
        series: [{
          type: 'areaspline',
          threshold: null,
          fillColor: {
            linearGradient: {
              x1: 0,
              y1: 0,
              x2: 0,
              y2: 1
            },
            stops: [
              [0, Highcharts.getOptions().colors[4]],
              [1, Highcharts.color(Highcharts.getOptions().colors[4]).setOpacity(0).get('rgba')]
            ]
          },
          showInLegend: false,
          data: value3
        }],
        tooltip: {
          crosshairs: [true]
        },
        plotOptions: {
          line: { animation: false,
            dataLabels: { enabled: true }
          },
          series: { color: '#0000ff' }
        },
        xAxis: {
          type: 'datetime',
          dateTimeLabelFormats: { second: '%H:%M:%S' },
          categories: reading_time
        },
        yAxis: {
          title: { text: 'Tekanan (hPa)' }
        },
        credits: { enabled: false }
      });

      var chart4 = new Highcharts.Chart({
        chart:{ renderTo : 'chart-heat' },
        title: { text: 'DHT11 Heat Index' },
        series: [{
          type: 'areaspline',
          threshold: null,
          fillColor: {
            linearGradient: {
              x1: 0,
              y1: 0,
              x2: 0,
              y2: 1
            },
            stops: [
              [0, Highcharts.getOptions().colors[8]],
              [1, Highcharts.color(Highcharts.getOptions().colors[8]).setOpacity(0).get('rgba')]
            ]
          },
          showInLegend: false,
          data: value4
        }],
        tooltip: {
          crosshairs: [true]
        },
        plotOptions: {
          line: { animation: false,
            dataLabels: { enabled: true }
          },
          series: { color: '#dc143c' }
        },
        xAxis: {
          type: 'datetime',
          dateTimeLabelFormats: { second: '%H:%M:%S' },
          categories: reading_time
        },
        yAxis: {
          title: { text: 'Heat Index (Celsius)' }
        },
        credits: { enabled: false }
      });

      var chart5 = new Highcharts.Chart({
        chart:{ renderTo:'chart-humidity' },
        title: { text: 'DHT11 Kelembaban' },
        series: [{
          type: 'areaspline',
          threshold: null,
          fillColor: {
            linearGradient: {
              x1: 0,
              y1: 0,
              x2: 0,
              y2: 1
            },
            stops: [
              [0, Highcharts.getOptions().colors[6]],
              [1, Highcharts.color(Highcharts.getOptions().colors[6]).setOpacity(0).get('rgba')]
            ]
          },
          showInLegend: false,
          data: value5
        }],
        tooltip: {
          crosshairs: [true]
        },
        plotOptions: {
          line: { animation: false,
            dataLabels: { enabled: true }
          },
          series: { color: '#ffd700' }
        },
        xAxis: {
          type: 'datetime',
          dateTimeLabelFormats: { second: '%H:%M:%S' },
          categories: reading_time
        },
        yAxis: {
          title: { text: 'Kelembaban (%)' }
        },
        credits: { enabled: false }
      });

      var chart6 = new Highcharts.Chart({
        chart: {
          renderTo : 'chart-dht-temperature'
        },
        title: { text: 'DHT11 Temperatur' },
        series: [{
          type: 'areaspline',
          threshold: null,
          fillColor: {
            linearGradient: {
              x1: 0,
              y1: 0,
              x2: 0,
              y2: 1
            },
            stops: [
              [0, Highcharts.getOptions().colors[3]],
              [1, Highcharts.color(Highcharts.getOptions().colors[3]).setOpacity(0).get('rgba')]
            ]
          },
          showInLegend: false,
          data: value6
        }],
        tooltip: {
          crosshairs: [true]
        },
        plotOptions: {
          line: {
            animation: false,
            dataLabels: { enabled: true }
          },
          series: { color: '#ffa500' }
        },
        xAxis: {
          type: 'datetime',
          dateTimeLabelFormats: { second: '%H:%M:%S' },
          categories: reading_time
        },
        yAxis: {
          title: { text: 'Temperatur (Celsius)' }
        },
        credits: { enabled: false }
      });

      var chart7 = new Highcharts.Chart({
        chart:{ renderTo:'chart-lux' },
        title: { text: 'BH1750 Iluminasi' },
        series: [{
          type: 'areaspline',
          threshold: null,
          fillColor: {
            linearGradient: {
              x1: 0,
              y1: 0,
              x2: 0,
              y2: 1
            },
            stops: [
              [0, Highcharts.getOptions().colors[9]],
              [1, Highcharts.color(Highcharts.getOptions().colors[9]).setOpacity(0).get('rgba')]
            ]
          },
          showInLegend: false,
          data: value7
        }],
        tooltip: {
          crosshairs: [true]
        },
        plotOptions: {
          line: { animation: false,
            dataLabels: { enabled: true }
          },
          series: { color: '#7fffd4' }
        },
        xAxis: {
          type: 'datetime',
          dateTimeLabelFormats: { second: '%H:%M:%S' },
          categories: reading_time
        },
        yAxis: {
          title: { text: 'Pencahayaan (lumen / m<sup>2</sup>)' }
        },
        credits: { enabled: false }
      });

      var chart8 = new Highcharts.Chart({
        chart:{ renderTo: 'chart-flame' },
        title: { text: 'Sensor InfraRed' },
        // subtitle: { text: 'Ketika sensor mendeteksi api, maka sensor akan memberikan signal digital LOW' },
        series: [{
          type: 'areaspline',
          threshold: null,
          fillColor: {
            linearGradient: {
              x1: 0,
              y1: 0,
              x2: 0,
              y2: 1
            },
            stops: [
              [0, Highcharts.getOptions().colors[1]],
              [1, Highcharts.color(Highcharts.getOptions().colors[1]).setOpacity(0).get('rgba')]
            ]
          },
          showInLegend: false,
          data: value8
        }],
        tooltip: {
          crosshairs: [true]
        },
        plotOptions: {
          line: {
            animation: false,
            dataLabels: { enabled: true }
          },
          series: { color: '#dc143c' }
        },
        xAxis: {
          type: 'datetime',
          dateTimeLabelFormats: { second: '%H:%M:%S' },
          categories: reading_time
        },
        yAxis: {
          title: { text: 'Digital (0/1)' }
        },
        credits: { enabled: false }
      });
    </script>

  </body>
</html>
