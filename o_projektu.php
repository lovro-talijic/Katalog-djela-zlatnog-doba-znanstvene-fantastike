<?php
$page = $_GET['page'] ?? 'home';
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>SF Katalog</title>
    <link rel="stylesheet" href="PPDI - CSS.css">
</head>

<body class="body">

<section class="top">
    <h1>Zlatno doba znanstvene fantastike</h1>
    <h2>Katalog knjiga</h2>
</section>

<nav style="display:flex; gap:10px; background:rgba(0,0,0,0.7); padding:10px 20px;">
    <a href="index.php?page=home" style="color:white;">Početna</a>
    <a href="knjige.php?page=katalog" style="color:white;">Katalog</a>
</nav>

<section style="max-width:900px; margin:50px auto; padding:30px; background:rgba(0,0,0,0.7); color:white; border-radius:10px;">

<div style="
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 70vh;
">

    <div style="
        background-color: rgba(0, 0, 0, 0.7);
        padding: 40px;
        border-radius: 12px;
        color: white;
        text-align: center;
        max-width: 700px;
    ">
        <h2>O projektu</h2>

        <p>
            Projekt izrađen za predmet <strong>Podatkovna povezanost i digitalna infrastruktura</strong>.
        </p>

        <h3>Izvori slika korištenih u projektu</h3>

        <ul style="text-align:left;">

    <li><a href="https://gnomepress.com/wp-content/uploads/2023/01/Foundation-and-Empire-original-cover-small.jpg" target="_blank">Foundation</a></li>

    <li><a href="https://upload.wikimedia.org/wikipedia/commons/e/ea/Starship_Troopers_%281959%29_front_cover%2C_first_edition.jpg" target="_blank">Starship Troopers</a></li>

    <li><a href="https://i.ebayimg.com/images/g/mvIAAOSw36dnYFhB/s-l500.jpg" target="_blank">The Martian Chronicles</a></li>

    <li><a href="https://i.ebayimg.com/images/g/trcAAOSwy-lmJSWZ/s-l400.jpg" target="_blank">Dune</a></li>

    <li><a href="https://m.media-amazon.com/images/S/compressed.photo.goodreads.com/books/1156897088i/350.jpg" target="_blank">Stranger in a Strange Land</a></li>

</ul>
    </div>

</div>

</body>

</html>