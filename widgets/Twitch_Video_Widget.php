<?php

class Twitch_Video_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'twitch_video_widget',
            __('Twitch Video Widget', 'twitch_video_domain'),
            array( 'description' => __( 'Widget d\'intégration de vidéos Twitch', 'twitch_video_domain' ), )
        );
    }

    //Création du widget avec les informations récupérées
    public function widget( $args, $instance ) {

        echo $args['before_widget'];
        if(!empty($instance['title'])){
            $title = apply_filters('widget_title', $instance['title']);
            echo $args['before_title'] . $title . $args['after_title'];
        }

        $video = isset($instance['video']) ? $instance['video'] : '';
        $width = isset($instance['width']) ? $instance['width'] : '';
        $height = isset($instance['height']) ? $instance['height'] : '';
        $parent = isset($instance['parent']) ? $instance['parent'] : '';
        $fullscreen = ($instance['fullscreen'] == 'on') ? 'true' : 'false';

        echo '<iframe src="https://player.twitch.tv/?video='.$video.'&parent='. $parent .'" height="'. $height .'" width="'. $width .'" allowfullscreen="'. $fullscreen .'"></iframe>';

        echo $args['after_widget'];
    }

    //Formulaire de personnalisation du widget
    public function form( $instance ) {
        $title = isset($instance[ 'title' ]) ? $instance[ 'title' ] : '';
        $video = isset($instance[ 'video' ]) ? $instance[ 'video' ] : '';
        $width = isset($instance['width']) ? $instance['width'] : '';
        $height = isset($instance['height']) ? $instance['height'] : '';
        $parent = isset($instance['parent']) ? $instance['parent'] : '';
        ?>
        <p>
            <!-- Champ de saisie pour renseigner le titre du widget -->
            <label for="<?= $this->get_field_id('title') ?>">
                <?php esc_attr_e('Titre : ', 'ytstwc_domain'); ?>
            </label>
            <input
                    class="widefat"
                    type="text"
                    name="<?= $this->get_field_name('title') ?>"
                    value="<?= esc_attr($title) ?>"
                    id="<?= $this->get_field_name('title') ?>">
        </p>
        <p>
            <!-- Champ de saisie pour renseigner l'identifiant de la vidéo -->
            <label for="<?= $this->get_field_id('video') ?>">
                <?php esc_attr_e('Identifiant vidéo : ', 'ytstwc_domain'); ?>
            </label>
            <input
                    class="widefat"
                    type="text"
                    name="<?= $this->get_field_name('video') ?>"
                    value="<?= esc_attr($video) ?>"
                    id="<?= $this->get_field_name('video') ?>">
        </p>
        <p>
            <!-- Champ de saisie pour renseigner le nom de votre site -->
            <label for="<?= $this->get_field_id('parent') ?>">
                <?php esc_attr_e('Nom de votre site : ', 'twitch_video_domain'); ?>
            </label>
            <input
                    class="widefat"
                    type="text"
                    name="<?= $this->get_field_name('parent') ?>"
                    value="<?= esc_attr($parent) ?>"
                    id="<?= $this->get_field_name('parent') ?>">
        </p>
        <p>
            <!-- Champ de saisie pour renseigner la largeur du widget -->
            <label for="<?= $this->get_field_id('width') ?>">Largeur</label>
            <input
                    class="widefat"
                    type="text"
                    name="<?= $this->get_field_name('width') ?>"
                    value="<?= esc_attr($width) ?>"
                    id="<?= $this->get_field_name('width') ?>">
        </p>
        <p>
            <!-- Champ de saisie pour renseigner la hauteur du widget -->
            <label for="<?= $this->get_field_id('height') ?>">Hauteur</label>
            <input
                    class="widefat"
                    type="text"
                    name="<?= $this->get_field_name('height') ?>"
                    value="<?= esc_attr($height) ?>"
                    id="<?= $this->get_field_name('height') ?>">
        </p>
        <p>
            <!-- Checkbox pour autoriser ou non le plein écran -->
            <label for="<?php echo $this->get_field_id( 'fullscreen' ); ?>">
                <?php esc_attr_e( 'fullscreen :', 'twitch_video_domain' ); ?>
            </label>
            <input class="checkbox"
                   id="<?php echo $this->get_field_id( 'fullscreen' ); ?>"
                   name="<?php echo $this->get_field_name( 'fullscreen' ); ?>"
                   type="checkbox"
                <?php checked( $instance[ 'fullscreen' ], 'on' ); ?> />
        </p>

        <?php
    }

    //Mise à jour des informations avec celles rentrées dans le formulaire
    public function update( $newInstance, $oldInstance ) {
        $instance = array();
        $instance['title'] = (!empty($newInstance['title'])) ? $newInstance['title'] : '';
        $instance['video'] = (!empty($newInstance['video'])) ? $newInstance['video'] : '';
        $instance['parent'] = (!empty($newInstance['parent'])) ? $newInstance['parent'] : '';
        $instance['width'] = (!empty($newInstance['width'])) ? $newInstance['width'] : '';
        $instance['height'] = (!empty($newInstance['height'])) ? $newInstance['height'] : '';
        $instance['fullscreen'] = (!empty($newInstance['fullscreen'])) ? $newInstance['fullscreen'] : '';
        return $instance;
    }

// Class wpb_widget ends here
}