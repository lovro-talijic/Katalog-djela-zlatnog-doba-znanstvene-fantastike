<?php

define('XML_FILE', __DIR__ . '/knjige.xml');

function loadBooks() {
    if (!file_exists(XML_FILE)) return [];

    $xml = simplexml_load_file(XML_FILE);
    if (!$xml) return [];

    $books = [];

    foreach ($xml->Knjiga as $k) {
        $a = $k->attributes();
        $p = $k->Publikacija;
        $c = $k->Klasifikacija;

        $books[] = [
            'isbn' => (string)$a['isbn'],
            'lang' => (string)$a['language'],
            'title' => (string)$k->Naslov,
            'author' => (string)$k->Autor,
            'summary' => (string)$k->Sazetak,
            'slika' => (string)$k->Slika,

            'pub' => [
                'publisher' => (string)$p->Izdavac,
                'year'      => (string)$p->Datum,
                'edition'   => (string)$p->Izdanje,
                'format'    => (string)$p->Format,
                'series'    => (string)$p->Edicija,
            ],

            'class' => [
                'genre' => (string)$c->Zanr,
                'theme' => (string)$c->Tema,
            ]
        ];
    }

    return $books;
}

function e($s) {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

$books = loadBooks();
$query = strtolower(trim($_GET['q'] ?? ''));

$allBooks = $books;

if ($query !== '') {
    $books = array_filter($allBooks, function ($b) use ($query) {
        return str_contains(strtolower($b['title']), $query) ||
               str_contains(strtolower($b['author']), $query) ||
               str_contains(strtolower($b['pub']['year']), $query) ||
               str_contains(strtolower($b['class']['genre']), $query) ||
               str_contains(strtolower($b['class']['theme']), $query);
    });

    $books = array_values($books);
}

$current = $books[0] ?? null;

if (!empty($_GET['isbn'])) {
    foreach ($books as $b) {
        if ($b['isbn'] === $_GET['isbn']) {
            $current = $b;
            break;
        }
    }
}

function flag($code) {

    if (empty($code)) {
        return '';
    }

    $url = "https://restcountries.com/v3.1/alpha/" . strtolower($code);

    $response = @file_get_contents($url);

    if ($response === false) {
        return '';
    }

    $data = json_decode($response, true);

    return $data[0]['flags']['png'] ?? '';
}

$currentPage = 'katalog';
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="PPDI - CSS.css">
    <title>SF Katalog</title>
</head>

<body class="body">

<section class="top">
    <h1>Zlatno doba znanstvene fantastike</h1>
    <h2>Katalog knjiga</h2>
</section>

<nav style="
    display: flex;
    gap: 15px;
    background-color: rgba(0, 0, 0, 0.7);
    padding: 10px 20px;
    align-items: center;
">

    <?php if ($currentPage !== 'home'): ?>
        <a href="index.php" style="color:white; text-decoration:none;">Početna</a>
    <?php endif; ?>

    <?php if ($currentPage !== 'katalog'): ?>
        <a href="knjige.php" style="color:white; text-decoration:none;">Katalog</a>
    <?php endif; ?>

    <?php if ($currentPage !== 'o'): ?>
        <a href="o_projektu.php" style="color:white; text-decoration:none;">O projektu</a>
    <?php endif; ?>

</nav>

<section class="searchsection">
    <form method="get">
        <input class="searchbar" type="search" name="q"
               placeholder="Naslov, autor, godina..."
               value="<?= e($query) ?>">
        <button>Pretraži</button>

        <?php if ($current): ?>
            <input type="hidden" name="isbn" value="<?= e($current['isbn']) ?>">
        <?php endif; ?>
    </form>
</section>

<section class="main">

    <article class="main-sidebar">

        <?php if (!$books): ?>
            <h3>Nema knjiga.</h3>
        <?php endif; ?>

        <?php if ($current): ?>

            <hr>

            <h3>Detalji knjige</h3>

            <p><b>Pisac:</b> <?= e($current['author']) ?></p>
            <p><b>Naslov:</b> <?= e($current['title']) ?></p>
            <p><b>Godina:</b> <?= e($current['pub']['year']) ?></p>
            <p><b>Format:</b> <?= e($current['pub']['format']) ?></p>

            <p><b>Jezik:</b>
                <?php if (!empty($current['lang'])): ?>
                    <img src="<?= flag($current['lang']) ?>" width="30">
                <?php endif; ?>
            </p>

            <p><b>Izdavač:</b> <?= e($current['pub']['publisher']) ?></p>
            <p><b>Edicija:</b> <?= e($current['pub']['series']) ?></p>
            <p><b>Izdanje:</b> <?= e($current['pub']['edition']) ?></p>
            <p><b>Žanr:</b> <?= e($current['class']['genre']) ?></p>
            <p><b>Tema:</b> <?= e($current['class']['theme']) ?></p>
            <p><b>ISBN:</b> <?= e($current['isbn']) ?></p>

            <?php if ($current['summary']): ?>
                <h3>Sažetak</h3>
                <p><?= e($current['summary']) ?></p>
            <?php endif; ?>

        <?php endif; ?>

    </article>

    <article class="main-content">
        <?php if ($current): ?>
            <img src="<?= e($current['slika']) ?>" alt="book cover">
        <?php endif; ?>
    </article>

</section>

</body>
</html>
