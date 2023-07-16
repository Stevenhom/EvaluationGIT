
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo site_url('Front-Office/SController/home');?>">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row align-items-top">
            <div >
          
            <div class="card-body">
            <table>
                <tr>
                  <th>Label</th>
                  <th>Artist</th>
                  <th>Sonorisation</th>
                  <th>Logistique</th>
                  <th>Lieu</th>
                  <th>Communication</th>
                  <th>Transport</th>
                  <th>Sponsoring</th>
                  <th>Autre depense</th>
                  <th>Date</th>
                  <th>Total devis</th>

                </tr>
                <?php  for ($i=0; $i < sizeof($datas); $i++) { ?>
                <tr>
                  <td><?php echo $datas[$i]['name']; ?></td>
                  <td><?php echo $datas[$i]['artist']; ?></td>
                  <td><?php echo $datas[$i]['sonorisation']; ?></td>
                  <td><?php echo $datas[$i]['logistique']; ?></td>
                  <td><?php echo $datas[$i]['lieu']; ?></td>
                  <td><?php echo $datas[$i]['communication']; ?></td>
                  <td><?php echo $datas[$i]['transport']; ?></td>
                  <td><?php echo $datas[$i]['sponsor']; ?></td>
                  <td><?php echo $datas[$i]['depense']; ?></td>
                  <td><?php echo $datas[$i]['date']; ?></td>
                  <td><?php echo $calcul[$i]['devis']; ?> Ar</td>
                </tr>
                <?php }  ?> 
              </table>

              <a href="generate_pdf.php">Générer un PDF</a> <!-- Lien pour générer le fichier PDF -->
            </div>

          </div>

        </div>
    </section>
  </main><!-- End #main -->

  