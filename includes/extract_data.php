<?php 
    $conn = mysqli_connect('localhost', 'root', '', 'carlink');

    $select = "SELECT * FROM supplier";
    $selectprod = "SELECT * FROM product";
    $selectcat = "SELECT * FROM category";
    $selectad = "SELECT * FROM admn";
    $selectcus = "SELECT * FROM customer";
    $selectman = "SELECT * FROM manager";
    $query = mysqli_query($conn, $select);
    $queryprod = mysqli_query($conn, $selectprod);
    $querycat = mysqli_query($conn, $selectcat);
    $queryad = mysqli_query($conn, $selectad);
    $querycus = mysqli_query($conn, $selectcus);
    $queryman = mysqli_query($conn, $selectman);
?>