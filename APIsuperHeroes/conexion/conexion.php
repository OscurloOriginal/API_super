<?php 

$conexion = mysqli_connect("localhost", "root", "", "APIsuperHeroes");

if (!$conexion) {
	$craerConexio = include 'DDL.sql';
} // else {
// 	echo "Tudo bem bro :)";
// }