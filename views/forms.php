
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/5.1.1/bootstrap-social.css" />
    <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap-social.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <!-- Trigger the modal with a button -->

    <button type="button" class="btn btn-default btn-lg" id="LogBtn">Login</button>

    <!-- Modal -->
    <div class="modal fade" id="LogModal" role="dialog">

    	<style>
    		.text{
    			position: relative;
			    top: -2px;
			    z-index: 6;
			    padding: 0 20px;
			    background: #fff;
			    font-weight:lighter;
			    font-size:15px;
    		}
    		.line::after{
    			position: absolute;
			    left: 0;
			    bottom: 70px;
			    width: 100%;
			    height: 1px;
			    background: #c8c8c8;
			    content: '';
			    z-index: 5;
    		}
    	</style>
     
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4>Login</h4>
          </div>
          <div class="modal-body">
            <div id="logerror" class="alert alert-danger fade in">
               <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
               <strong>Error!</strong><br><span></span>
            </div>
            <form id="f1" name="f1" role="form" action="login.php" method="POST">
              <div class="form-group">
                <input type="text" class="form-control" name="uid" id="usrname" placeholder="Enter email">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" name="pwd" id="psw" placeholder="Enter password">
              </div>
              <div style="float: left;margin-left: 7%;margin-bottom: 20px;">
                <a id="ForgotBtn" style="cursor:pointer;font-size: 12px;">Forgot password</a>
              </div>
                 <button type="submit" name="submit1" class="btn btn-success btn logsub"><span class="glyphicon glyphicon-user"></span> Login</button>
<!--             </form> -->
            <div class="line">
	            <h3>
	                <span class="text">or log in with</span>
	            </h3>
        	</div>
          <!-- <input type="text" class="form-control" name="provider" value="Facebook" style="display:none"> -->
        	<div style="display:inline-block; width:174px">
	        	<a id="Facebook" onclick="submit1(this)" class="btn btn-block btn-social btn-facebook">
              <!-- <a href="login.php?provider=Facebook" class="btn btn-block btn-social btn-facebook" name="Facebook"> -->
                <!-- <input type="text" class="form-control" name="Facebook" style="display:none"> -->

			    	<span class="fa fa-facebook"></span> Facebook
			  	</a>
			 </div>
			 <div style="display:inline-block; width:164px">
			  	<a id="Google" onclick="submit1(this)" class="btn btn-block btn-social btn-google">
            <!-- <a href="login.php?provider=Google" class="btn btn-block btn-social btn-google" name="provider" value="Facebook"> -->
              <!-- <input type="text" class="form-control" name="" id="usrname" placeholder="Enter email"> -->
			    	<span class="fa fa-google"></span> Google
			  	</a>
			 </div>
                   </form>
          </div>
        </div>
        
      
    </div> 
    <button type="button" class="btn btn-default btn-lg" id="RegBtn">Register</button>

    <!-- Modal -->
    <div class="modal fade" id="RegModal" role="dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4>Register</h4>
            </div>
            <div class="modal-body">
                <div id="regerror" class="alert alert-danger fade in">
                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>Error!</strong><br><span></span>
                </div>
                    <form role="form" action="signup.php" method="POST">
                    <div class="form-group">
                      <input class="form-control" type="text" name="first" placeholder="Firstname">
                   </div>
                    <div class="form-group">
                      <input class="form-control" type="text" name="last" placeholder="Lastname">
                    </div>
                     <div class="form-group">
                      <input class="form-control" type="text" name="email" placeholder="Email">
                    </div>
                     <div class="form-group">
                      <input class="form-control" type="text" name="uid" placeholder="Username">
                     </div>
                      <div class="form-group">
                    <input class="form-control" type="password" name="pwd" placeholder="Password">
                  </div>
                     <button type="submit" name="submit" class="btn btn-success btn regsub"><span class="glyphicon glyphicon-off"></span> Register</button>
                </form>
            </div>
        </div>

    </div> 

    <div class="modal fade" id="ForgotModal" role="dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <!-- <i class="fa fa-lock fa-4x"></i> -->
              <h3><i class="fa fa-lock fa-4x"></i></h3>
              <h2 class="text-center">Forgot Password?</h2>
              <!-- <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">Forgot Password?</h2>
                  <p>You can reset your password here.</p> -->
              <!-- <h4>Forgot Password</h4> -->
            </div>
            <div class="modal-body">
                <div id="forgoterror" class="alert alert-danger fade in">
                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>Error!</strong><br><span></span>
                </div>
                  <form role="form" action="forgot_psw.php" method="POST">
                    <!-- <div class="form-group">
                      <input class="form-control" type="text" name="first" placeholder="Firstname">
                   </div> -->
                    <div class="form-group" style="margin-left:20px;margin-right:20px;">
                      <div class="input-group">
                        <span class="input-group-addon" style="border-radius:0px;font-size:0em"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                        
                        <input style="border-radius:0px" id="emailInput" placeholder="Email" class="form-control" name="email" type="email" oninvalid="setCustomValidity('Please enter a valid email address!')" onchange="try{setCustomValidity('')}catch(e){}" required="">
                      </div>
                    </div>
                     <!-- <div class="form-group">
                      <input class="form-control" type="text" name="email" placeholder="Email">
                    </div>
                     <div class="form-group">
                      <input class="form-control" type="text" name="uid" placeholder="Username">
                     </div>
                      <div class="form-group">
                    <input class="form-control" type="password" name="pwd" placeholder="Password">
                  </div> -->
                     <button type="submit" name="submit" class="btn btn-success btn regsub" style="border-radius:0px"><span class="glyphicon glyphicon-off"></span> Email</button>
              </form>
            </div>
        </div>

    </div> 
<div class='info'>
  <div class='slab row welcome'>
      <h1>Welcome to inflow</h1>
      <span>Ready to get productive?</span>
  </div>
  <hr>
    <div class='slab row'>
        <div class='textleft col-md-4'>
            <h1> Tag system</h1>
            <span> Classify all your work <br>in neat tags and group them<br> based on priorities </span>
        </div>
        <div class='imagr col-md-8'>
          <img src='img/check.svg' width="450" height="450">
        </div>
    </div>
    <hr>
     <div class='slab row'>
      <div class='imagr col-md-8'>
          <img src='img/count.png' width="450" height="450">
        </div>
        <div class='textright col-md-4'>
            <h1> Keep track of your schedule</h1>
            <span> Never miss an deadline again <br>with the help of<br>countdown timers</span>
        </div>
    </div>
</div>
 
<script>
  function submit1(thisd)
  {
    // alert(thisd);
    var f2 = document.getElementById('f1');

    var input = document.createElement('input'); // create new textarea
    input.setAttribute("type", "text");
    input.setAttribute("name", "provider");
    input.setAttribute("style", "display:none");
    input.setAttribute("value", thisd.id);

    f2.appendChild(input); 
      // document.getElementById("f1").appendChild('<input type="text" class="form-control" value='+this.id+'name="provider" style="display:none">')
      document.f1.submit();
  }
$(document).ready(function(){
    
    $("#LogBtn").click(function(){
        $("#LogModal").modal();
    });

    $("#RegBtn").click(function(){
        $("#RegModal").modal();
    });

    $("#ForgotBtn").click(function(){
        $("#LogModal").fadeOut(200);
        // $("#LogModal").hide();
        $("#ForgotModal").modal();
    });

var emp = "<?php if(isset($_GET['signup'])) echo $_GET['signup'] ?>";
    if(emp=="empty"){
     $("#RegModal").modal();
     $("#regerror").fadeIn(200);
     $("#regerror").children("span").html("Fields cant be left empty");
    }

    if(emp=="invalid"){
     $("#RegModal").modal();
      $("#regerror").fadeIn(200);
      $("#regerror").children("span").html("Invalid Data");
    }

    if(emp=="email"){
     $("#RegModal").modal();
     $("#regerror").fadeIn(200);
     $("#regerror").children("span").html("Invalid Email");
    }

    if(emp=="exists"){
     $("#RegModal").modal();
     $("#regerror").fadeIn(200);
     $("#regerror").children("span").html("Username/Email already in use");
    }



    var log = "<?php if(isset($_GET['login'])) echo $_GET['login'] ?>";
    if(log=="empty"){
     $("#LogModal").modal();
     $("#logerror").fadeIn(200);
     $("#logerror").children("span").html("Fields cant be left empty");
    }

    if(log=="error"){
     $("#LogModal").modal();
     $("#logerror").fadeIn(200);
     $("#logerror").children("span").html("Invalid Credentials");
    }

    if(log=="pass"){
     $("#LogModal").modal();
     $("#logerror").fadeIn(200);
     $("#logerror").children("span").html("Invalid Password");
    }

    if(log=="error_social"){
     $("#LogModal").modal();
     $("#logerror").fadeIn(200);
     $("#logerror").children("span").html("Social login error");
    }

    console.log(log);

    var forgot = "<?php if(isset($_GET['forgot'])) echo $_GET['forgot'] ?>";
    if(forgot=="empty"){
     $("#ForgotModal").modal();
     $("#Forgoterror").fadeIn(200);
     $("#Forgoterror").children("span").html("Fields cant be left empty");
    }

    if(forgot=="error"){
     $("#ForgotModal").modal();
     $("#Forgoterror").fadeIn(200);
     $("#Forgoterror").children("span").html("Invalid Credentials");
    }

    if(forgot=="pass"){
     $("#ForgotModal").modal();
     $("#Forgoterror").fadeIn(200);
     $("#Forgoterror").children("span").html("Invalid Password");
    }
    console.log(forgot);

    $(".close").click(function(){
      $("#ForgotModal").modal('hide');
       $(".modal").modal('hide');
    })
     
});
</script>
<style>
body{
   background:linear-gradient(to right, rgba(100, 43, 115, 1), rgba(198, 66, 110, 1)) no-repeat  fixed;
    background-repeat: no-repeat;
    background-size: cover;
  }
  
</style>
