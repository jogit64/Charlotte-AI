<?php
if (!defined('ABSPATH')) exit; // Sécurité

class CharlotteAI_Widget extends \Elementor\Widget_Base
{

    // Nom interne du widget
    public function get_name()
    {
        return 'charlotte_ai_widget';
    }

    // Titre visible dans Elementor
    public function get_title()
    {
        return __('Charlotte AI Chatbot', 'charlotte-ai');
    }

    // Icône affichée dans Elementor
    public function get_icon()
    {
        return 'fab fa-rocketchat'; // Icône Rocket.Chat de Font Awesome
    }


    // Catégorie dans Elementor
    public function get_categories()
    {
        return ['general'];
    }

    // Définir les contrôles
    protected function _register_controls()
    {

        // Section "Contenu"
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Contenu', 'charlotte-ai'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Contrôle : Texte d'introduction
        $this->add_control(
            'intro_text',
            [
                'label' => __('Texte d’introduction', 'charlotte-ai'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Parlez à Charlotte, votre assistante immobilière !', 'charlotte-ai'),
                'placeholder' => __('Entrez le texte ici...', 'charlotte-ai'),
            ]
        );

        // Contrôle : Couleur de fond
        $this->add_control(
            'background_color',
            [
                'label' => __('Couleur de fond', 'charlotte-ai'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#f7f7f7',
            ]
        );

        $this->end_controls_section();
    }

    // Rendu du widget dans la page
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        echo '<div class="charlotte-chat-widget" style="background-color: ' . esc_attr($settings['background_color']) . ';">';
        echo '<p>' . esc_html($settings['intro_text']) . '</p>';
        echo '<div id="charlotte-react-root">Chargement du chatbot...</div>';
        echo '</div>';
    }



    // Rendu dans l’éditeur Elementor
    protected function _content_template()
    {
?>
<div class="charlotte-chat-widget" style="background-color: {{ settings.background_color }};">
    <p>{{ settings.intro_text }}</p>
    <p><?php _e('Le chatbot Charlotte apparaîtra ici.', 'charlotte-ai'); ?></p>
</div>
<?php
    }
}