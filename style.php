<?php
// Authors: Daniel Huang, Hunter Pearson
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

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.required {
    font-size: 11px;
    color: red;
}

.container {
    display: flex;
    justify-content: space-around;
    padding: 20px;
}

.column1 {
    max-height: 1000px;
    overflow: auto;
    width: 25%;
    padding: 20px;
    border: 1px solid #ccc;
}

.column2 {
    max-height: 1000px;
    overflow: auto;
    width: 70%;
    padding: 20px;
    border: 1px solid #ccc;
}

.create {
    display: block;
    font-size: 15px;
    padding: 5px 10px;
    color: black;
    text-decoration: none;
}

.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
}

.tab button:hover {
  background-color: #ddd;
}

.tab button.active {
  background-color: #ccc;
}

.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
} 