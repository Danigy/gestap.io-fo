<?php include "template/header.php" ?>

    <div id="wrapper">

    <?php include "template/menu.php" ?>

      <div id="content-wrapper">

        <div class="container-fluid">

<!-----------------------------------------------------------------------------------MODAL ADD USER----------------------------------------------------------------------------->
      <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add user</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                <div class="form-group add">
                    <input type="text" class="form-control" placeholder="FirstName">
                    <input type="text" class="form-control" placeholder="LastName">
                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                      <small>Date of birthday</small>
                    <input type="date" class="form-control" placeholder="DateOfBirthday">
                    <input type="number" class="form-control" placeholder="IDRFID">
                  </div>
                <button type="submit" class="btn btn-primary">Save</button>
              </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

<!-----------------------------------------------------------------------------------MODAL MODIFY USERS----------------------------------------------------------------------------->
      <div class="modal fade" id="modifyUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modify user</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                <div class="form-group add">
                    <input type="text" class="form-control" placeholder="FirstName">
                    <input type="text" class="form-control" placeholder="LastName">
                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                      <small>Date of birthday</small>
                    <input type="date" class="form-control" placeholder="DateOfBirthday">
                    <input type="number" class="form-control" placeholder="IDRFID">
                  </div>
                <button type="submit" class="btn btn-primary">Save</button>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

<!-----------------------------------------------------------------------------------TABLES----------------------------------------------------------------------------->
      <div class="card mb-3">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bodered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>FirstName</th>
                  <th>LastName</th>
                  <th>Mail</th>
                  <th>Date of Birthday</th>
                  <th>IDRFID</th>
                  <th>Actions users</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Tiger Nixon</td>
                  <td>System Architect</td>
                  <td>MotherFucker@fuck.com</td>
                  <td>2011/04/25</td>
                  <td>123456789</td>
                  <td>
                    <a class="btn btn-success green" data-toggle="modal" data-target="#modifyUser"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <a class="btn btn-success green ">  <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    <a class="btn btn-success green" href="usersDetails.php"><i class="fa fa-eye" aria-hidden="true"></i></a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
        <a class="btn btn-primary blue" style=" position: fixed;bottom: 50px;right: 20px;" data-toggle="modal" data-target="#addUser">Add User &nbsp;<i class="fa fa-plus-circle" aria-hidden="true"></i></a>
<?php include "template/footer.php" ?>
