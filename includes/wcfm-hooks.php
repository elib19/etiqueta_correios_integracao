<?php
// Adiciona uma ação ao WCFM para permitir a geração de etiquetas
add_action('wcfm_orders_after_order_details', 'cewcfm_add_label_button', 10, 2);

function cewcfm_add_label_button($order_id, $order) {
    // Botão para gerar etiqueta
    echo '<button class="button button-primary" id="generate_label" data-order-id="' . esc_attr($order_id) . '">Gerar Etiqueta</button>';
}

// Enfileira scripts e estilos
add_action('admin_enqueue_scripts', 'cewcfm_enqueue_scripts');
function cewcfm_enqueue_scripts() {
    wp_enqueue_script('cewcfm-script', plugins_url('/assets/js/cewcfm.js', __FILE__), array('jquery'), null, true);
}
?>
