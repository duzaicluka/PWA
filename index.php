<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projekt PWA</title>
    <link rel="stylesheet" href="style.css" />
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
            <a href="login.php">PRIJAVA</a>
            </nav>  
    </header>

    <div class="container">
        <div class="container-wrapper">
            <div class="reise">
                <h2 >PUTOVANJA</h2>
                <hr class="line">
            </div>

            <?php
                include 'connect.php';
                define('UPLPATH', 'images/');
            ?>

            <section class="articles">
                <?php
                    $query = "SELECT * FROM novosti WHERE arhiva=0 AND kategorija='putovanja' LIMIT 3";
                    $result = mysqli_query($dbc, $query);
                    while($row = mysqli_fetch_array($result)) {
                    echo '<article>';
                            echo'<div class="article-image">';
                                echo'<img src="' . UPLPATH . $row['slika'] . '" alt="slikaa" class="article-thumbnail">';
                            echo'</div>';
                            echo'<div class="caption">';
                                echo '<a href="clanak.php?id='.$row['id'].'">';
                                    echo '<h1>' . $row['naslov'] . '</h1>';  
                                echo '</a>';
                            echo'</div>';
                    echo '</article>';
                    }
                ?> 
            </section>

            <div class="reise">
                <h2 >SPORT</h2>
                <hr class="line">
            </div>

            <section class="articles">
                <?php
                    $query = "SELECT * FROM novosti WHERE arhiva=0 AND kategorija='sport' LIMIT 3";
                    $result = mysqli_query($dbc, $query);
                    while($row = mysqli_fetch_array($result)) {
                    echo '<article>';
                        echo'<div class="article-image">';
                            echo'<img src="' . UPLPATH . $row['slika'] . '" alt="slikaa" class="article-thumbnail">';
                        echo'</div>';
                        echo'<div class="caption">';
                            echo '<a href="clanak.php?id='.$row['id'].'">';
                                echo '<h1>' . $row['naslov'] . '</h1>';  
                            echo '</a>';
                        echo'</div>';
                    echo '</article>';
                    }
                ?> 
            </section>
        </div>
    </div>

    <footer>
        <p>Copyright 2019 Morgenpost Verlag GmbH</p>
    </footer>
</body>
</html>