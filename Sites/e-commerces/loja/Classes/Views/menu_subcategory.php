<?php foreach ($subs as $sub): ?>

        <a href="<?php echo BASE_URL.'page/enter/'.$sub['id']; ?>?=<?= $sub['name'];?>">
            <?php
            echo $sub['name'];
            ?>
        </a>
    <?php endforeach; ?>