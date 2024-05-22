<?php
            $dbservername = "localhost";
            $dbusername = "root";
            $dbpassword = "";
            $dbdatabase = "projekt";

            $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbdatabase);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT url AS image_url 
                    FROM images ";
                    
                $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    if ($row['image_url']) {
                        echo '<img class="grid-img" src="../strona/uploads/' . $row['image_url'] . '" alt="Advertisement photo">';
                    }}}
?>