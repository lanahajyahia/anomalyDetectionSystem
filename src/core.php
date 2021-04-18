<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
	<meta name="theme-color" content="#4b545c">
    <link rel="shortcut icon" href="assets/img/favicon.png">
    <!-- <title>Anomaly Detection &rsaquo; Admin Panel</title> -->


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
    <!--STYLESHEET-->
    <!--=================================================-->

    <!--Bootstrap Stylesheet-->
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet"> -->

	<!--Font Awesome-->
    <link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet">

	<!--Google Font: Source Sans Pro-->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

	<!--Stylesheet-->
    <!-- <link href="assets/css/admin.min.css" rel="stylesheet"> -->

    <!--Switchery-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>


<style>
/* width */
::-webkit-scrollbar {
    width: 6px;
}

/* Track */
::-webkit-scrollbar-track {
    background: #f1f1f1;
}

/* Handle */
::-webkit-scrollbar-thumb {
    background: #888;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>
</head>

<body class="hold-transition sidebar-mini <?php
    if ($row['fixed_layout'] == 1) {
        echo 'fixed';
    }
?> <?php
    if ($row['boxed_layout'] == 1) {
        echo 'layout-boxed';
    }
?>">
<div class="wrapper">


	 

</div>

    <!--JAVASCRIPT-->
    <!--=================================================-->

    <!--Bootstrap-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

	<!--Admin-->
    <script src="assets/js/admin.min.js"></script>

    <!--DataTables-->
    <script src="https://cdn.datatables.net/v/bs4/dt-1.10.16/r-2.2.1/datatables.min.js"></script>

</body>
</html>
<?php

?>
