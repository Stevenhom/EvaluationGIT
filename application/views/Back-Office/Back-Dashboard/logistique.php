
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Gestion</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item active">Layouts</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Logistiques</h5>

              <!-- Horizontal Form -->
              <form  class="row g-3" method="post" action="<?php echo site_url("Back-Office/Logistic_Controller/logistique_trait");?>" enctype="multipart/form-data">
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Type</label>
                  <div class="col-sm-10">
                    <input type="text" name="type" class="form-control" id="inputText" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Tarif par jour</label>
                  <div class="col-sm-10">
                    <input type="number" step="any" name="tarif" class="form-control" id="inputEmail" required>
                  </div>
                </div>
                
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Valider</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
                <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success">
                            <center><?php echo $this->session->flashdata('success'); ?></center>
                        </div>
                    <?php } ?>
              </form><!-- End Horizontal Form -->

            </div>
          </div>

        </div>

        <div class="col-lg-6">

        <table>
                <tr>
                  <th>Type</th>
                  <th>Tarif par jour</th>
                  <th></th>
                  <th></th>
                </tr>
                <?php  for ($i=0; $i < sizeof($datas); $i++) { ?>
                <tr>
                  <td><?php echo $datas[$i]['type']; ?></td>
                  <td><?php echo $datas[$i]['tarif_jour']; ?></td>
                  <td><a href="<?php echo site_url('Back-Office/Logistic_Controller/update?idlogistique=' . $datas[$i]['idlogistique']); ?>" style="cursor:pointer">modifier</a></td>
                  <td><a href="<?php echo site_url('Back-Office/Logistic_Controller/delete?idlogistique=' . $datas[$i]['idlogistique']); ?>" style="cursor:pointer">supprimer</a></td>
              </tr>
                <?php }  ?> 
              </table>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  