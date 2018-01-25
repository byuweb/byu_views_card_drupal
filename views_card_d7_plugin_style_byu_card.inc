<?php
/**
 * @file
 * Contains the BYU card style plugin.
 */

/**
 * Style plugin to render each item in a BYU card.
 *
 * @ingroup views_style_plugins
 */
class views_card_d7_plugin_style_byu_card extends views_plugin_style {
    /**
     * Set default options.
     */
    function option_definition() {
        $options = parent::option_definition();
        $options['columns'] = array('default' => '3');

        return $options;
    }

    /**
     * Render the given style.
     */
    function options_form(&$form, &$form_state) {
        parent::options_form($form, $form_state);

        // Flatten options to deal with the various hierarchy changes.
        $options = views_card_d7_get_options($this->options);

        $form['columns'] = array(
            '#type' => 'select',
            '#title' => t('Number of tiles in each row'),
            '#default_value' => $options['columns'],
            '#required' => TRUE,
            '#options' => array(
                2 => t('2'),
                3 => t('3'),
                4 => t('4'),
            ),
        );

        $form['alignment'] = array(
            '#type' => 'select',
            '#title' => t('Tile Alignment'),
            '#default_value' => $options['alignment'],
            '#required' => TRUE,
            '#options' => array(
                "center" => t('Center'),
                "left" => t('Left'),
            ),
        );

        $form['border'] = array(
            '#type' => 'select',
            '#title' => t('Border'),
            '#default_value' => $options['border'],
            '#required' => TRUE,
            '#options' => array(
                "none" => t('None'),
                "gray" => t('Gray'),
                "navy" => t('Navy'),
            ),
        );

        $form['border_radius'] = array(
            '#type' => 'select',
            '#title' => t('Border Radius'),
            '#default_value' => $options['border_radius'],
            '#required' => TRUE,
            '#options' => array(
                "none" => t('None'),
                "small" => t('Small'),
                "large" => t('Large'),
            ),
        );
    }
}
