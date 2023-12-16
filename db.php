<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="final.css">
</head>

<body>
    

    <?php
    session_start();
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $dbName = "registration";

    $con = mysqli_connect($serverName, $userName, $password, $dbName);

    if (mysqli_connect_errno()) {
        // echo "Failed to conned";
        exit();
    }
    // else 
    // echo "connection success";

    if (isset($_POST['submit'])){
    // echo '<br>';
    $email =$_POST['email'];
    // echo $email;
    // echo '<br>';
    $pass =md5($_POST['pass']);
    // echo $pass;
    // echo '<br>';
        $query = mysqli_query($con, "SELECT name FROM usertb WHERE email = '$email' AND password = '$pass'");
        if ($query) {
            $row = mysqli_fetch_assoc($query);
            $name = $row['name'];
            echo '<h1 class ="name">';
            echo "Welcome  <span class='n'> $name </span>";
            echo '</h1>';
        } else {
            echo '<br>';
            echo "Failed to reach to the email and password";
        }
    }

        elseif (isset($_POST['register'])) {
            // echo "in if statement";
            $email = $_POST['email'];
            // echo $email;
            // echo '<br>';
            $pass = md5($_POST['password']);
            // echo $pass;
            // echo '<br>';
            $name = $_POST['username'];
            // echo $name;
            // echo '<br>';

            $check = mysqli_query($con, "SELECT email , password FROM usertb WHERE email = '$email' OR password = '$pass'");
            if(!mysqli_num_rows($check)){
            $sql = "INSERT INTO usertb (email, name, password) VALUES ('$email','$name','$pass')";
            if(mysqli_query($con,$sql)){
                echo
                "<script>
                alert('You have been registered successfully!');
                window.location.href='login.html';
                </script>";
                // echo '<h1 class ="name">';
                // echo "Welcome  <span class='n'> $name </span>";
                // echo '</h1>';
            } else {
            echo "Failed to insert data: " . mysqli_error($con);
        }
    }
    else{
            echo "<script>
                window.location.href='register.html';
                alert('There is an email or password exist already in DB');
                </script>";
    }

        }

    ?>
</body>

</html>