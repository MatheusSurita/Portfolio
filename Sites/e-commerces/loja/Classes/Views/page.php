<link rel="stylesheet" href="<?= BASE_URL; ?>/assets/css/page.css">





<div class="chamada-escolher">
    <div class="container">
        <?php if (isset($viewData['category_filter'])) : ?>
            <?php foreach ($viewData['category_filter'] as $cf) : ?>
                <h2><a href="<?php echo BASE_URL; ?>page/enter/<?php echo $cf['id']; ?>?=<?php echo $cf['name']; ?>"> => <?php echo $cf['name']; ?> </a></h2>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <!--container-->
</div>
<!--chamada-->


<div class="container">
    <?php foreach ($list as $product_item) : ?>
        <?php $product_item['id_gamecat'] ?>
    <?php endforeach; ?>
    <?php if (isset($product_item['id_gamecat'])) : ?>
        <div class="filtermaster">
            <div class="filter">
                <form method="GET">
                    <input type="hidden" name="s" value="<?php echo $searchTerm ?>">
                    <input type="hidden" name="category" value="<?php echo $category ?>">
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
                <form method="GET">
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
                </form>
            </div>
        </div>
    <?php else : ?>
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
            </form>
        <?php endif; ?>





        </div>



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
                <?php if ($q > 1) : ?>

                    <div class="paginationItem <?php echo ($currentPage == $q) ? 'pag_active' : '' ?>"><a href="<?php echo BASE_URL . 'page/enter/' . $categorys_id ?>?<?php
                                                                                                                                                                        $pag_array = $_GET;
                                                                                                                                                                        $pag_array['p'] = $q;
                                                                                                                                                                        echo http_build_query($pag_array);
                                                                                                                                                                        ?>"><?= $q; ?></a></div>
                <?php endif; ?>
            <?php endfor; ?>

        </div>
</div>