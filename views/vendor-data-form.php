<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$vendor_id = get_current_user_id();
$vendor_data = correios_get_vendor_data( $vendor_id );
?>

<form method="post" action="">
    <h3>Dados do Remetente</h3>
    <label for="remnom">Nome:</label>
    <input type="text" id="remnom" name="remnom" value="<?php echo esc_attr( $vendor_data->remnom ?? '' ); ?>" required><br>

    <label for="remend">Endereço:</label>
    <input type="text" id="remend" name="remend" value="<?php echo esc_attr( $vendor_data->remend ?? '' ); ?>" required><br>

    <label for="remnum">Número:</label>
    <input type="text" id="remnum" name="remnum" value="<?php echo esc_attr( $vendor_data->remnum ?? '' ); ?>" required><br>

    <label for="remcom">Complemento:</label>
    <input type="text" id="remcom" name="remcom" value="<?php echo esc_attr( $vendor_data->remcom ?? '' ); ?>"><br>

    <label for="rembai">Bairro:</label>
    <input type="text" id="rembai" name="rembai" value="<?php echo esc_attr( $vendor_data->rembai ?? '' ); ?>" required><br>

    <label for="remcid">Cidade:</label>
    <input type="text" id="remcid" name="remcid" value="<?php echo esc_attr( $vendor_data->remcid ?? '' ); ?>" required><br>

    <label for="remest">Estado:</label>
    <input type="text" id="remest" name="remest" value="<?php echo esc_attr( $vendor_data->remest ?? '' ); ?>" required><br>

    <label for="remcep">CEP:</label>
    <input type="text" id="remcep" name="remcep" value="<?php echo esc_attr( $vendor_data->remcep ?? '' ); ?>" required><br>

    <label for="remcpf">CPF:</label>
    <input type="text" id="remcpf" name="remcpf" value="<?php echo esc_attr( $vendor_data->remcpf ?? '' ); ?>" required><br>

    <input type="submit" value="Salvar Dados">
</form>
