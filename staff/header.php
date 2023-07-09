
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.css" />
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<style>
    
.dropbtn {
border: 0;
padding-top: 8px;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
}

.white-shadow{
    background: rgb(224, 224, 224);
    padding: 16px 20px;
     transition: 0.5s all;

}
.its-banner-grid:nth-child(3),.its-banner-grid:nth-child(4),
.its-banner-grid:nth-child(5),.its-banner-grid:nth-child(6),
.its-banner-grid:nth-child(7),.its-banner-grid:nth-child(8),
.its-banner-grid:nth-child(9),.its-banner-grid:nth-child(10){
    margin-top: 31px;
}
.its-banner-grid:hover span.banner-icon,.bg-w3ls-active span.banner-icon {
    color: #000;
    border: 2px solid rgb(0, 0, 0);

}
.white-shadow:hover{background:rgba(117, 177, 214, 0.98);}


 .icons {   padding: 10px 0px 0px;}
.icons ul li{
    display: inline-block;
}
.icons ul li a {
  color: #337ab7;
}
.icons ul li a span.fa{
   margin:0.5em;
  font-size:19px;
    transition: 0.5s all;
    -webkit-transition: 0.5s all;
    -moz-transition: 0.5s all;
    -o-transition: 0.5s all;
    -ms-transition: 0.5s all;
      border: 1px solid;
    width: 38px;
    height: 38px;
    line-height: 37px;
    border-radius: 50px;
}
.icons ul li a span.fa.fa-facebook:hover {
    color: #3b5998;
}

.icons ul li a span.fa.fa-twitter:hover{
  color: #55acee;
}
.icons ul li a span.fa.fa-rss:hover{
  color: #f26522;
}
.icons ul li a span.fa.fa-vk:hover{
  color: #45668e;
}

.letter input[type="email"] {
    outline: none;
    color: #fff;
    font-size: 14px;
    padding: 10px;
    width: 100%;
    float: left;
    background: #000;
}
.newsletter input[type="submit"], .newsletter a {
    outline: none;
    display: inline-block;
    color: #fff;
    font-size: 16px;
    padding: 8px 0;
    font-weight: 700;
    width: 100%;
    background: #337ab7;
    transition: 0.5s all;
    -webkit-transition: 0.5s all;
    -moz-transition: 0.5s all;
    -o-transition: 0.5s all;
    -ms-transition: 0.5s all;
}
</style>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
  <a class="navbar-brand" href="\PB_M\staff\index.php"><b>Promising<span>♡</span>Best Merchandises</b></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="\PB_M\staff\index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="\PB_M\staff\manage_delivery.php">Delivery</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="\PB_M\staff\manage_order.php">Orders</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="\PB_M\staff\question_display.php">FAQs</a>
      </li>

      <li class="nav-item">
        <div class="dropdown">
          <a class="dropbtn nav-link">Merchandises</a>
          <div class="dropdown-content">
            <a href="\PB_M\order\merchandise_entry.php">Merchandises</a>
            <a href="\PB_M\staff\material_type\index.php">Materials</a>
            <a href="\PB_M\staff\printing_type\index.php">Printing</a>
            <a href="\PB_M\staff\product_type\pt_index.php">Product</a>
            <a href="\PB_M\staff\resource\resource_index.php">Resource</a>
            <a href="\PB_M\staff\purchase\purchase_index.php">Purchase</a>
            <a href="\PB_M\staff\Supplier\Supplier_index.php">Supplier</a>
          </div>
        </div>
      </li>

    </ul>
  </div>
</div>
</nav>