<?php foreach ($list as $widgets) : ?>
    <li class="item-a">
        <div class="master-box">

            <a href="<?php echo BASE_URL; ?>product/open/<?= $widgets['id']; ?>?=<?= $widgets['name']; ?>">
                <div class="box">

                    <div class="box2">
                        <div class="imagess"><img src="<?php echo BASE_URL . 'assets/images/products/' . $widgets['images'][0]['url']; ?>" /></div>
                        <div class="product_names"><?php echo  $widgets['name']; ?></div>
                        <?php if ($widgets['price'] > 0) : ?>
                            <div class="product_price_from"><?php echo 'R$' . number_format($widgets['price'], 2, ',', '.'); ?></div>
                        <?php endif; ?>
                        <div class="product_price">R$ <?php echo number_format($widgets['price_from'], 2, ',', '.'); ?></div>
                        <div class="detalhe"><a href="<?php echo BASE_URL; ?>product/open/<?= $widgets['id']; ?>">mais destalhes</a></div>
                        <div class="compra"><a href=""><img src="<?= BASE_URL . 'assets/images/icons/Carrinho.png' ?>">carrinho</a></div>

                    </div>

                </div>
            </a>
        </div>
    </li>
<?php endforeach; ?>