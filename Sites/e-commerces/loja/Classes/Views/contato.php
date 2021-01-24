<span class="close" onclick="Fecharmodal()"><i class="fas fa-times-circle"></i></span>
<div class="cent">

    <form method="POST" action="<?= BASE_URL; ?>contato/enviarEmail">
        <?php if (!empty($erro)) : ?>
            <div class="center erro"><?= $erro ?></div>
            <div class="clear"></div>
        <?php endif; ?>
        <label class="Modalname">Nome:</label></br>
        <input  required type="text" name="nome" placeholder="Nome...">
        <div></div>
        <label class="Modalname">Email:</label></br>
        <input  required type="text" name="email" placeholder="E-mail..">
        <div></div>
        <label class="Modalname">Mensagem:</label></br>
        <textarea  required placeholder="Sua mensagem..." name="mensagem"></textarea>
        <div></div>
        <input type="submit" name="acao" value="Enviar">
    </form>


</div>
<!--center-->