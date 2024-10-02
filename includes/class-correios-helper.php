<?php
defined('ABSPATH') || exit;

class Correios_Helper {
    public static function generate_label_interface() {
        if (!wcfm_is_vendor()) {
            return; // Apenas vendedores têm acesso
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Captura os dados do formulário
            $destinatario = sanitize_text_field($_POST['destinatario']);
            $endereco = sanitize_text_field($_POST['endereco']);
            $cidade = sanitize_text_field($_POST['cidade']);
            $estado = sanitize_text_field($_POST['estado']);
            $cep = sanitize_text_field($_POST['cep']);
            
            // Chama a função para gerar a etiqueta
            $resultado = self::gerar_etiqueta($destinatario, $endereco, $cidade, $estado, $cep);
            
            // Manipula a resposta
            if ($resultado['success']) {
                echo '<div class="updated"><p>Etiqueta gerada com sucesso! Código: ' . esc_html($resultado['codigo']) . '</p></div>';
            } else {
                echo '<div class="error"><p>Erro ao gerar etiqueta: ' . esc_html($resultado['mensagem']) . '</p></div>';
            }
        }

        include plugin_dir_path(__FILE__) . 'views/correios-generate-label-view.php';
    }

    private static function gerar_etiqueta($destinatario, $endereco, $cidade, $estado, $cep) {
        // Obtém as credenciais do administrador
        $usuario = get_option('correios_api_usuario');
        $cartao = get_option('correios_api_cartao');
        $api_key = get_option('correios_api_key');

        // Prepare os dados para a API
        $dados = array(
            'usuario' => $usuario,
            'cartao' => $cartao,
            'api_key' => $api_key,
            'destinatario' => $destinatario,
            'endereco' => $endereco,
            'cidade' => $cidade,
            'estado' => $estado,
            'cep' => $cep
        );

        // URL da API fictícia dos Correios (substitua pela URL real)
        $url = 'https://api.correios.com.br/gerarEtiqueta';

        // Faz a requisição à API
        $response = wp_remote_post($url, array(
            'method'    => 'POST',
            'body'      => json_encode($dados),
            'headers'   => array(
                'Content-Type' => 'application/json',
            ),
        ));

        // Verifica a resposta da API
        if (is_wp_error($response)) {
            return array(
                'success' => false,
                'mensagem' => $response->get_error_message(),
            );
        }

        $body = json_decode(wp_remote_retrieve_body($response), true);

        // Processa a resposta
        if (isset($body['sucesso']) && $body['sucesso']) {
            return array(
                'success' => true,
                'codigo' => $body['codigo'], // Código da etiqueta gerada
            );
        } else {
            return array(
                'success' => false,
                'mensagem' => $body['mensagem'] ?? 'Erro desconhecido.',
            );
        }
    }
}
