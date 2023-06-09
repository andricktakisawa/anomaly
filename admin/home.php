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
    <title>Anomaly | Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
        }

        nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            color: #000;
            padding: 10px 30px;
        }

        nav a.navbar-brand {
            color: #000;
            font-size: 20px;
            font-weight: 500;
        }

        .container {
            padding: 20px;
            margin-top: 20px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 10px rgb(255 7 7 / 10%)
        }

        .data-table-header {
            background: #fb3a3a;
            color: #fff;
            font-weight: 600;
            text-align: left;
        }

        .data-table-row:nth-child(even) {
            background: rgba(255, 255, 255, 0.5);
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
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            color: #000;
            padding: 20px 0;
            text-align: center;
            margin-top: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .footer a {
            color: #000;
            font-weight: 700;
            text-decoration: none;
        }

        .copy-icon {
            cursor: pointer;
            color: #fb3a3a;
            transition: color 0.3s ease;
        }

        .copy-icon:hover {
            color: #e50000;
        }

        .glassmorphism {
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(20px);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>

<body>
    <?php require_once "controllerUserData.php"; ?>
    <?php
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

    <nav class="navbar">
        <a class="navbar-brand" href="/">Anomaly Panel</a>
        <button type="button" class="btn btn-light"><a href="logout-user.php">Logout</a></button>
    </nav>
    <div class="container">
        <div class="glassmorphism">
            <table class="data-table">
                <thead>
                    <tr class="data-table-header">
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
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
                            echo "<td class='data-table-cell'><i class='fas fa-clipboard copy-icon'></i></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td class='data-table-empty' colspan='4'>No hay registros disponibles</td></tr>";
                    }

                    $con->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p>Powered by <a href="https://cwa.mx">CWA</a> & <a href="https://incote.click">Incote</a></p>
        </div>
    </footer>

    <script>
        function copyTableRow(event) {
            var tableRow = event.target.parentNode.parentNode;
            var range = document.createRange();
            range.selectNode(tableRow);
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(range);

            try {
                var successful = document.execCommand('copy');
                if (successful) {
                    var icon = event.target;
                    icon.classList.remove('fa-clipboard');
                    icon.classList.add('fa-check');

                    setTimeout(function() {
                        icon.classList.remove('fa-check');
                        icon.classList.add('fa-clipboard');
                    }, 2000);
                }
            } catch (err) {
                console.log('Error copying table row: ', err);
            }

            window.getSelection().removeAllRanges();
        }

        var copyIcons = document.querySelectorAll('.copy-icon');
        copyIcons.forEach(function(icon) {
            icon.addEventListener('click', copyTableRow);
        });
    </script>
</body>

</html>