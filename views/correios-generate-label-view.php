<h2>Gerar Etiqueta Correios</h2>
<form method="post">
    <input type="text" name="destinatario" placeholder="Nome do Destinatário" required />
    <input type="text" name="endereco" placeholder="Endereço" required />
    <!-- Adicionar mais campos conforme necessário -->

    <input type="submit" value="Gerar Etiqueta" />
</form>

<?php
if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $data = array(
        'destinatario' => sanitize_text_field( $_POST['destinatario'] ),
        'endereco'     => sanitize_text_field( $_POST['endereco'] ),
    );

    $label = Correios_Helper::generate_label( $data );

    if( $label ) {
        echo '<p>Etiqueta gerada com sucesso!</p>';
        // Exibir a etiqueta
    } else {
        echo '<p>Erro ao gerar a etiqueta.</p>';
    }
}
?>
