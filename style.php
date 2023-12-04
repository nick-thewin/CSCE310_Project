<?php
header("Content-type: text/css");
?>

body {
  font-family: Arial, sans-serif;
}

table {
  border-collapse: collapse;
  border: 2px solid rgb(200, 200, 200);
  letter-spacing: 1px;
  font-size: 0.8rem;
}

td,
th {
  border: 1px solid rgb(190, 190, 190);
  padding: 10px 20px;
}

th {
  background-color: rgb(235, 235, 235);
}

td {
  text-align: center;
}

ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

ul.navbar {
  background-color: rgba(80, 0, 0, 0.85); 
  text-align: center;
}

ul.navbar li {
  display: inline-block;
  margin: 0;
}

ul.navbar li a {
  display: block;
  padding: 10px 20px;
  color: #fff;
  text-decoration: none;
}

ul.navbar li a:hover {
  background-color: #555; 
}

ul.navbar h2 {
  font-size: 40px; 
  font-weight: bold; 
  margin-bottom: 10px; 
  color: #0; 
}

.loggedin {
  font-size:30;
  font-weight: bold;
  margin: 0;
  margin-bottom: 5px;
}