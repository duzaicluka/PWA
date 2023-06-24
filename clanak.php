<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Članak</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

    <header class="header-clanak">
        <div class="empty"></div>
        <nav class="clanak-nav">   
            <img src="images/logo.png" alt="logo" class="logo">
            <a href="index.php">NASLOVNICA</a>
            <a href="kategorija.php?id=putovanja">PUTUTOVANJA</a>
            <a href="kategorija.php?id=sport">SPORT</a>
            <a href="unos.php">UNOS</a>
            <a href="administracija.php">ADMINISTRACIJA</a>
        </nav>  
    </header>

           

    <div class="page-wrapper">
        <div class="container-clanak">
            <div class="container-wrapper">

                <?php
                    include 'connect.php';
                    define('UPLPATH', 'images/');
                    $id=$_GET['id'];
                    $query= "SELECT * FROM novosti WHERE id='$id'";
                    $result= mysqli_query($dbc, $query);
                    if($row=mysqli_fetch_array($result)){
                ?>

                <section role="main">
                    <div class="row">
                        <h2 class="category"><?php
                        echo $row['kategorija'];
                        ?><hr>
                        </h2>
                        <h1 class="title"><?php
                        echo $row['naslov'];
                        ?>
                        </h1>
                        <div class="autor">
                            <p>AUTOR:</p>
                            <p>OBJAVLJENO:  <?php
                            echo  $row[ 'datum'];
                            ?> </p>
                        </div>
                    </div>
                    <section class="slika">
                        <img src="<?php echo  UPLPATH . $row['slika']; ?>" alt="">
                    </section>
                    <section class="about">
                        <p>
                        <?php
                        echo $row['sazetak'];
                        ?>
                        </p>
                    </section>
                    <section class="sadrzaj">
                        <p>
                        <?php
                        echo $row['tekst'];
                        ?>
                        </p>
                    </section>
                </section>
                <?php
                }else{
                    echo 'Nema rezultata!';
                }
                ?>
            </div>
        </div>

        <footer>
            <p>Copyright 2019 Morgenpost Verlag GmbH</p>
        </footer>
    </div>
    
</body>
</html>