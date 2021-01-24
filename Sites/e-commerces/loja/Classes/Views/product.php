  <link rel="stylesheet" href="<?= BASE_URL . 'assets/css/product.css' ?>">
  <script src="<?= BASE_URL . 'assets/js/lightslider.js' ?>"></script>
  <script src="<?= BASE_URL . 'assets/js/scipt22.js' ?>"></script>



  <body class="Body">
  	<div class="Produto">
  		<div class="container">
  			<?php if (isset($viewData['category_filter'])) : ?>
  				<?php foreach ($viewData['category_filter'] as $cf) : ?>
  					<h2><a href="<?php echo BASE_URL; ?>page/enter/<?php echo $cf['id']; ?>?=<?php echo $cf['name']; ?>"> => <?php echo $cf['name']; ?> => <?php echo $product_info['name']; ?> </a></h2>
  				<?php endforeach; ?>
  			<?php endif; ?>
  			<div class="infoP">
  				<h2><?php echo $product_info['name']; ?></h2>
  				<div class="Marca">
  					<h2>Plataforma: <span><?= $product_info['brends_name'] ?></span>
  						<h2>
  				</div>
  				<h1><?php if ($product_info['price_from'] != 0) {
							echo 'R$ ' . number_format($product_info['price_from'], 2, ',', '.');
						} ?></h1>
  				<?php if ($product_info['price'] > 0) : ?>
  					<p>R$ <?php echo number_format($product_info['price'], 2, ',', '.'); ?></p>
  				<?php endif; ?>
  				<div></div>

  				<form method="POST" class="addtocartform" action="<?php echo BASE_URL; ?>cart/add">
  					<button data-action="decrease">-</button>
  					<input type="hidden" name="id_product" value="<?php echo $product_info['id'] ?>" />
  					<input type="hidden" name="qtP" value="1" />
  					<input type="text" name="qt" value="1" class="addqt" disabled />
  					<button data-action="increase">+</button>
  					</br>
  					<select class="select">
  						<option>4x R$45,00 sem juros</option>
  					</select>
  					<div></div>
  					<input type="submit" value="Adicionar no Carrinho">

  				</form>
  			</div>
  			<div class="imageP1"><img src="<?= BASE_URL . 'assets/images/products/' . $products_images[0]['url']; ?>" /></div>
  			<div class="gallery">
  				<?php foreach ($products_images as $img) : ?>
  					<div class="images">
  						<img src="<?= BASE_URL . 'assets/images/products/' . $img['url']; ?>">
  					</div>
  				<?php endforeach; ?>
  			</div>

  			<div class="Descricao">
  				<h5>Descriçao do Jogo</h5>
  				<p><?php echo $product_info['description']; ?></p>
  			</div>

  		</div>
  		<!--container-->
  	</div>


  	<div class="chamada-escolher">
  		<div class="container">
  			<h2>Produtos Relacionados</h2>
  		</div>
  		<!--container-->
  	</div>
  	<!--chamada-->


  	<div class="lista-items">
  		<div class="container">
  			<ul id="autoWdth" class="cs-hiduen">
  				<?php foreach ($list as $product_item) : ?>
  					<?php $this->loadView('products', $product_item); ?>
  				<?php endforeach; ?>
  			</ul>

  			<div class="clear"></div>


  		</div>
  		<!--container-->
  	</div>
  	<!--lista-items-->
  </body>