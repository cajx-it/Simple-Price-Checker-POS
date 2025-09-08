<?php
  session_start();

  if(!isset($_SESSION['login'])){
    header('Location: ../login/index.php');
    exit();
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <style>

    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #a0b5d6;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .dashboard-container {
      width: 900px;
      background: #1d2128;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 10px 16px rgba(0,0,0,1);
    }

    .dashboard-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .dashboard-header h2 {
      font-size: 22px;
      color: #fff;
    }

    .dashboard-header a {
      padding: 8px 15px;
      background: #c3c7ce;
      color: black;
      text-decoration: none;
      border-radius: 8px;
      font-size: 14px;
    }

    .dashboard-header button {
      padding: 8px 15px;
      background: #c3c7ce;
      color: black;
      text-decoration: none;
      border-radius: 8px;
      font-size: 14px;
      border: none;
    }

    .dashboard-header a:hover {
      background: #a9b9d6ff;
    }
    .dashboard-header button:hover {
      background: #a9b9d6ff;
    }

    #next:hover {
      background: #a9b9d6ff;
    }

    #prev:hover {
      background: #a9b9d6ff;
    }

    #next {
      background: #c3c7ce;
    }

    #prev {
      background: #c3c7ce;
    }
    .product-list table {
      width: 100%;
      border-collapse: collapse;
      font-size: 14px;
      text-align: center;
    }

    .product-list th, 
    .product-list td {
      border: 1px solid #000000ff;
      background-color : #a0b5d6;
      padding: 5px;
    }

    .product-list th {
      background: #23bc77ff;
      color: white;
    }

    .product-list tr:nth-child(even) {
      background: #c3c7ce;
    }

    .footer {
      margin-top: 20px;
      font-size: 11px;
      color: #666;
      text-align: center;
    }

    button {
      padding: 8px 15px;
      color: black;
      text-decoration: none;
      border-radius: 8px;
      font-size: 14px;
      border: none;
    }

    #btnCon{
      margin-top: 8px;
      display:flex;
      align-items: center;
      justify-content: center;
      gap: 5px

    }
    #prev{
      display: none;
    }
    #next{
      display: none;
    }

    #edit{
      background-color: #90e17dff;
      margin-right: 5px;
    }
    #del{
      background-color: #d96161ff;
    }

    #edit:hover{
      background-color: #b1e0a6ff;
      margin-right: 5px;
    }
    #del:hover{
      background-color: #d88181ff;
    }

    .form-container {
      background: #2c333fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      text-align: center;
      width: 350px;
      align-items: center;
      
    }

    .form-container h2 {
      margin-bottom: 20px;
      font-size: 22px;
      font-weight: bold;
      color: white;
    }

    .form-container input {
      display: block;
      width: 80%;
      padding: 10px;
      margin: 8px auto;
      border: 1px solid #ccc;
      border-radius: 15px;
      font-size: 14px;
      text-align: center;
    }

    .form-container input[type="file"] {
      padding: 5px;
    }

    .form-container button {
      width: 80%;
      padding: 10px;
      background: #c3c7ce;
      color: black;
      font-size: 15px;
      border: none;
      border-radius: 15px;
      cursor: pointer;
      margin-top: 15px; 
    }
    #image{
      color: white;
    }

    .form-container button:hover {
      background: #a0b5d6;
    }

    .form-container a {
      display: block;
      margin-top: 15px;
      font-size: 13px;
      color: #debdc5ff;
      text-decoration: none;
    }

    .form-container a:hover {
      text-decoration: underline;
    }

    .footer {
      margin-top: 12px;
      font-size: 11px;
      color: #666;
    }
    
    .editCont{
      background-color: rgba(87, 99, 113, 0.5) ;
      position: absolute;
      height: 100vh;
      width: 100%;
      display: none;
      align-items: center;
      justify-content: center
    }

    .addCont{
      background-color: rgba(87, 99, 113, 0.5) ;
      position: absolute;
      height: 100vh;
      width: 100%;
      display: none;
      align-items: center;
      justify-content: center
    }
  </style>
</head>
<body>
  <!----------------ADD---------------------------------->
  <div class="addCont" id="addCont">
    <div class="form-container" id="add">
        <h2>Add Product</h2>
        <form id="formA">
          <input id = "codeA" type="number" placeholder="Barcode" name = "CodeA" required >
          <input id = "nameA" type="text" placeholder="Product Name" name = "NameA" required >
          <input id = "priceA" type="number" placeholder="Price" name = "PriceA" required>
          <input id = "imageA" type="file" accept=".jpg" name="ImageA"  style="color:white;" required>
          <button type="submit" style="background-color: #90e17dff;" onclick="add()">Save Product</button>
          <button onclick="addPro.style.display = 'none'" style="background-color:#d96161ff;">close</button>
        </form>
      <div class="footer">Powered by cajx</div>
    </div>
  </div>
  <!----------------ADD---------------------------------->

  <!----------------EDIT---------------------------------->
  <div class="editCont" id="editCont">
    <div class="form-container" id="edt">
        <h2>Edit Product</h2>
        <form id="form">
          <input id = "codeE" type="number" placeholder="Barcode" name = "Code" required >
          <input id = "nameE" type="text" placeholder="Product Name" name = "Name" required >
          <input id = "priceE" type="number" placeholder="Price" name = "Price" required>
          <input id = "imageE" type="file" accept=".jpg" name="Image" style ="color:white;" >
          <button type="submit" onclick = "update()" style="background-color: #90e17dff;">Save Product</button>
          <button onclick="edt.style.display = 'none'" style="background-color:#d96161ff;">close</button>
        </form>
      <div class="footer">Powered by cajx</div>
    </div>
  </div>
  <!----------------EDIT---------------------------------->

  <div class="dashboard-container">
    <div class="dashboard-header">
      <h2>Admin Dashboard</h2>
      <button id="addPro" onclick="addPro.style.display = 'flex'">+ Add Product</button>
      <a href="logout.php">Log out</a>
    </div>

    <div class="product-list">
      <table>
        <thead>
          <tr>
            <th>Barcode</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="content">
          <!-- Sample rows (replace with DB data later) -->
        </tbody>
      </table>
    </div>
    <div id="btnCon">
      <button id="prev"><</button>
      <button id="next">></button>
    </div>
    <div class="footer">
      <p id="page">Page 1</p>
      Powered by cajx</div>
  </div>
  <script src="index.js"></script>
</body>
</html>
