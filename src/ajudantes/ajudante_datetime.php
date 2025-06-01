<?php
    function transformar_data($data) {
        $nova_data = explode('/', $data);
        return  $nova_data[2] . '-' . $nova_data[1] . '-' . $nova_data[0];
    }
?>
