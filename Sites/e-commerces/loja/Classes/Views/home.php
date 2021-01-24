<section class="banner">
	<div class="slideShowarea">
		<a href="">
			<div style="background-image: url('assets/images/slides/1.png');" class="slide"></div>
		</a>
		<!--slide-->
		<a href="">
			<div style="background-image: url('assets/images/slides/2.png');" class="slide"></div>
		</a>
		<!--slide-->
		<a href="">
			<div style="background-image: url('assets/images/slides/3.png');" class="slide"></div>
		</a>
		<!--slide-->
		<a href="">
			<div style="background-image: url('assets/images/slides/4.png');" class="slide"></div>
		</a>
		<!--slide-->
		<a href="">
			<div style="background-image: url('assets/images/slides/5.png');" class="slide"></div>
		</a>
		<!--banner-single-->
	</div>
	<div class="bullets"></div>
	<!--bullets-->

	<script src="assets/js/scriptslide.js"></script>
</section>

<div class="chamada-escolher">
	<div class="container">
		<h2>Lancamentos</h2>
	</div>
	<!--container-->
</div>
<!--chamada-->


<div class="lista-items">
	<div class="container">
		<ul id="autoWidth" class="cs-hidden">
			<?php $this->loadView('widgets', array('list' => $viewData['widget_new'])); ?>
		</ul>
		<div class="clear"></div>


	</div>
	<!--container-->
</div>
<!--lista-items-->

<div class="chamada-escolher S2">
	<div class="container">
		<h2>Mais Vendidos</h2>
	</div>
	<!--container-->
</div>
<!--chamada-->


<div class="lista-items">
	<div class="container">
		<ul id="autoUidth" class="cs-hiduen">
			<?php $this->loadView('widgetss', array('list' => $viewData['widget_bestseller'])); ?>
		</ul>
			<div class="clear"></div>



	</div>
	<!--container-->
</div>
<!--lista-items-->