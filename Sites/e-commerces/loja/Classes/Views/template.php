<!DOCTYPE html>
<html lang="pt-br">



<head>
  <meta charset="UTF-8">
  <meta name="Keywords" content="">
  <meta name="description" content="">
  <meta name="author" content="SuritaCoporation">
  <link rel="stylesheet" href="<?= BASE_URL; ?>assets/css/all.css ">
  <link rel="stylesheet" href="<?= BASE_URL . 'assets/css/style.css' ?>">
  <link rel="stylesheet" href="<?= BASE_URL . 'assets/css/footer.css' ?>">
  <link rel="stylesheet" href="<?= BASE_URL . 'assets/css/lightslider.css' ?>" />
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="<?= BASE_URL . 'assets/js/jquery.js' ?>"></script>
  <script src="<?= BASE_URL . 'assets/js/lightslider.js' ?>"></script>
  <script src="<?= BASE_URL . 'assets/js/fundo.js' ?>"></script>
  <script src="<?= BASE_URL . 'assets/js/script.js' ?>"></script>

  <title><?= TITLE ?></title>
</head>

<body>
  <base base="<?php echo BASE_URL; ?>" />

  <div class="layout">

    <header>
      <div class="topoHeader">


        <?php if (!isset($_SESSION['TOWER'])) : ?>

          <p><a href="<?php echo  BASE_URL; ?>cadastro"><i class="fas fa-check-square"></i> Cadastrar-se</a></p>
          <p>Ou</p>
          <p><a href="<?php echo  BASE_URL; ?>login"><i class="fas fa-user"></i> Acessar Sua Conta</a></p>
        <?php else : ?>
          <?php foreach ($viewData['user'] as $user) : ?>

            <h1><img src=""><?= $user['nome'] ?>
              <div class="settings">
                <ul>
                  <li><a href="<?php echo  BASE_URL; ?>login/edit/<?= $user['id'] ?>"><i class="fas fa-user-edit"></i> Editar Perfil</a></li>
                  <li><a href="<?php echo  BASE_URL; ?>login/sair"><i class="fas fa-power-off"></i> Sair</a></li>
                </ul>
              </div>
            </h1>
          <?php endforeach; ?>

        <?php endif; ?>
        <div class="left">
          <p><a href="javascript:;" id="abrir" onclick="Abrirmodal()"><i class="fas fa-comments"></i> Entre em contato</a></p>
          <p><a href="tel:(11) 94054-2042"><i class="fab fa-whatsapp"></i> (11) 94054-2042</a></p>
          <p><a href="mailto:Contato@torredosgames.com"><i class="far fa-envelope"></i> Contato@TorredosGames.com</a></p>
        </div>

      </div>

      <div class="bg-modal" id="modal">
        <div class="modal body">
          <?php $this->loadView('contato'); ?>
        </div>
      </div>


      <!---header-topo-->
      <div class="Headerlogo">


        <div class="logo">
          <a href="<?php echo  BASE_URL; ?>"><img src="<?php echo BASE_URL . 'assets/images/icons/logo.png' ?>" border=0 /></a>
        </div>

        <div class="carrinho"><span><a href="<?php echo BASE_URL; ?>cart"><img src="<?php echo BASE_URL . 'assets/images/icons/Carrinho.png' ?>"></a></span></div>



        <div class="Pesquisar">
          <form action="<?php echo  BASE_URL; ?>busca" method="GET">
            <input type="text" name="s" value="<?php echo (!empty($viewData['searchTerm'])) ? $viewData['searchTerm'] : '' ?>" placeholder="buscar...">
            <select name="category">
              <option></option>
              <?php foreach ($viewData['categories'] as $cat) : ?>
                <option value="<?php echo $cat['id'] ?>"><?php echo $cat['name'] ?></option>
              <?php endforeach; ?>
            </select>
            <button><img src="<?php echo BASE_URL . 'assets/images/icons/loupe.png' ?>"></button>
          </form>
        </div>
        <!----pesquisa-->

      </div>
      <!--header-logo-->
      <div class="Header">

        <div class="container">


          <nav class="desktop">

            <ul>
              <form method="GET">
                <li><a href="<?php echo BASE_URL; ?>"><img src="<?php echo BASE_URL . 'assets/images/icons/home.png' ?>" width="150" height="51"></a></li>
                <?php foreach ($viewData['categories'] as $cat) : ?>
                  <li><a href="<?php echo BASE_URL . 'page/enter/' . $cat['id'] ?>?=<?php echo $cat['name'] ?>"><img src="<?php echo BASE_URL . 'assets/images/icons/' . $cat['img'] ?>"></a>
                    <div class="submenu">
                      <?php
                      if (count($cat['subs']) > 0) {
                        $this->loadView('menu_subcategory', array(
                          'subs' => $cat['subs']
                        ));
                      }
                      ?>
                    </div>
                  </li>
                <?php endforeach; ?>
              </form>
            </ul>

            <div class="linha"></div>
          </nav>
          <nav class="mobile">

            <ul>
              <form method="GET">
                <li><a href="<?php echo BASE_URL; ?> ">Home</a></li>
                <?php foreach ($viewData['categories'] as $cat) : ?>
                  <li><a href="<?php echo BASE_URL . 'page/enter/' . $cat['id'] ?>?=<?php echo $cat['name'] ?>"><?= $cat['name'] ?></a>
                    <div class="submenu">
                      <?php
                      if (count($cat['subs']) > 0) {
                        $this->loadView('menu_subcategory', array(
                          'subs' => $cat['subs']
                        ));
                      }
                      ?>
                    </div>
                  </li>
                <?php endforeach; ?>
              </form>
            </ul>

            <div class="linha"></div>
          </nav>

        </div>

        <div class="clear"></div>
      </div>

    </header>

    <?= $this->loadViewInTemplate($viewName, $viewData); ?>



  </div>



  <footer class="footer2">

    <div class="container2">
      <div class="infoempresa">
        <h1>Torre dos Games</h1>
        <p>
          Bem-vindo a Torre dos Games nos somos uma empresa brasileira dedicada a vender Jogos Digitais, Acessorios e Consoles. Nos estamos no mercado para mostrar que qualidade tambem pode ser barata!
        </p>
      </div>
      <div class="navegacao">
        <h1>Navegaçao</h1>
        <ul>

          <li><a href="<?php echo BASE_URL; ?>">Home</a></li>
          <?php foreach ($viewData['categories'] as $cat) : ?>
            <li><a href="<?php echo BASE_URL . 'page/enter/' . $cat['id'] ?>?=<?php echo $cat['name'] ?>"><?php echo $cat['name'] ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="infoPo">
        <h1>informações</h1>
        <ul>
          <li><a href="<?php echo BASE_URL; ?>Como-Funciona">Como funciona ?</a></li>
          <li><a href="<?php echo BASE_URL; ?>Politicas">Politicas da Empresa</a></li>
          <li><a href="<?php echo BASE_URL; ?>Suporte">Entre em Contato</a></li>
        </ul>
      </div>




      <div class="contato">
        <h1>Entre em Contato</h1>
        <ul>
          <li><a href="tel:(11) 94054-2042"><i class="fab fa-whatsapp"></i> (11) 94054-2042</a></li>
          <li><a href="mail:Contato@torredosgames.com"><i class="far fa-envelope"></i> Contato@TorredosGames.com</a></li>
          <li><a href="https://www.google.com.br/maps/place/R.+Embirussu,+221+-+Vila+Beatriz,+S%C3%A3o+Paulo+-+SP,+03644-000/@-23.5251572,-46.5354998,17z/data=!3m1!4b1!4m5!3m4!1s0x94ce5e38fd1cc5cf:0x476d9650c0f4df53!8m2!3d-23.5251621!4d-46.5333111"><i class="fas fa-map-marker-alt"></i> Nosso Endereço</a></li>
        </ul>
      </div>


    </div>
    <div class="clear"></div>
    </div>
    <!--container-->
  </footer>
  <footer class="footer3">
    <div class="pagamento">
      <div class="pag">
        <h1>Formas de Pagamentos</h1>
        <img src="<?= BASE_URL ?>assets/images/payments/visa.png">
        <img src="<?= BASE_URL ?>assets/images/payments/amex.png">
        <img src="<?= BASE_URL ?>assets/images/payments/elo.png">
        <img src="<?= BASE_URL ?>assets/images/payments/mastercard.png">
        <img src="<?= BASE_URL ?>assets/images/payments/pagseguro.png">
        <div class="boleto">
          <img src="<?= BASE_URL ?>assets/images/payments/boleto.png">
          <img src="<?= BASE_URL ?>assets/images/payments/mercadopago.png">

        </div>
      </div>
      <div class="pag1">
        <h1>Selo de Segurança</h1>
        <img src="<?= BASE_URL ?>assets/images/payments/selo.png">

      </div>
  </footer>
  <footer>

    <div class="container">
      <p> &copy; 2020 - Tower Games - Todos os direitos reservados</p>
      <div class="clear"></div>
    </div>
    <!--container-->
  </footer>

</body>

</html>