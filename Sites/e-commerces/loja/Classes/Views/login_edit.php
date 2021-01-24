  <link rel="stylesheet" href="<?= BASE_URL . 'assets/css/users.css' ?>">
  <?php foreach ($viewData['user'] as $user) : ?>

      <form method="POST" action="<?= BASE_URL ?>login/edit_actions">
          <input type="hidden" name="id" value="<?php echo $permission_id ?>">

          <div class="informacoes pessoais">

              <div class="dadosP">
                  <h2>Dados Pessoais</h2>
                  <strong>Nome Completo:</strong>
                  <input required type="text" name="nome" value="<?php echo $user['nome'] ?>" placeholder="Nome Completo">
                  <strong>CPF:</strong>
                  <input required type="text" name="cpf" value="<?php echo $user['cpf'] ?>" placeholder="CPF">
                  <strong>Telefone:</strong>
                  <input required type="text" name="telefone" value="<?php echo $user['telefone'] ?>" placeholder="Telefone">
                  <strong>E-mail:</strong>
                  <input required type="email" name="email" value="<?php echo $user['email'] ?>" placeholder="E-mail">
                  <strong>Senha:</strong>
                  <input required type="password" name="senha" placeholder="Senha nova">
                  <button class="btn efetuarCompra">Salvar</button>
              </div>
          </div>
      </form>
  <?php endforeach; ?>