<li class="item-a">
    <div class="master-box">
        <a href="<?php echo BASE_URL; ?>product/open/<?= $id; ?>?=<?= $name?>">

            <div class="box">

                <div class="box2">

                    <div class="product_tags">
                        <?php if ($new_products == '1') : ?>
                            <div class="product_tag New">Novo</div>
                        <?php endif; ?>
                        <?php if ($sale == '1') : ?>
                            <div class="product_tag Sales">Promoçao</div>
                        <?php endif; ?>
                        <?php if ($bestseller == '1') : ?>
                            <div class="product_tag BestSeller">Mais Vendido</div>
                        <?php endif; ?>

                    </div>
                    <div class="imagess"><img src="<?php echo BASE_URL . 'assets/images/products/' . $images[0]['url']; ?>" /></div>
                    <div class="product_names"><?php echo $name; ?></div>
                    <?php if ($price > 0) : ?>
                        <div class="product_price_from">R$ <?php echo number_format($price, 2, ',', '.'); ?></div>
                    <?php endif; ?>


                    <div class="product_price"><?php if ($price_from != 0) {
                                                    echo 'R$' . number_format($price_from, 2, ',', '.');
                                                } ?></div>
                    <div class="detalhe"><a href="<?php echo BASE_URL; ?>product/open/<?= $id; ?>">mais destalhes</a></div>
                    <div class="compra"><a href=""><img src="<?= BASE_URL . 'assets/images/icons/Carrinho.png' ?>">carrinho</a></div>

                </div>

            </div>
        </a>
    </div>
</li>