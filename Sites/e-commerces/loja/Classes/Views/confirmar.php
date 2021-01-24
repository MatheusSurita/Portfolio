<?php
$h = $_GET['h'];
if (!empty($h)) {
$pdo->query("UPDATE usuarios SET status = '1' WHERE SHA1(id) = '$h'");
echo "<h2>cadastro confirmado com sucesso</h2>";

header('Location: http://localhost/loja/Login');
}

?>