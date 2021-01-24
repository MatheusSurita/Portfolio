<link rel="stylesheet" href="<?= BASE_URL; ?>/assets/css/cart.css">


<div class="container">
    <div class="Cart">
        <h1>Carrinho De Compras</h1>

        <table width="100%">
            <tr>
                <th width="150" fixed>Imagem dos Produtos</th>
                <th width="80" fixed>Nome</th>
                <th width="60" fixed>Qtd.</th>
                <th width="50" fixed>Preço</th>
                <th width="40" fixed></th>
            </tr>
            <?php
            $subtotal = 0;
            ?>
            <?php foreach ($list as $item) : ?>
                <?php
                $subtotal += (floatval($item['price']) * intval($item['qt']));
                ?>
                <tr>
                    <td><img src="<?php echo BASE_URL; ?>assets/images/products/<?php echo $item['image'] ?>"></td>
                    <td><?php echo $item['name']; ?></td>
                    <td><a href="<?php echo BASE_URL; ?>cart/removeQt/<?php echo $item['id']; ?>">-</a> <?php echo $item['qt']; ?> <a href="<?php echo BASE_URL; ?>cart/addQt/<?php echo $item['id']; ?>">+</a></td>
                   
                    <td>R$ <?php echo number_format($item['price'], 2, ',', '.'); ?></td>
                    
                    <td><a class="lixeira" href="<?php echo BASE_URL; ?>cart/del/<?php echo $item['id']; ?> "><i class=" fas fa-trash-alt"></i></a></td>
                </tr>
            <?php endforeach; ?>
            <tr class="subtotal">
                <th colspan="3" align="right">Sub-total:</th>
                <th>R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></th>
            </tr>


            <tr class="subtotal">
                <th colspan="3" align="right">Frete:</th>
                <th>
                    <?php if (isset($shipping['price'])) : ?>
                        R$ <?php echo $shipping['price']; ?> (<?php echo $shipping['date']; ?> dia<?php echo ($shipping['date'] == '1') ? '' : 's'; ?>)
                    <?php else : ?>
                        R$ <?php echo '00,00'; ?>
                    <?php endif; ?>
                </th>
            </tr>
            <tr class="subtotal">
                <th colspan="3" align="right">total:</th>
                
                    <th>R$ <?php
                     if(!empty($shipping['price'])) {
                      $frete = floatval(str_replace(',', '.', $shipping['price']));
                                             
                     }else{
                         $frete = 0;
                    }

                            $total = $subtotal + $frete;
                            echo number_format($total, 2, ',', '.'); ?></th>
               </th>
                

            </tr>
        </table>
        <?php if (isset($shipping['price'])): ?>
            <div></div>
            <form action="<?php echo BASE_URL; ?>cart/payment_redirect" class="finalizar" method="POST">
                <select name="payment_type">
                    <option value="checkout_tranparente">PagSeguro</option>
                    <option value="mp">Mercado Pago</option>
                </select>
                <input type="submit" value="Finalizar Pagamento">
            </form>
        <?php endif; ?>
        <form method="POST">
            <input type="number" name="cep" placeholder="Coloque Seu Cep">
            <input type="submit" value="Calcular Frete">
        </form>
    </div>

</div>