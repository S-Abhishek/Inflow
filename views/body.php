		<header>
					
			<!-- <nav>
				
				<div class="main-wrapper">
					<ul class="logcontain">
						<li><a href="index.php" class="logo">Inflow</a></li>
					</ul>
					<div class="nav-login">
						<a  class='statslink' href='stats.php' ><span class="glyphicon glyphicon-align-right" aria-hidden="true"></span> Stats</a>
						<form action="logout.php" method="POST">
							<button type="submit" name="submit">Logout</button>
						</form>
					</div>

				</div>

			</nav> -->
			<nav>
			<div class="main-wrapper">
					<ul class="logcontain">
						<li><a href="index.php" class="logo">Inflow</a></li>
					</ul>
					<div style="display:inline-block; float:right; margin-right:20px">
					<!-- <ul style="margin:30px">
						<a href='stats.php' ><span class="glyphicon glyphicon-align-right" aria-hidden="true"></span> Stats</a>
					</ul> -->
					 <ul class="nav navbar-nav" style="margin-top:-10px; min-width:250px">
					 	<!-- <li><a href="index.php" class="logo">Inflow</a></li> -->
					        <li class="dropdown" style="width:100%;background-color: #00000000;">
					          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class='usrname'>
					          	<?php 

					       			   $name =  $_SESSION['u_first'];
					       			   if(strlen($name)>12)
					       			   echo substr($name, 0, 11)."..";
					       			   else 
					       			   echo $name;
					       	   ?>
					          	
					          </span><span class="glyphicon glyphicon-user pull-right"></span></a>
					          <ul class="dropdown-menu">
					           <!--  <li class="ele"><a href="#">Account Settings <span class="glyphicon glyphicon-cog pull-right"></span></a></li> -->
					            <li class="divider"></li>
					            <li class = "ele"><a href="reset_psw.php">Change Password <span class="glyphicon glyphicon-lock pull-right"></span></a></li>
					            <li class="divider"></li>
					            <li class="ele"><a href="stats.php">User stats <span class="glyphicon glyphicon-stats pull-right"></span></a></li>
					            <li class="divider"></li>
					            <!-- <li><a href="#">Messages <span class="badge pull-right"> 42 </span></a></li>
					            <li class="divider"></li>
					            <li><a href="#">Favourites Snippets <span class="glyphicon glyphicon-heart pull-right"></span></a></li>
					            <li class="divider"></li> -->
					            <li class="ele"><a href="logout.php">Log Out <span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
					          </ul>
					        </li>
					 </ul>
					</div>
				</div>
			</nav>
			<style>
				ul.dropdown-menu li.ele{
					width:91%;
				}
				.navbar-nav>li>.dropdown-menu{
					max-width: 240px;
					transform: translate3d(0px,80px,0px) !important;
				}
				.glyphicon-user:before{
					position: relative;
				}
				.nav>li>a:hover {
  					  text-decoration: none;
    				  background-color: #00000000;
				}
				.nav>li>a{
  					  text-decoration: none;
    				  background-color: #00000000;
				}
				.usrname{
					position: relative;
					left:80px;
					top:4px;
				}
				.navbar-nav>li>.dropdown-menu {
  				   margin-top: 0;
  				   border-radius: 2px;
				}
			</style>

				