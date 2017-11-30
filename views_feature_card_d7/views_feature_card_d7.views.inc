<?php

/**
 * Implementation of hook_views_plugins()
 */
function views_feature_card_d7_views_plugins() {
  $plugin = array(
    'style' => array(
      'byu_feature_card' => array(
        'title' => t('BYU Feature Card'),
        'help' => t('Display the results as a BYU Feature Card'),
        'handler' => 'views_feature_card_d7_plugin_style_byu_feature_card',
        'theme' => 'views_view_byu_feature_card', // the name of the tpl file that it expects, with dashes instead
        'uses options' => TRUE,
        'uses row plugin' => TRUE,
        'uses fields' => TRUE,
        'uses grouping' => FALSE,
        'type' => 'normal',
        'parent' => 'list',
        //'path' => drupal_get_path('module', 'views_feature_card_d7'),
      ),
    ),
  );

  return $plugin;
}