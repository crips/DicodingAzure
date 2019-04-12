<html>
 <head>
 <Title>Bukabuku</Title>
 <style type="text/css">
 	body { background-color: #fff; border-top: solid 10px #000;
 	    color: #333; font-size: .85em; margin: 20; padding: 20;
 	    font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
 	}
 	h1, h2, h3,{ color: #000; margin-bottom: 0; padding-bottom: 0; }
 	h1 { font-size: 2em; }
 	h2 { font-size: 1.75em; }
 	h3 { font-size: 1.2em; }
 	table { margin-top: 0.75em; }
 	th { font-size: 1.2em; text-align: left; border: none; padding-left: 0; }
 	td { padding: 0.25em 2em 0.25em 0em; border: 0 none; }
 </style>
 </head>
 <body>
 <h1>Tambahkan Buku Baru</h1>
 <form method="post" action="index.php" enctype="multipart/form-data" >
       Judul  <input type="text" name="Judul" id="Judul"/></br></br>
       Kategori <select name="kategori" id="kategori">
                    <option name="Romance" value="Romance">Romance</option>
                    <option name="Comedy" value="Comedy">Comedy</option>
                    <option name="Horror" value="Horror">Horror</option>
                    <option name="Action" value="Action">Action</option>
                    <option name="Drama" value="Drama">Drama</option>
                    <option name="Fantasy" value="Fantasy">Fantasy</option>
       </select></br></br>
       harga <input type="text" name="Harga" id="Harga"/></br></br>
       <input type="submit" name="submit" value="Simpan" />
       <input type="submit" name="load_data" value="Load Data" />
 </form>

 <?php
	$host = "tcp:bukabuku.database.windows.net, 1433";
    $user = "mafrizal";
    $pass = "Timpakul2016+";
    $db = "bukabuku";

    try {
        $conn = new PDO("sqlsrv:server = $host; Database = $db", $user, $pass);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    } catch(Exception $e) {
        echo "Failed: " . $e;
    }

	if (isset($_POST['submit'])) {
        try {
			$judul = $_POST['Judul'];
            $Kategori = $_POST['Kategori'];
            $Harga = $_POST['Harga'];
            
            // Insert data
            $sql_insert = "INSERT INTO Bukuku (Judul, Kategori, Harga, date) VALUES ('$judul','$Kategori','$Harga', GETDATE())";
            $stmt = $conn->prepare($sql_insert);
            $stmt->bindValue(1, $judul);
            $stmt->bindValue(2, $Kategori);
            $stmt->bindValue(3, $Harga);
            $stmt->execute();
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }
        echo "<h3>Sukses :D</h3>";
    } else if (isset($_POST['load_data'])) {
        try {
            $sql_select = "SELECT * FROM Bukuku";
            $stmt = $conn->query($sql_select);
            $registrants = $stmt->fetchAll(); 
            if(count($registrants) > 0) {
                echo "<h2>Data Buku:</h2>";
                echo "<table>";
                echo "<tr><th>Judul</th>";
                echo "<th>kategori</th>";
                echo "<th>Harga</th>";
                echo "<th>TglDitambahkan</th></tr>";
                foreach($registrants as $registrant) {
                    echo "<tr><td>".$registrant['Judul']."</td>";
                    echo "<td>".$registrant['Kategori']."</td>";
                    echo "<td>".$registrant['Harga']."</td>";
                    echo "<td>".$registrant['TglDitambahkan']."</td></tr>";
                }
                echo "</table>";
            } else {
                echo "<h3>Tidak ada buku, tambahkan baru</h3>";
            }
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }
    }
 ?>
 </body>
 </html>