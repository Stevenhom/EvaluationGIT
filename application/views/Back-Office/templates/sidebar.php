  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="<?php echo site_url('Back-Office/SController/home');?>">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Assistance</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>

        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?php echo site_url('Back-Office/Artist_Controller/artist');?>">
              <i class="bi bi-circle"></i><span>Artist</span>
            </a>
          </li>
        </ul>

        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?php echo site_url('Back-Office/Sono_Controller/sono');?>">
              <i class="bi bi-circle"></i><span>Sonorisation</span>
            </a>
          </li>
        </ul>

        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?php echo site_url('Back-Office/Logistic_Controller/logistique');?>">
              <i class="bi bi-circle"></i><span>Logistique</span>
            </a>
          </li>
        </ul>

        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?php echo site_url('Back-Office/Lieu_Controller/lieu');?>">
              <i class="bi bi-circle"></i><span>Lieu</span>
            </a>
          </li>
        </ul>

        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?php echo site_url('Back-Office/Communication_Controller/communication');?>">
              <i class="bi bi-circle"></i><span>communication</span>
            </a>
          </li>
        </ul>

        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?php echo site_url('Back-Office/Transport_Controller/transport');?>">
              <i class="bi bi-circle"></i><span>Transport</span>
            </a>
          </li>
        </ul>

        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?php echo site_url('Back-Office/Sponsor_Controller/sponsor');?>">
              <i class="bi bi-circle"></i><span>Sponsoring</span>
            </a>
          </li>
        </ul>

        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?php echo site_url('Back-Office/Depense_Controller/depense');?>">
              <i class="bi bi-circle"></i><span>Autre depense</span>
            </a>
          </li>
        </ul>

      </li><!-- End Forms Nav -->

      <li class="nav-heading">Pages</li>


      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-error-404.html">
          <i class="bi bi-dash-circle"></i>
          <span>Error 404</span>
        </a>
      </li><!-- End Error 404 Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-blank.html">
          <i class="bi bi-file-earmark"></i>
          <span>Blank</span>
        </a>
      </li><!-- End Blank Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->