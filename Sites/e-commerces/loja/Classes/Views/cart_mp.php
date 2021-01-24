  <link rel="stylesheet" href="<?= BASE_URL . 'assets/css/obrigado.css' ?>">

  <div class="container">
      <div class="Cart">
          <h1>Finalizar Pagamento</h1>
      </div>
      <div class="informaçoes pessoais">

          <div class="dadosP">
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
              <input required type="text" name="cep" placeholder="Cep">
              <strong>RUA:</strong>
              <input required type="text" name="rua" placeholder="Rua">
              <strong>Numero:</strong>
              <input required type="text" name="numero" placeholder="Numero">
              <strong>Complemento:</strong>
              <input required type="text" name="complemento" placeholder="Complemento">
              <strong>Bairro:</strong>
              <input required type="text" name="bairro" placeholder="Bairro">
              <strong>Cidade:</strong>
              <input required type="text" name="cidade" placeholder="Cidade">
              <strong>Estado:</strong>
              <input required type="text" name="estado" placeholder="Estado">
          </div>

          <input type="submit" value="Efetuar Compra" class="btn efetuarCompra" />
      </div>
  </div>