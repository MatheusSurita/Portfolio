<link rel="stylesheet" href="<?= BASE_URL; ?>/assets/css/busca.css">
<link rel="stylesheet" href="<?= BASE_URL; ?>/assets/css/page.css">
<script src="<?= BASE_URL . 'assets/js/jquery.js' ?>"></script>
<script src="<?= BASE_URL . 'assets/js/script.js' ?>"></script>

<div class="container">
    <div class="filtermaster">
        <div class="filter">
            <form method="GET">
                <input type="hidden" name="s" value="<?php echo $viewData['searchTerm'] ?>">
                <input type="hidden" name="category" value="<?php echo $viewData['category'] ?>">
                <div class="filter_box">

                    <div class="filtercontent">
                        <?php foreach ($viewData['filters']['gamecat'] as $bitem) : ?>
                            <div class="filteritem">


                                <input type="checkbox" name="filter[gamecat][]" value="<?php echo $bitem['id'] ?>" <?php echo (isset($viewData['filters_selected']['gamecat']) && in_array($bitem['id'], $viewData['filters_selected']['gamecat'])) ? 'checked="checked"' : ''; ?>id="filter_filtro<?php echo $bitem['id'] ?>">




                                <label for="filter_filtro<?php echo $bitem['id']; ?>"><?php echo $bitem['name']; ?></label>





                            </div>
                        <?php endforeach; ?>

                    </div>

                </div>


        </div>
        <div class="filter1">

            <div class="filter_box1">

                <div class="filtercontent">
                    <div class="filteritem1">
                        <input type="checkbox" name="filter[sale]" value="1" <?php echo (isset($viewData['filters_selected']['sale']) && $viewData['filters_selected']['sale'] == '1') ? 'checked="checked"' : ''; ?> id="filter_sale">
                        <label for="filter_sale">Promoçao</label>

                    </div>
                    <div class="filteritem1">
                        <input type="checkbox" name="filter[bestseller]" value="1" <?php echo (isset($viewData['filters_selected']['bestseller']) && $viewData['filters_selected']['bestseller'] == '1') ? 'checked="checked"' : ''; ?>id="filter_bestseller">
                        <label for="filter_bestseller">Mais Vendidos</label>
                    </div>
                    <div class="filteritem1">
                        <input type="checkbox" name="filter[new_products]" value="1" <?php echo (isset($viewData['filters_selected']['new_products']) && $viewData['filters_selected']['new_products'] == '1') ? 'checked="checked"' : ''; ?> id="filter_new_products">
                        <label for="filter_new_products">Lançamento</label>
                    </div>
                </div>
            </div>
            <form>
        </div>
    </div>
</div>

<div class="chamada-escolher">
    <div class="container">
        <?php if (isset($viewData['category_filter'])) : ?>
            <?php foreach ($viewData['category_filter'] as $cf) : ?>
                <h2><a href="<?php echo BASE_URL; ?>busca/<?php echo $cf['name']; ?>"><?php echo $cf['name']; ?></a></h2>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <!--container-->
</div>
<!--chamada-->

<h1 class="search">Voce esta procurando: <Span><?php echo $searchTerm; ?></Span></h1>
<div class="lista-items">

    <div class="container">
        <?php foreach ($list as $product_item) : ?>
            <?php $this->loadView('product_item', $product_item); ?>
        <?php endforeach; ?>



    </div>
    <!--container-->
</div>
<!--lista-items-->
<div class="PaginationArea">
    <?php for ($q = 1; $q <= $numberOfPages; $q++) : ?>
        <div class="paginationItem <?php echo ($currentPage == $q) ? 'pag_active' : '' ?>"><a href="<?php echo BASE_URL . 'busca/' . $categorys_id ?>?<?php
                                                                                                                                                        $pag_array = $_GET;
                                                                                                                                                        $pag_array['p'] = $q;
                                                                                                                                                        echo http_build_query($pag_array);
                                                                                                                                                        ?>"><?= $q; ?></a></div>
    <?php endfor; ?>
</div>