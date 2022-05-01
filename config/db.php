<?php
session_start();

$DATABASE_HOST = "localhost";
$DATABASE_USER = "root";
$DATABASE_PASS = "";
$DATABASE_NAME = 'portfolio database';

$con= mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_errno() ) {
    
    exit("Failure to connect to MySQL" . mysqli_connect_error());
}
//isset to check if data exists in login form
if (!isset($_POST['username'], $_POST['password'])) {
    exit("Please fill in Username AND password!")

}



//preparing MySQL

if($stmt = $conn -> prepare ('SELECT id, password FROM accounts WHERE username = ?')) {
$stmt->bind_param('s', $_POST['username']);
$stmt->execute();
$stmt->store_result();
}

if($stmt->num_rows > 0 ) {
    //adding account
    $stmt->bind_result($id,$password);
    $stmt->fetch();

    if($_POST['password'] === $password) {
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['id'] = $id;
        $_SESSION['name'] = $_POST['username'];
        echo 'Great to have you' . $_SESSION['name'] . '!';
    }
    else {
        echo 'Please put in correct username and password';
    }
    }


    }

}

$stmt->close();
}

?>


