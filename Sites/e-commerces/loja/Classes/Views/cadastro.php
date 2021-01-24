<link rel="stylesheet" href="<?= BASE_URL; ?>/assets/css/cadastro.css">
<link rel="stylesheet" href="<?= BASE_URL . 'assets/css/users.css' ?>">
<script src="<?= BASE_URL; ?>/assets/js/jquery.js"></script>
<script src="<?= BASE_URL; ?>/assets/js/fundo.js"></script>
<title>Torre dos Games</title>


<div class="layout">
    <div class="Cadastro">
        <div class="container">
            <h2>Cadastrar Login</h2>
            <?php if (!empty($erro)) : ?>
                <div class="center erro"><?= $erro ?></div>
                <div class="clear"></div>
            <?php endif; ?>
            <form method="POST">
                <div class="dadosP">
                    <input type="text" name="nome" placeholder="Nome completo" required>
                    <input type="text" name="cpf" placeholder="CPF" required>
                    <input type="text" name="telefone" placeholder="Telefone" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="senha" placeholder="Senha" required>
                    <input type="password" name="senha" placeholder="Senha" required>
                    <button>Cadastrar-se</button>
                </div>
            </form>
        </div>
    </div>