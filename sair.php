<?php
session_start();
unset($_SESSION['id_usuario']);
unset($_SESSION['usuario_cargo']);
// Redireciona o usuário para a página inicial ou de login após o logout
header('Location: index.php'); 
?>
