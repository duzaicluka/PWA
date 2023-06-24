<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>

    <?php
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $title=$_POST['title'];
            $category=$_POST['category'];
            $image=$_FILES['pphoto']['name'];
            $about=$_POST['about'];
            $content=$_POST['content'];
            $date=date('d.m.Y.');
            if(isset($_POST['archive'])){
                $archive=1;
            }else{
                $archive=0;
            }
        }
    ?>

    <header>
        <div class="empty"></div>
        <nav>   
            <img src="images/logo.png" alt="logo" class="logo">
            <a href="index.php">NASLOVNICA</a>
            <a href="kategorija.php?id=putovanja">PUTUTOVANJA</a>
            <a href="kategorija.php?id=sport">SPORT</a>
            <a href="unos.php">UNOS</a>
            <a href="administracija.php">ADMINISTRACIJA</a>
            <a href="login.php">PRIJAVA</a>
        </nav>  
    </header>

    <div class="container">
        <div class="container-wrapper white">
            <section role="main">
                <div class="row">
                    <h2 class="category"><?php
                    echo $category;
                    ?>
                    </h2>
                    <h1 class="title"><?php
                    echo $title;
                    ?>
                    </h1>
                    <div class="autor">
                        <p>AUTOR:</p>
                        <p>OBJAVLJENO:  <?php
                    echo $date;
                    ?> </p>
                    </div>
                </div>

                <section class="slika">
                <?php
                echo "<img src='images/$image'";
                ?>
                </section>
                <section class="about">
                <p>
                <?php
                echo $about;
                ?>
                </p>
                </section>
                <section class="sadrzaj">
                <p>
                <?php
                echo $content;
                ?>
                </p>
                </section>
            </section>
        </div>

        <footer>
            <p>Copyright 2019 Morgenpost Verlag GmbH</p>
        </footer>
    </div>
</body>
</html>


<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty($_POST['title']) || empty($_POST['about']) || empty($_POST['content']) || empty($_POST['category']) || empty($_FILES['pphoto']['name'])) {
            echo "Unesi podatke";
        } else {
            include 'connect.php';

            $picture = $_FILES['pphoto']['name'];
            $title = $_POST['title'];
            $about = $_POST['about'];
            $content = $_POST['content'];
            $category = $_POST['category'];
            $date = date('d.m.Y.');
            if (isset($_POST['archive'])) {
                $archive = 1;
            } else {
                $archive = 0;
            }

            $target_dir = 'images/' . $picture;
            move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target_dir);

            $query = "INSERT INTO novosti (datum, naslov, sazetak, tekst, slika, kategorija, arhiva)
            VALUES ('$date', '$title', '$about', '$content', '$picture', '$category', '$archive')";

            $result = mysqli_query($dbc, $query) or die('Error querying database.');

            mysqli_close($dbc);
        }
    }
?>





