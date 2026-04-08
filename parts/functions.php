<?php
function generatePortfolio($dir) {
    $json = file_get_contents($dir);
    $portfolio = json_decode($json, true);

    if (!$portfolio) {
        echo "<p>Portfolio could not be loaded.</p>";
        return;
    }

    $count = 0;

    echo '<section class="container">';

    foreach ($portfolio as $item) {
        if ($count % 4 == 0) {
            echo '<div class="row">';
        }

        echo '
        <div class="col-25 portfolio text-white text-center" id="'.$item['id'].'">
            '.$item['title'].'
        </div>
        ';

        $count++;

        if ($count % 4 == 0) {
            echo '</div>';
        }
    }

    if ($count % 4 != 0) {
        echo '</div>';
    }

    echo '</section>';
}

function renderSlides($jsonPath = "data/slides.json") {
    if (!file_exists($jsonPath)) {
        echo "<p>Slides JSON not found.</p>";
        return;
    }

    $slides = json_decode(file_get_contents($jsonPath), true);

    if (!$slides) {
        echo "<p>No slides available.</p>";
        return;
    }

    foreach ($slides as $slide): ?>
        <div class="slide fade">
            <img src="<?= htmlspecialchars($slide["image"]) ?>">
            <div class="slide-text">
                <?= htmlspecialchars($slide["title"]) ?>
            </div>
        </div>
    <?php endforeach;
}