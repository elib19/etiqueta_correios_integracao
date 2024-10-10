<?php
// Função para desinstalação do plugin
function cewcfm_uninstall() {
    // Ações de desinstalação, como remover tabelas ou opções
    delete_option('cewcfm_correios_user');
    delete_option('cewcfm_correios_card');
    delete_option('cewcfm_correios_api_key');
}
register_uninstall_hook(__FILE__, 'cewcfm_uninstall');
?>
