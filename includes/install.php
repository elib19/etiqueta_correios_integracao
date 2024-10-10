<?php
// Função para instalação do plugin
function cewcfm_install() {
    // Ações de instalação, como criar tabelas no banco de dados, se necessário
    // Exemplo: criar uma tabela se precisar armazenar dados
    global $wpdb;
    $table_name = $wpdb->prefix . 'cewcfm_labels';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        order_id bigint(20) NOT NULL,
        label_data text NOT NULL,
        created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}
?>
