<?php

/**
 * @file
 * Contains the list style plugin.
 */

/**
 * Style plugin to render each item in a slideshow of an ordered or unordered list.
 *
 * @ingroup views_style_plugins
 */
class byu_views_feature_card_plugin_style_byu_feature_card extends views_plugin_style_list {

  /**
   * Set default options
   */
  function option_definition() {
    $options = parent::option_definition();
    $options['class'] = array('default' => '');
    $options['wrapper_class'] = array('default' => 'item-list');
    $options['feature_title'] = array('default' => '');
    $options['title_color'] = array('default' => '');
    $options['feature_top'] = array('default' => '');
    $options['feature_left'] = array('default' => '');
    $options['feature_right'] = array('default' => '');
    $options['feature_center'] = array('default' => '');
//    $options['main_field'] = array('default' => '');
//    $options['parent_field'] = array('default' => '');

    return $options;
  }

  /**
   * Render the given style.
   */
  function options_form(&$form, &$form_state) {
    parent::options_form($form, $form_state);

    $fields = array('' => t('<None>'));

    foreach ($this->display->handler->get_handlers('field') as $field => $handler) {
      if ($label = $handler->label()) {
        $fields[$field] = $label;
      }
      else {
        $fields[$field] = $handler->ui_name();
      }
    }

    $events = array('click' => t('On Click'), 'mouseover' => t('On Mouseover'));

    $form['type']['#description'] = t('Whether to use an ordered or unordered list for the retrieved items. Most use cases will prefer Unordered.');

    // Unused by the Views Feature Card module at this time.
    unset($form['wrapper_class']);
    unset($form['class']);

    $form['columns'] = array(
      '#type' => 'select',
      '#title' => t('Number of tiles in each row'),
      '#required' => TRUE,
      '#default_value' => $this->options['columns'],
      '#options' => array(
          2 => t('2'),
          3 => t('3'),
          4 => t('4'),
      ),
    );

    $form['alignment'] = array(
      '#type' => 'select',
      '#title' => t('Tile Alignment'),
      '#required' => TRUE,
      '#default_value' => $this->options['alignment'],
      '#options' => array(
          "center" => t('Center'),
          "left" => t('Left'),
      ),
    );

    $form['feature_title'] = array(
      '#type' => 'select',
      '#title' => t('Title'),
      '#options' => $fields,
      '#default_value' => $this->options['feature_title'],
      '#description' => t('Select the field for the card\'s title.'),
      '#required' => TRUE,
    );

    $form['title_color'] = array(
      '#type' => 'select',
      '#title' => t('Title Color'),
      '#options' => $fields,
      '#default_value' => $this->options['title_color'],
      '#description' => t("Select the field that contains the title's color in the format of 'navy-title' 'royal-blue-title' 'dark-gray-title' etc. You can see the full list listed in the component's README file: https://github.com/byuweb/byu-feature-card/blob/master/README.md."),
      '#required' => FALSE,
    );

    $form['feature_top'] = array(
      '#type' => 'select',
      '#title' => t('Top Feature Region'),
      '#options' => $fields,
      '#default_value' => $this->options['feature_top'],
      '#description' => t('Select the field for the card\'s feature top region.'),
      '#required' => TRUE,
      '#multiple' => TRUE,
    );

    $form['feature_left'] = array(
      '#type' => 'select',
      '#title' => t('Left Feature Region'),
      '#options' => $fields,
      '#default_value' => $this->options['feature_left'],
      '#description' => t('Select the field for the card\'s feature left region.'),
      '#required' => TRUE,
      '#multiple' => TRUE,
    );

    $form['feature_right'] = array(
      '#type' => 'select',
      '#title' => t('Right Feature Region'),
      '#options' => $fields,
      '#default_value' => $this->options['feature_right'],
      '#description' => t('Select the field for the card\'s feature right region.'),
      '#required' => TRUE,
      '#multiple' => TRUE,
    );

    $form['feature_center'] = array(
      '#type' => 'select',
      '#title' => t('Center Feature Region'),
      '#options' => $fields,
      '#default_value' => $this->options['feature_center'],
      '#description' => t('Select the field for the card\'s center region.'),
      '#required' => TRUE,
      '#multiple' => TRUE,
    );

//      $form['main_field'] = array(
//          '#type' => 'select',
//          '#title' => t('Main field'),
//          '#options' => $fields,
//          '#default_value' => $this->options['main_field'],
//          '#description' => t('Select the field with the unique identifier for each record.'),
//          '#required' => TRUE,
//      );
//
//      $form['parent_field'] = array(
//          '#type' => 'select',
//          '#title' => t('Parent field'),
//          '#options' => $fields,
//          '#default_value' => $this->options['parent_field'],
//          '#description' => t('Select the field that contains the unique identifier of the record\'s parent.'),
//      );
  }
}
