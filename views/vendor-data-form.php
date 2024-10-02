<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>

<div class="wrap">
    <h2>Dados do Remetente</h2>
    <form method="post">
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Nome:</th>
                <td><input type="text" id="remnom" name="remnom" required class="regular-text"></td>
            </tr>
            <tr valign="top">
                <th scope="row">Endereço:</th>
                <td><input type="text" id="remend" name="remend" required class="regular-text"></td>
            </tr>
            <tr valign="top">
                <th scope="row">Número:</th>
                <td><input type="text" id="remnum" name="remnum" required class="regular-text"></td>
            </tr>
            <tr valign="top">
                <th scope="row">Complemento:</th>
                <td><input type="text" id="remcom" name="remcom" class="regular-text"></td>
            </tr>
            <tr valign="top">
                <th scope="row">Bairro:</th>
                <td><input type="text" id="rembai" name="rembai" required class="regular-text"></td>
            </tr>
            <tr valign="top">
                <th scope="row">Cidade:</th>
                <td><input type="text" id="remcid" name="remcid" required class="regular-text"></td>
            </tr>
            <tr valign="top">
                <th scope="row">Estado:</th>
                <td><input type="text" id="remest" name="remest" required class="regular-text"></td>
            </tr>
            <tr valign="top">
                <th scope="row">CEP:</th>
                <td><input type="text" id="remcep" name="remcep" required class="regular-text"></td>
            </tr>
            <tr valign="top">
                <th scope="row">CPF/CNPJ:</th>
                <td><input type="text" id="remcpf" name="remcpf" class="regular-text"></td>
            </tr>
        </table>
        
        <?php submit_button( 'Salvar Dados' ); // Botão de salvar ?>
    </form>
</div>
