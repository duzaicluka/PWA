<?php
session_start(); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "novosti";

$uspjesnaPrijava = false;
$admin = false;

if (isset($_POST['submit'])) {
    $enteredUsername = $_POST['username'];
    $enteredPassword = $_POST['lozinka'];

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM korisnik WHERE korisnicko_ime = ?");
    $stmt->bind_param("s", $enteredUsername);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if (password_verify($enteredPassword, $row['lozinka'])) {
            $uspjesnaPrijava = true;
            $admin = ($row['razina'] == 1);

            $_SESSION['korisnicko_ime'] = $row['korisnicko_ime'];
            $_SESSION['razina'] = $row['razina'];
        }
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <title>Login</title>
</head>
<body>

    <header>
        <div class="empty"></div>
        <nav>   
            <img src="images/logo.png" alt="logo" class="logo">
            <a href="index.php">NASLOVNICA</a>
            <a href="kategorija.php?id=putovanja">PUTUTOVANJA</a>
            <a href="kategorija.php?id=sport">SPORT</a>
            <a href="unos.php">UNOS</a>
            <a href="administracija.php">ADMINISTRACIJA</a>
            <?php
                if(isset($_SESSION['korisnicko_ime']) && $_SESSION['razina'] == 1){
                    echo '<a href="administracija.php">ADMINISTRACIJA</a>';
                    echo '<a href="logout.php">ODJAVA</a>';
                }else{
                    echo '<a href="login.php">PRIJAVA</a>';
                }
            ?>
        </nav>  
    </header>

    <main id="login">
        <?php
            if (isset($_POST['submit'])){
                if($uspjesnaPrijava && $admin){
                    echo '<p id="prijava">Dobar dan,' . $_SESSION['korisnicko_ime'] . ' Uspješno ste prijavljeni kao administrator!</p>';
                    echo '<a href="administracija.php">Nastavite na administraciju</a>';
                }else if($uspjesnaPrijava && !$admin){
                    echo '<p id="prijava">Dobar dan,' . $_SESSION['korisnicko_ime'] . ' Uspješno ste prijavljeni, ali ne kao administrator!</p>';
                }else{
                    echo '<p id="prijava">Prijava neuspješna, provjerite korisničko ime i lozinku.</p>';
                }
            }
        ?>

        <form action="" method="post">
            <h1>Prijava</h1>
            <div>
                <label for="username">Korisničko ime:</label>
                <input type="text" name="username" autofocus id="username"/>
                <span id="username-error" class="error"></span>
            </div>
            <div>
                <label for="lozinka">Lozinka:</label>
                <input type="password" name="lozinka" autofocus id="lozinka"/>
                <span id="lozinka-error" class="error"></span>
            </div>
            <div class="btn-div">
                <button type="submit" name="submit" id="submit">Prijava</button>
            </div>
            <div>
                <p>Nemate korisnički račun?</p>
                <a href="registracija.php">Registriraj se</a>
            </div>
        </form>
    </main>

    <footer>
        <p>&copy; 2019 Morgenpost Verlag GmbH</p>
    </footer>
    
</body>
</html>
