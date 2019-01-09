<?php include "template/header.php" ?>
    <div id="wrapper">
      <?php include "template/menu.php" ?>
      <div id="content-wrapper">
        <div class="container-fluid">
<!-----------------------------------------------------------------------------------LIST GROUPS----------------------------------------------------------------------------->
            <div class="row">
              <div class="col-lg-2">
                <div class="infoUsers">
                  <div style="padding:1px;">
                      <h5> <i class="fas fa-user"></i> List Groups</h5>
                          <li class="Groupclick"><span>Group 1</span></li>
                          <li class="Groupclick"><span>Group 2</span></li>
                          <li class="Groupclick"><span>Group 3</span</li>
                          <li class="Groupclick"><span>Group 4</span</li>
                          <li class="Groupclick"><span>Group 5</span</li>
                        </ul>
                      </div>
                    </div>
                  </div>

<!-----------------------------------------------------------------------------------MODAL ADD USERS----------------------------------------------------------------------------->
                  <div class="modal fade" id="AddUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Add user group</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form>
                            <label for="exampleFormControlSelect1">Select User</label>
                              <select class="form-control" id="exampleFormControlSelect1">
                                <option>User 1</option>
                                <option>User 2</option>
                                <option>User 3</option>
                                <option>User 4</option>
                                <option>User 5</option>
                              </select>
                            <button type="submit" class="btn btn-primary">Save</button>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>

<!-----------------------------------------------------------------------------------MODAL ADD LESSONS----------------------------------------------------------------------------->

                  <div class="modal fade" id="AddLessons" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Add Lesson To User</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form>
                            <label for="exampleFormControlSelect1">Select Lessons</label>
                              <select class="form-control" id="exampleFormControlSelect1">
                                <option>Lesson 1</option>
                                <option>Lesson 2</option>
                                <option>Lesson 3</option>
                                <option>Lesson 4</option>
                                <option>Lesson 5</option>
                              </select>
                            <button type="submit" class="btn btn-primary">Save</button>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>

<!-----------------------------------------------------------------------------------MODULE GROUPS----------------------------------------------------------------------------->
                  <div class="col-lg-4">
                    <div class="LastLessonsUsers GroupUsers">
                      <div style="padding:1px;">
                        <h5></h5>
                        <table class="table" style="padding:0; margin:0;">
                        <tbody>
                          <tr>
                            <td>
                              Mark
                            </td>
                            <td>
                              <a class="btn btn-success flright orange"><i class="fa fa-trash-o"></i></a>
                            </td>
                          </tr>
                          <tr>
                            <td>Jacob</td>
                            <td>
                              <a class="btn btn-success flright orange"><i class="fa fa-trash-o"></i></a>
                            </td>
                          </tr>
                          <tr>
                            <td>Larry</td>
                            <td>
                              <a class="btn btn-success flright orange"><i class="fa fa-trash-o"></i></a>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                          <a class="btn btn-success flright AddLessons" style="margin-top:5px"> <i class="fa fa-eye" aria-hidden="true"></i></a>
                          <a class="btn btn-success flright" style="margin-top:5px; margin-right:5px;" data-toggle="modal" data-target="#AddUser"> <i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                      </div>
                    </div>
                  </div>
<!------------------------------------------------------------------------------MODULE LESSONS----------------------------------------------------------------------------->
                  <div class="col-lg-4">
                    <div class="LastLessonsUsers LessonsUsers">
                      <div style="padding:1px;">
                        <h5>LESSONS</h5>
                        <table class="table" style="padding:0; margin:0;">
                        <tbody>
                          <tr>
                            <td>Lesson 1</td>
                            <td>
                              <a class="btn btn-success flright orange"> <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            </td>
                          </tr>
                          <tr>
                            <td>Lesson 2</td>
                            <td>
                              <a class="btn btn-success flright orange"> <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            </td>
                          </tr>
                          <tr>
                            <td>Lesson 3</td>
                            <td>
                              <a type="button" class="btn btn-success flright orange"> <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                          <a class="btn btn-success flright" style="margin-top:5px" data-toggle="modal" data-target="#AddLessons"><i class="fa fa-plus-circle" aria-hidden="true"></i> </a>
                      </div>
                    </div>
                  </div>
<!-----------------------------------------------------------------------------------MODULE LESSONS----------------------------------------------------------------------------->
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php include "template/footer.php" ?>
