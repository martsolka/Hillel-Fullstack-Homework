<?php
$pageTitle = '404 | Page Not Found';
require_once('page-head.php');
?>

<body class="d-flex flex-column vh-100 mesh-gradient overflow-y-auto">
  <div class="container-lg h-100 py-3">
    <div class="card h-100 shadow-lg">
      <header class="card-header hstack justify-content-between">
        <strong>Header</strong>
        <?php require_once('theme-switch.php'); ?>
      </header>
      <main class="card-body overflow-y-auto">
        <div class="row align-items-center justify-content-around h-100">
          <div class="col-6 col-md-5 order-sm-last">
            <svg class="img-fluid mx-4 opacity-75" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve">
              <path fill="#D8D8D8" d="M434.523 358.5h-407c-11.043 0-20-8.953-20-20v-288h427zm0 0" data-original="#d8d8d8" />
              <path fill="#AFAFAF" d="M404.523 50.5h30.024v308h-30.024zm0 0" data-original="#afafaf" />
              <path fill="var(--bs-success)" d="M434.523 27.5v33h-427v-33c0-11.047 8.957-20 20-20h387c11.047 0 20 8.953 20 20zm0 0" data-original="#aac9e2" />
              <path fill="#FAFEFF" d="M42.523 328.5c-2.757 0-5-2.238-5-5v-228c0-2.762 2.243-5 5-5h357a5 5 0 0 1 5 5v233zm0 0" data-original="#fafeff" />
              <path fill="var(--bs-warning)" d="M504.523 334c0 55.504-44.992 100.5-100.5 100.5-55.503 0-100.5-44.996-100.5-100.5s44.997-100.5 100.5-100.5c55.508 0 100.5 44.996 100.5 100.5zm0 0" data-original="#f2d67c" />
              <path fill="var(--bs-warning-text-emphasis)" d="M504.523 334c0 55.5-45 100.5-100.5 100.5a99.99 99.99 0 0 1-15-1.121c48.391-7.238 85.5-48.98 85.5-99.379s-37.109-92.14-85.5-99.379a99.955 99.955 0 0 1 15-1.121c55.5 0 100.5 45 100.5 100.5zm0 0" data-original="#e2b061" />
              <path fill="var(--bs-success-text-emphasis)" d="M434.547 27.5v33h-30v-33c0-11.05-8.953-20-20-20h30c11.047 0 20 8.95 20 20zm0 0" data-original="#699eb5" />
              <path d="M442 232.91V27.5C442 12.336 429.664 0 414.5 0h-387C12.336 0 0 12.336 0 27.5v311C0 353.664 12.336 366 27.5 366h39.168c4.14 0 7.5-3.36 7.5-7.5s-3.36-7.5-7.5-7.5H27.5c-6.895 0-12.5-5.605-12.5-12.5V68h412v160.473A108.079 108.079 0 0 0 404 226c-20.281 0-39.27 5.621-55.5 15.387V157c0-4.14-3.355-7.5-7.5-7.5s-7.5 3.36-7.5 7.5v53H291a2.502 2.502 0 0 1-2.5-2.5V157c0-4.14-3.355-7.5-7.5-7.5s-7.5 3.36-7.5 7.5v50.5c0 9.648 7.852 17.5 17.5 17.5h42.5v26.695c0 .18.016.356.027.532-19.87 17.152-33.441 41.402-36.742 68.773H45V98h352v100.5c0 4.14 3.355 7.5 7.5 7.5s7.5-3.36 7.5-7.5v-103c0-6.895-5.605-12.5-12.5-12.5h-357C35.605 83 30 88.605 30 95.5v228c0 6.895 5.605 12.5 12.5 12.5h253.523c.094 5.094.54 10.102 1.32 15H101.669a7.5 7.5 0 1 0 0 15H300.84c13.672 43.977 54.746 76 103.16 76 59.55 0 108-48.45 108-108 0-46.184-29.14-85.684-70-101.09zM15 53V27.5C15 20.605 20.605 15 27.5 15h387c6.895 0 12.5 5.605 12.5 12.5V53zm389 374c-51.281 0-93-41.719-93-93s41.719-93 93-93 93 41.719 93 93-41.719 93-93 93zm0 0" fill="var(--bs-dark)" />
              <path d="M44 25c-4.965 0-9 4.04-9 9s4.035 9 9 9 9-4.04 9-9-4.035-9-9-9zm38 0c-4.965 0-9 4.04-9 9s4.035 9 9 9 9-4.04 9-9-4.035-9-9-9zm38 0c-4.965 0-9 4.04-9 9s4.035 9 9 9 9-4.04 9-9-4.035-9-9-9zm41 245.5a7.5 7.5 0 0 0 7.5-7.5V157c0-4.14-3.355-7.5-7.5-7.5s-7.5 3.36-7.5 7.5v53H111a2.502 2.502 0 0 1-2.5-2.5V157c0-4.14-3.355-7.5-7.5-7.5s-7.5 3.36-7.5 7.5v50.5c0 9.648 7.852 17.5 17.5 17.5h42.5v38a7.5 7.5 0 0 0 7.5 7.5zM201 150c-9.648 0-17.5 7.852-17.5 17.5v85c0 9.648 7.852 17.5 17.5 17.5h40c9.648 0 17.5-7.852 17.5-17.5v-85c0-9.648-7.852-17.5-17.5-17.5zm42.5 17.5v85c0 1.379-1.121 2.5-2.5 2.5h-40a2.502 2.502 0 0 1-2.5-2.5v-85c0-1.379 1.121-2.5 2.5-2.5h40c1.379 0 2.5 1.121 2.5 2.5zm0 0" fill="var(--bs-dark)" />
              <path d="M221 187.5a7.5 7.5 0 0 0-7.5 7.5v30c0 4.14 3.355 7.5 7.5 7.5s7.5-3.36 7.5-7.5v-30a7.5 7.5 0 0 0-7.5-7.5zm139.5 118.676a7.5 7.5 0 0 0-7.5 7.5v23c0 4.14 3.355 7.5 7.5 7.5s7.5-3.36 7.5-7.5v-23a7.5 7.5 0 0 0-7.5-7.5zm87 0a7.5 7.5 0 0 0-7.5 7.5v23c0 4.14 3.355 7.5 7.5 7.5s7.5-3.36 7.5-7.5v-23a7.5 7.5 0 0 0-7.5-7.5zm-43.5 41c-11.723 0-22.61 5.289-29.871 14.508a7.5 7.5 0 0 0 1.254 10.53c3.254 2.563 7.972 2.005 10.531-1.25 4.399-5.585 10.988-8.788 18.086-8.788s13.688 3.203 18.086 8.789a7.491 7.491 0 0 0 5.898 2.86 7.47 7.47 0 0 0 4.633-1.606 7.504 7.504 0 0 0 1.254-10.535c-7.258-9.22-18.144-14.508-29.871-14.508zm0 0" fill="var(--bs-dark)" />
            </svg>
          </div>
          <div class="col-12 col-sm col-lg-4 text-center text-sm-start pb-3">
            <h1 class="display-4 fw-bold text-nowrap">Not Found :(</h1>
            <p class="lead text-muted mb-sm-5">The page you are looking for does not exist. Please check the URL and try again.</p>
            <a class="btn btn-success bg-gradient fw-medium fs-5 px-4" href="/home-private.php">🏠 Home Page &rarr;</a>
          </div>
        </div>
      </main>
      <footer class="card-footer hstack justify-content-between">
        <strong>Footer</strong>
        <a class="btn backdrop-filter bg-gradient link-body-emphasis fw-medium px-3" href="?signout">Sign Out &raquo;</a>
      </footer>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>