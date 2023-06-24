<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"/>
    <title>Unos</title>
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

    <div class="container1">
        <div class="container-wrapper1">
            <form enctype="multipart/form-data" action="skripta.php" method="POST">
                <div class="form-item">
                    <span id="porukaTitle" class="bojaPoruke"></span>
                    <label for="title">Naslov vjesti</label>
                    <div class="form-field">
                        <input type="text" name="title" id="title" class="form-field-textual">
                    </div>
                </div>
                <div class="form-item">
                    <span id="porukaAbout" class="bojaPoruke"></span>
                    <label for="about">Kratki sadržaj vjesti (do 50 znakova)</label>
                    <div class="form-field">
                        <textarea name="about" id="about" cols="30" rows="10" class="form-field-textual"></textarea>
                    </div>
                </div>
                <div class="form-item">
                    <span id="porukaContent" class="bojaPoruke"></span>
                    <label for="content">Sadržaj vjesti</label>
                    <div class="form-field">
                        <textarea name="content" id="content" cols="30" rows="10"class="form-field-textual"></textarea>
                    </div>
                </div>
                <div class="form-item">
                    <span id="porukaSlika" class="bojaPoruke"></span>
                    <label for="pphoto">Slika: </label>
                    <div class="form-field">
                        <input type="file" class="input-text" id="pphoto" name="pphoto"/>
                    </div>
                </div>
                <div class="form-item">
                    <span id="porukaKategorija" class="bojaPoruke"></span>
                    <label for="category">Kategorija vjesti</label>
                    <div class="form-field">
                        <select name="category" id="category" class="form-field-textual">
                            <option value="" disabled selected>Odabir kategorije</option>
                            <option value="putovanja">Putovanja</option>
                            <option value="sport">Sport</option>
                        </select>
                    </div>
                </div>
                <div class="form-item">
                    <label>Spremiti u arhivu: 
                        <div class="form-field">
                            <input type="checkbox" name="archive" id="archive">
                        </div>
                    </label>
                </div>
                <div class="form-item">
                    <button type="reset" value="Poništi">Poništi</button>
                    <button type="submit" value="Prihvati" id="slanje">Prihvati</button>
                </div>
            </form>

            <script type="text/javascript">
                document.getElementById("slanje").onclick = function(event) {
                    
                    var slanjeForme = true;
 
                    var poljeTitle = document.getElementById("title");
                    var title = document.getElementById("title").value;
                    if (title.length < 5 || title.length > 30) {
                    slanjeForme = false;
                    poljeTitle.style.border="1px dashed red";
                    document.getElementById("porukaTitle").innerHTML="Naslov vjesti mora imati između 5 i 30 znakova!<br>";
                    document.getElementById("porukaTitle").style.color = "red";
                    } else {
                    poljeTitle.style.border="1px solid green";
                    document.getElementById("porukaTitle").innerHTML="";
                    }
 
                    var poljeAbout = document.getElementById("about");
                    var about = document.getElementById("about").value;
                    if (about.length < 10 || about.length > 100) {
                    slanjeForme = false;
                    poljeAbout.style.border="1px dashed red";
                    document.getElementById("porukaAbout").innerHTML="Kratki sadržaj mora imati između 10 i 100 znakova!<br>";
                    document.getElementById("porukaAbout").style.color = "red";
                    } else {
                    poljeAbout.style.border="1px solid green";
                    document.getElementById("porukaAbout").innerHTML="";
                    }

                    var poljeContent = document.getElementById("content");
                    var content = document.getElementById("content").value;
                    if (content.length == 0) {
                    slanjeForme = false;
                    poljeContent.style.border="1px dashed red";
                    document.getElementById("porukaContent").innerHTML="Sadržaj mora biti unesen!<br>";
                    document.getElementById("porukaContent").style.color = "red";
                    } else {
                    poljeContent.style.border="1px solid green";
                    10
                    document.getElementById("porukaContent").innerHTML="";
                    }

                    var poljeSlika = document.getElementById("pphoto");
                    var pphoto = document.getElementById("pphoto").value;
                    if (pphoto.length == 0) {
                    slanjeForme = false;
                    poljeSlika.style.border="1px dashed red";
                    document.getElementById("porukaSlika").innerHTML="Slika mora biti unesena!<br>";
                    document.getElementById("porukaSlika").style.color = "red";
                    } else {
                    poljeSlika.style.border="1px solid green";
                    document.getElementById("porukaSlika").innerHTML="";
                    }

                    var poljeCategory = document.getElementById("category");
                    if(document.getElementById("category").selectedIndex == 0) {
                    slanjeForme = false;
                    poljeCategory.style.border="1px dashed red";
                    document.getElementById("porukaKategorija").innerHTML="Kategorija mora biti odabrana!<br>";
                    document.getElementById("porukaKategorija").style.color = "red";
                    } else {
                    poljeCategory.style.border="1px solid green";
                    document.getElementById("porukaKategorija").innerHTML="";
                    }
 
                    if (slanjeForme != true) {
                    event.preventDefault();
                    }
                    
                    };
            </script>
        </div>
    </div>
    
    <footer>
        <p>Copyright 2019 Morgenpost Verlag GmbH</p>
    </footer>

</body>
</html>


