<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Wrapper para a geração de etiquetas
function virtuaria_gerar_etiqueta($destinatario, $endereco, $cidade, $estado, $cep, $usuario, $cartao_postagem, $api_key) {
    if (class_exists('Correios_Helper') && method_exists('Correios_Helper', 'gerarEtiqueta')) {
        return Correios_Helper::gerarEtiqueta($destinatario, $endereco, $cidade, $estado, $cep, $usuario, $cartao_postagem, $api_key);
    }
    return new WP_Error('erro_gerar_etiqueta', __('Erro: Classe ou método de geração de etiqueta não encontrados.', 'virtuaria-correios'));
}

// Wrapper para rastreamento de pedidos (se necessário)
function virtuaria_rastrear_pedido($codigo_rastreamento) {
    if (class_exists('Correios_Helper') && method_exists('Correios_Helper', 'rastrearPedido')) {
        return Correios_Helper::rastrearPedido($codigo_rastreamento);
    }
    return new WP_Error('erro_rastreamento', __('Erro: Classe ou método de rastreamento não encontrados.', 'virtuaria-correios'));
}
?>
