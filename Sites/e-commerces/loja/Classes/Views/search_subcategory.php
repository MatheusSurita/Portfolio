<?php foreach ($subs as $sub) : ?>

    <option value="<?php echo $sub['id']; ?>?=<?php echo $sub['name']; ?>">
        <?php
        echo $sub['name'];
        ?>
    </option>
<?php endforeach; ?>