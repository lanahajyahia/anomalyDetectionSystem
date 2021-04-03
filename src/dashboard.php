<?php
 require("core.php");
 require("server.php");

 //count rhe number of specific injection
function injection_count($table,$type)
{
	global $connection;
	$sql = "SELECT * FROM '$table' WHERE type='$type'";
	$result = $connection->query($sql);
	return " ".$result->num_rows;

 }
?>
<div class="navv"><?php include("navbar.php");?></div>
<div class="content-wrapper" style="margin-left: 0px !important;">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div class="content-header" style="padding-bottom: 0px !important;">

				<div class="container-fluid">
				  <div class="row mb-2">
        		    <div class="col-sm-6">
        		      <h1 class="m-0 text-dark"><i class="fas fa-home"></i> Dashboard</h1>
        		    </div>
        		     <div class="col-sm-6">
        		      <ol class="breadcrumb float-sm-right">
        		        <!-- <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i> Admin Panel</a></li> -->
        		        <!-- <li class="breadcrumb-item active">Dashboard</li> -->
        		      </ol>
        		    </div>
        		  </div>
    			</div> 
            </div> 

				<!--Page content-->
				<!--===================================================-->
				<div class="content">
				<div class="container-fluid">

<h4 class="card-title">Today's Stats</h4><br />

                <div class="row">

					    <div class="col-sm-6 col-lg-3">
                            <div class="small-box bg-info">
                               <div class="inner">
                                   <h3><?php
								   
echo ' ' . injection_count('SQL_injections','sqli');
?></h3>
                                   <p>SQLi Attacks</p>
                               </div>
                               <div class="icon">
                                   <i class="fas fa-code"></i>
                               </div>
                               <a href="Logs\sqliLogs.php" class="small-box-footer">View Logs <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
					    </div>
					    <div class="col-sm-6 col-lg-3">
					        <div class="small-box bg-danger">
                               <div class="inner">
                                   <h3><?php

echo ' ' . injection_count('XSS_injections','reflected');
?></h3>
                                   <p>Reflected XSS Attacks</p>
                               </div>
                               <div class="icon">
                                   <i class="fas fa-retweet"></i>
                               </div>
                               <a href="Logs/reflectedLogs.php" class="small-box-footer">View Logs <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
					    </div>
					    <div class="col-sm-6 col-lg-3">
					        <div class="small-box bg-success">
                               <div class="inner">
                                   <h3><?php
echo ' ' . injection_count('XSS_injections', 'stored');
?></h3>
                                   <p>Stored XSS Attacks</p>
                               </div>
                               <div class="icon">
                                   <i class="fas fa-globe"></i>
                               </div>
                               <a href="Logs\storedLogs.php" class="small-box-footer">View Logs <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
					    </div>
					    <div class="col-sm-6 col-lg-3">
					        <div class="small-box bg-warning">
                               <div class="inner">
                                   <h3 style="color:white !important;"><?php
echo ' ' . injection_count('XSS_injections', 'dom');
?></h3>
                                   <p style="color:white !important;">Dom XSS Attacks</p>
                               </div>
                               <div class="icon">
                                   <i class="fas fa-keyboard"></i>
                               </div>
                               <a href="domLogs.php" class="small-box-footer" style="color:white !important;">View Logs <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
					    </div>
					</div>

                <br /><h4 class="card-title">Overall Statistics</h4><br />

                <div class="row">
					    <div class="col-lg-7">
					        <div id="panel-network" class="card">
					            <div class="card-header">
					                <h3 class="card-title">Statistics</h3>
					            </div>
					            <div class="card-body">
                                    <canvas id="log-stats"></canvas>
                                </div>
                            </div>

					    </div>
                        <div class="col-lg-5">
					        <div class="row">
					            <div class="col-sm-6 col-lg-6">
					         <div class="card card-primary card-outline">
								<div class="card-body text-center">
									<p class="text-uppercase mar-btm text-lg">SQL Injection Attacks</p>
									<i class="fas fa-code fa-3x"></i>
									<hr>
									<p class="h2 text-thin"><?php
echo "1";
?></p>
								</div>
							 </div>
					            </div>
					            <div class="col-sm-6 col-lg-6">
					         <div class="card card-danger card-outline">
								<div class="card-body text-center">
									<p class="text-uppercase mar-btm text-lg">Mass Requests</p>
									<i class="fas fa-retweet fa-3x"></i>
									<hr>
									<p class="h2 text-thin"><?php
echo "1" ;
?></p>
								</div>
							 </div>
					            </div>
					        </div>
					        <div class="row">
					            <div class="col-sm-6 col-lg-6">
					        <div class="card card-success card-outline">
								<div class="card-body text-center">
									<p class="text-uppercase mar-btm text-lg">Proxies</p>
									<i class="fas fa-globe fa-3x"></i>
									<hr>
									<p class="h2 text-thin"><?php
echo "1";
?></p>
								</div>
							 </div>
					            </div>
					            <div class="col-sm-6 col-lg-6">
					        <div class="card card-warning card-outline">
								<div class="card-body text-center">
									<p class="text-uppercase mar-btm text-lg">Spammers</p>
									<i class="fas fa-keyboard fa-3x"></i>
									<hr>
									<p class="h2 text-thin"><?php
echo "1";
?></p>
								</div>
							 </div>
					            </div>
					        </div>

					    </div>
					</div>


<?php
include("footer.php");
?>
