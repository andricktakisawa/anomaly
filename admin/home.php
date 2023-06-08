<?php require_once "controllerUserData.php"; ?>
<?php
/*

   _ \    _ \ \ \        /  ____|   _ \   ____|  __ \       __ ) \ \   /     _ _|   \  |   ___|   _ \ __ __|  ____| 
  |   |  |   | \ \  \   /   __|    |   |  __|    |   |      __ \  \   /        |     \ |  |      |   |   |    __|   
  ___/   |   |  \ \  \ /    |      __ <   |      |   |      |   |    |         |   |\  |  |      |   |   |    |     
 _|     \___/    \_/\_/    _____| _| \_\ _____| ____/      ____/    _|       ___| _| \_| \____| \___/   _|   _____| 
                                                                                                   
 https://incote.click
 
 */
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if ($email != false && $password != false) {
    $sql = "SELECT * FROM usertable WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if ($run_Sql) {
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if ($status == "verified") {
            if ($code != 0) {
                header('Location: reset-code.php');
            }
        } else {
            header('Location: user-otp.php');
        }
    }
} else {
    header('Location: login-user.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo $fetch_info['name'] ?> | Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

        nav {
            padding-left: 100px !important;
            padding-right: 100px !important;
            background: #e50000;
            font-family: 'Poppins', sans-serif;
        }

        nav a.navbar-brand {
            color: #fff;
            font-size: 20px !important;
            font-weight: 500;
        }

        button a {
            color: #e50000;
            font-weight: 500;
        }

        button a:hover {
            text-decoration: none;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .data-table-header {
            background: #fb3a3a;
            color: #fff;
            font-weight: 600;
            text-align: left;
        }

        .data-table-row:nth-child(even) {
            background: #f2f2f2;
        }

        .data-table-cell {
            padding: 8px 12px;
            border-bottom: 1px solid #ddd;
        }

        .data-table-empty {
            font-weight: 700;
            color: #888;
            text-align: center;
            padding-top: 20px;
        }

        .footer {
            background: #e50000;
            color: #fff;
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            padding: 20px 0;
            text-align: center;
        }

        .footer a {
            color: #eee;
            font-weight: 700;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <a class="navbar-brand" href="/">Anomaly Panel</a>
        <button type="button" class="btn btn-light"><a href="logout-user.php">Logout</a></button>
    </nav>
    <div class="container">
        <table class="data-table">
            <tr class="data-table-header">
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
            </tr>
            <?php
            require '../connection.php';

            $sql = "SELECT * FROM registros";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr class='data-table-row'>";
                    echo "<td class='data-table-cell'>" . $row['nombre'] . "</td>";
                    echo "<td class='data-table-cell'>" . $row['email'] . "</td>";
                    echo "<td class='data-table-cell'>" . $row['telefono'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td class='data-table-empty' colspan='3'>No hay registros disponibles</td></tr>";
            }

            $con->close();
            /*

            _ \    _ \ \ \        /  ____|   _ \   ____|  __ \       __ ) \ \   /     _ _|   \  |   ___|   _ \ __ __|  ____| 
            |   |  |   | \ \  \   /   __|    |   |  __|    |   |      __ \  \   /        |     \ |  |      |   |   |    __|   
            ___/   |   |  \ \  \ /    |      __ <   |      |   |      |   |    |         |   |\  |  |      |   |   |    |     
            _|     \___/    \_/\_/    _____| _| \_\ _____| ____/      ____/    _|       ___| _| \_| \____| \___/   _|   _____| 
                                                                                                            
            https://incote.click
            
            */
            ?>
        </table>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="text-center">Powered by <a href="https://incote.click">Incote</a></p>
        </div>
    </footer>

</body>

</html>