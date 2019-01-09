<?php include "template/header.php" ?>
    <div id="wrapper">
      <?php include "template/menu.php" ?>
      <div id="content-wrapper">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-4">
              <div class="card mb-3">
                <div class="card-header">
                  <i class="fas fa-chart-pie"></i>
                  Users</div>
                <div class="card-body">
                  <canvas id="myPieChart" width="100%" height="100"></canvas>
                </div>
                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card mb-3">
                <div class="card-header">
                  <i class="fas fa-chart-pie"></i>
                  Groups</div>
                <div class="card-body">
                  <canvas id="myPieChart1" width="100%" height="100"></canvas>
                </div>
                  <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
<?php include "template/footer.php" ?>
