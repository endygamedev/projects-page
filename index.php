<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Projects Repository | Egor Bronnikov</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/png" href="/assets/favicon.png">
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css'>
  <link rel='stylesheet' href='https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css'>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css'><link rel="stylesheet" href="./style.css">
</head>

<body>
  <nav class="navbar navbar-light">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="https://ebronnikov.xyz">Egor Bronnikov</a>
      </div>
      <ul class="nav navbar-nav">
        <li class="active"><a href="https://ebronnikov.xyz">Blog</a></li>
        <li class="active"><a href="https://ebronnikov.xyz/cv/">CV</a></li>
      </ul>
    </div>
  </nav>
  <div class="container">
    <div class="page-header header">
      <h2>Projects Repository</h2>
    </div>
    <div class="row">
      <div class="col-md-12">
        <?php
        echo "<table id='example' class='table table-striped table-bordered'>";
        echo "<thead><tr><th style='width:12%'>Title</th><th>Description</th><th>Language</th><th style='width:10%'>Created at</th><th>Link</th><th style='width:9%'>Size (kb)</th></tr></thead>";
        
        class TableRows extends RecursiveIteratorIterator {
          function __construct($it) {
            parent::__construct($it, self::LEAVES_ONLY);
          }
        
          function current() {
            return "<td>" . parent::current(). "</td>";
          }
        
          function beginChildren() {
            echo "<tr>";
          }
        
          function endChildren() {
            echo "</tr>" . "\n";
          }
        }
        
        $servername = getenv("PSERVER");
        $username = getenv("PUSERNAME");
        $password = getenv("PPASSWORD");
        $dbname = "web";
        
        try {
          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT title, description_, language_, created_at, link, size FROM projects");
          $stmt->execute();
        
          $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
          foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
            echo $v;
          }
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
        $conn = null;
        echo "</table>";
        ?>
      </div>
    </div>
  </div>
  <footer>
    <div class="fheader">Stay Connected</div>
    <div class="fcontainer">
      <ul>
        <li><a href="https://t.me/endygamedev" target="blank_"><img src="/assets/icons/telegram.png" height="30px"></a></li>
        <li><a href="https://open.spotify.com/user/216ndgqqr2hlj3be4gf3rjzoa?si=lpxoOBCaQP27CwF-ThjNLg&utm_source=copy-link" target="blank_"><img src="/assets/icons/spotify.png" height="30px"></a></li>
        <li><a href="https://www.instagram.com/endygamedev/" target="blank_"><img src="/assets/icons/instagram.png" height="30px"></a></li>
      </ul>
    </div>
    <div class="ffooter">ebronnikov.xyz</div>
  </footer>

<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js'></script>
<script src='https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js'></script>
<script src='https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js'></script>
<script src='https://cdn.jsdelivr.net/momentjs/latest/moment.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js'></script><script src="./script.js"></script>

</body>
</html>