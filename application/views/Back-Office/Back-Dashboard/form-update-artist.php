
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Modification</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Formulaire</li>
          <li class="breadcrumb-item active">Modification</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Modifie contenu</h5>
              <?php  for ($i=0; $i < sizeof($datas); $i++) { ?>
              <!-- Floating Labels Form -->
              <form class="row g-3" method="post" action="<?php echo site_url('Back-Office/Artist_Controller/form_trait_update?idartist=' . $datas[$i]['idartist']); ?>" style="cursor:pointer;" enctype="multipart/form-data">
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingName" name="name" value="<?php echo $datas[$i]['name'] ?>" required>
                    <label for="floatingName">Nom</label>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="number" step="any" class="form-control" id="floatingTarif"  name="tarif" value="<?php echo $datas[$i]['tarif_heure'] ?>" required>
                    <label for="floatingTarif">Tarif par heure</label>
                  </div>
                </div>

                <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success">
                            <center><?php echo $this->session->flashdata('success'); ?></center>
                        </div>
                    <?php } ?>

                <div class="text-center">
                  <input type="submit" class="btn btn-primary" value="Submit">
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End floating Labels Form -->
              <?php } ?>    
            </div>
          </div>

        </div>

      </div>
    </section>

  </main><!-- End #main -->

  