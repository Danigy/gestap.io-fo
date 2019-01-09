<?php include "template/header.php" ?>
    <div id="wrapper">
      <?php include "template/menu.php" ?>
      <div id="content-wrapper">
        <div class="container-fluid">
<!-----------------------------------------------------------------------------------USER INFORMATIONS----------------------------------------------------------------------------->
            <div class="row">
              <div class="col-lg-4">
                <div class="infoUsers">
                  <div style="padding:1px;">
                    <h5> <i class="fas fa-user"></i> User Informations</h5>
                    <p>FirstName : <span>Morgan</span> </p>
                    <p>LastName : <span>Freeman</span> </p>
                    <p>DateofBirthDay : <span>14/01/1984</span> </p>
                    <p>Email : <span>test@test.com</span> </p>
                    <p>IDRFID : <span>123456789</span> </p>
                  </div>
                </div>
              </div>
<!-----------------------------------------------------------------------------------LAST LESSONS----------------------------------------------------------------------------->
                <div class="col-lg-8">
                  <div class="LastLessonsUsers">
                    <div style="padding:1px;">
                      <h5><i class="fas fa-chart-pie"></i> Last Lessons</h5>
                      <table class="table" style="padding:0; margin:0;">
                        <thead class="thead-dark">
                         <tr>
                           <th scope="col">#</th>
                           <th scope="col">First</th>
                           <th scope="col">Last</th>
                           <th scope="col">Handle</th>
                         </tr>
                       </thead>
                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                        </tr>
                        <tr>
                          <th scope="row">2</th>
                          <td>Jacob</td>
                          <td>Thornton</td>
                          <td>@fat</td>
                        </tr>
                        <tr>
                          <th scope="row">3</th>
                          <td>Larry</td>
                          <td>the Bird</td>
                          <td>@twitter</td>
                        </tr>
                      </tbody>
                    </table>
                    </div>
                  </div>
                </div>
              </div>
<!-----------------------------------------------------------------------------------GROUPS----------------------------------------------------------------------------->
              <div class="row" style="margin-top:50px;">
                <div class="col-lg-4">
                  <div class="groupUsers">
                    <div style="padding:1px;">
                      <h5><i class="fas fa-users"></i> Groups</h5>
                      <p>Group : <span>Test</span></p>
                    </div>
                  </div>
                </div>
                  <div class="col-lg-4">
                    <div class="card mb-3">
                      <div class="card-header">
                        <i class="fas fa-chart-pie"></i>
                        Users</div>
                      <div class="card-body">
                        <canvas id="myPieChart" width="100%" height="100"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php include "template/footer.php" ?>
