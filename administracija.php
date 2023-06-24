<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <title>Administracija</title>
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

    <?php
        session_start();
        include 'connect.php';
        define('UPLPATH', 'images/');

        $query = "SELECT * FROM novosti";
        $result = mysqli_query($dbc, $query);
        while($row = mysqli_fetch_array($result)) {
            echo '<form enctype="multipart/form-data" action="" method="POST">
                        <div class="form-item">
                            <label for="title">Naslov vjesti:</label>
                            <div class="form-field">
                                <input type="text" name="title" class="form-field-textual" 
                                    value="'.$row['naslov'].'">
                            </div>
                        </div>
                        <div class="form-item">
                            <label for="about">Kratki sadržaj vijesti (do 50 znakova):</label>
                            <div class="form-field">
                                <textarea name="about" id="" cols="30" rows="10" class="form-field-textual">'.$row['sazetak'].'</textarea>
                            </div>
                        </div>
                        <div class="form-item">
                            <label for="content">Sadržaj vijesti:</label>
                            <div class="form-field">
                                <textarea name="content" id="" cols="30" rows="10" class="form-field-textual">'.$row['tekst'].'</textarea>
                            </div>
                        </div>
                        <div class="form-item">
                            <label for="pphoto">Slika:</label>
                            <div class="form-field">
                                <input type="file" class="input-text" id="pphoto" 
                                value="'.$row['slika'].'" name="pphoto"/> <br><img src="' . UPLPATH . 
                                $row['slika'] . '" width=80px>
                            </div>
                        </div>
                        <div class="form-item">
                            <label for="category">Kategorija vijesti:</label>
                            <div class="form-field">
                                <select name="category" id="" class="form-field-textual" value="'.$row['kategorija'].'">
                                    <option value="putovanja">Putovanja</option>
                                    <option value="sport">Sport</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-item">
                            <label>Spremiti u arhivu: 
                            <div class="form-field">';
                            if($row['arhiva'] == 0) {
                                echo '<input type="checkbox" name="archive" id="archive"/> 
                                    Arhiviraj';
                            } else {
                                echo '<input type="checkbox" name="archive" id="archive" 
                                    checked/> Arhiviraj?';
                            }
                        echo '</div>
                            </label>
                            </div>
                        </div>
                        <div class="form-item">
                            <input type="hidden" name="id" class="form-field-textual" value="'.$row['id'].'">
                            <button type="reset" value="Poništi">Poništi</button>
                            <button type="submit" name="update" value="Prihvati">Izmjeni</button>
                            <button type="submit" name="delete" value="Izbriši">Izbriši</button>
                        </div>
                    </form>
                    <hr class="linija" style="margin-top: 50px; border:3px solid black;">';
        }

        if(isset($_POST['delete'])){
            $id=$_POST['id'];
            $query = "DELETE FROM novosti WHERE id=$id ";
            $result = mysqli_query($dbc, $query);
        }


        if(isset($_POST['update'])){
            $picture = $_FILES['pphoto']['name'];
            $title=$_POST['title'];
            $about=$_POST['about'];
            $content=$_POST['content'];
            $category=$_POST['category'];

            if(isset($_POST['archive'])){
            $archive=1;
            }else{
            $archive=0;
            }

            $target_dir = 'img/'.$picture;
            move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target_dir);

            $id=$_POST['id'];
            $query = "UPDATE novosti SET naslov='$title', sazetak='$about', tekst='$content', 
            slika='$picture', kategorija='$category', arhiva='$archive' WHERE id=$id ";
            $result = mysqli_query($dbc, $query);
        }
    ?>

    <footer>
        <p>Copyright 2019 Morgenpost Verlag GmbH</p>
    </footer>

</body>
</html>