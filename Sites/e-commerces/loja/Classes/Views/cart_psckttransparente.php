  <link rel="stylesheet" href="<?= BASE_URL . 'assets/css/obrigado.css' ?>">

  <div class="container">
      <div class="Cart">
          <h1>Finalizar Pagamento</h1>
      </div>


      <?php if (!empty($error)) : ?>
          <?php echo $error ?>
      <?php endif; ?>
      <div class="informaçoes pessoais">

          <div class="dadosP">
              <h2>Dados Pessoais</h2>

              <?php if (!empty($_SESSION['TOWER'])) : ?>
                    <?php foreach ($user as $users) : ?>
                      <strong>Nome Completo:</strong>
                      <input required type="text" value="<?= $users['nome']; ?>" name="nome" placeholder="Nome Completo">
                      <strong>CPF:</strong>
                      <input required type="text" value="<?= $users['cpf']; ?>" name="cpf" placeholder="CPF">
                      <strong>Telefone:</strong>
                      <input required type="text" value="<?= $users['telefone']; ?>" name="telefone" placeholder="Telefone">
                      <strong>E-mail:</strong>
                      <input required type="email" name="email" placeholder="E-mail do PagSeguro">
                      <strong>Senha:</strong>
                      <input required type="password" name="senha" placeholder="Senha do PagSeguro">
                    <?php endforeach; ?>
              <?php else : ?>
                  <strong>Nome Completo:</strong>
                  <input required type="text" value="" name="nome" placeholder="Nome Completo">
                  <strong>CPF:</strong>
                  <input required type="text" value="" name="cpf" placeholder="CPF">
                  <strong>Telefone:</strong>
                  <input required type="text" value="" name="telefone" placeholder="Telefone">
                  <strong>E-mail:</strong>
                  <input required type="email" name="email" placeholder="E-mail do PagSeguro">
                  <strong>Senha:</strong>
                  <input required type="password" name="senha" placeholder="Senha do PagSeguro">
              <?php endif; ?>


          </div>
          <div class="dadosE">
              <h2>Informações de Endereço</h2>
              <strong>CEP:</strong>
              <input type="text" name="cep" placeholder="Cep">
              <strong>RUA:</strong>
              <input type="text" name="rua" placeholder="Rua">
              <strong>Numero:</strong>
              <input type="text" name="numero" placeholder="Numero">
              <strong>Complemento:</strong>
              <input required type="text" name="complemento" placeholder="Complemento">
              <strong>Bairro:</strong>
              <input required type="text" name="bairro" placeholder="Bairro">
              <strong>Cidade:</strong>
              <input required type="text" name="cidade" placeholder="Cidade">
              <strong>Estado:</strong>
              <input required type="text" name="estado" placeholder="Estado">
          </div>
          <div class="dadosC">
              <h2>Informações de Pagamento</h2>
              <strong>Titular do Cartao:</strong>
              <input type="text" name="titular_cartao" placeholder="Nome Completo">
              <strong>CPF do Titular:</strong>
              <input type="text" name="cpf_titularcard" placeholder="CPF">
              <strong>Numero do Cartao:</strong>
              <input type="text" name="cartao_numero" placeholder="Numero do Cartao">
              <strong>Codigo de Segurança:</strong>
              <input type="text" name="cartao_cvv" placeholder="CVV">
              <strong>Validade:</strong>
              <select name="cartao_mes">
                  <?php for ($q = 1; $q <= 12; $q++) : ?>
                      <option><?= ($q < 10) ? '0' . $q : $q; ?></option>
                  <?php endfor; ?>
              </select>
              <select name="cartao_ano">
                  <?php $ano = date('Y'); ?>
                  <?php for ($q = $ano; $q <= ($ano + 20); $q++) : ?>
                      <option><?= $q; ?></option>
                  <?php endfor; ?>
              </select>
              <h1>Parcelas:</h1>
              <select name="parc"></select>
              <input type="hidden" name="total" value="<?= $total; ?>" />

          </div>
          <button class="btn efetuarCompra">Efetuar Compra</button>
      </div>
  </div>
  <script src="<?= BASE_URL . 'assets/js/jquery.js' ?>"></script>
  <script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
  <script src="<?= BASE_URL . 'assets/js/psckttransparente.js' ?>"></script>
  <script>
      PagSeguroDirectPayment.setSessionId("<?= $sessionCode ?>");
  </script>