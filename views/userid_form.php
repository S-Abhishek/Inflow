 <!-- Modal -->
    <div class="modal fade" id="UserModal" role="dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" id="closeUserModal" class="close" data-dismiss="modal">&times;</button>
              <h4>Register</h4>
            </div>
            <div class="modal-body">
                <div style="display:none" id="usererror" class="alert alert-danger fade in">
                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>Error!</strong><br><span></span>
                </div>
                    <form role="form" action="signup.php" method="POST">
                      <div class="form-group" style="display:none">
                      <input class="form-control" type="text" name="first" value="<?php if(isset($_SESSION['firstName'])) echo $_SESSION['firstName']?>" placeholder="Firstname">
                   </div>
                    <div class="form-group" style="display:none">
                      <input class="form-control" type="text" name="last" value="<?php if(isset($_SESSION['lastName'])) echo $_SESSION['lastName']?>" placeholder="Lastname">
                    </div>
                    <?php if(!isset($_SESSION['email'])):?>
                      <div class="form-group">
                        <input class="form-control" type="text" name="email" placeholder="Email">
                      </div>
                    <?php else: ?>
                      <div class="form-group" style = "display:none">
                        <input class="form-control" type="text" name="email" value="<?php if(isset($_SESSION['email'])) echo $_SESSION['email']?>"  placeholder="Email">
                      </div>
                    <?php endif;?>
                     <div class="form-group">
                      <input class="form-control" type="text" name="uid" placeholder="Username">
                      <input style="display:none" class="form-control" type="text" name="flag" value="1">
                     </div>
                     <button type="submit" name="submit" class="btn btn-success btn regsub"><span class="glyphicon glyphicon-off"></span> Register</button>
                </form>
            </div>
        </div>

    </div> 

    <script>
      $(function(){

        $("#UserModal").modal();

        var emp = "<?php if(isset($_GET['signup_social'])) echo $_GET['signup_social'] ?>";
        if(emp=="empty"){
         $("#UserModal").modal();
         $("#usererror").fadeIn(200);
         $("#usererror").children("span").html("Fields cant be left empty");
        }

        if(emp=="invalid"){
         $("#UserModal").modal();
          $("#usererror").fadeIn(200);
          $("#usererror").children("span").html("Invalid Data");
        }

        if(emp=="email"){
         $("#UserModal").modal();
         $("#usererror").fadeIn(200);
         $("#usererror").children("span").html("Invalid Email");
        }

        if(emp=="exists"){
         $("#UserModal").modal();
         $("#usererror").fadeIn(200);
         $("#usererror").children("span").html("Username already in use");
        }

        if(emp=="email_exists"){
         $("#UserModal").modal();
         $("#usererror").fadeIn(200);
         $("#usererror").children("span").html("Email already associated with another Username");
       }

      });

      $("#closeUserModal").click(function(){
        $("#UserModal").fadeOut(200);
        window.location.href='../';

    });
    </script>

