<?php
$senha_pura = 'somebody'; // a senha que você quer testar
$hash_no_banco = '$2y$12$xpOjlsnZ/y7yOpavX9JQdOCXjxLVobDACOWPL/2YZg0x/KMDTk2w2'; // copie o hash do campo senha do banco

if (password_verify($senha_pura, $hash_no_banco)) {
    echo "Senha correta!";
} else {
    echo "Senha incorreta!";
}
?>