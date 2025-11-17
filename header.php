<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD Application</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="style.css?v=4">
</head>

<body>
  <!-- Navbar -->
  <?php
    $current_page = basename($_SERVER['PHP_SELF']);
  ?>

  <nav class="navbar navbar-expand-lg navbar-dark shadow-sm custom-navbar">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold" href="index.php">CRUD Application</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link <?= ($current_page == 'index.php') ? 'active' : '' ?>" href="index.php">Students</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= ($current_page == 'teachers.php') ? 'active' : '' ?>" href="teachers.php">Teachers</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= ($current_page == 'courses.php') ? 'active' : '' ?>" href="courses.php">Courses</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= ($current_page == 'about.php') ? 'active' : '' ?>" href="about.php">About</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-4">
