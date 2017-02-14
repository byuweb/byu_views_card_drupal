<?php
/**
 * @file
 * Views-specific implementations and functions.
 */

/**
 * Implements hook_views_plugins().
 */
function views_byu_card_views_plugins() {
  return array(
    'style' => array(
      'byu_card' => array(
        'title' => t('BYU Card'),
        'help' => t('Display content in a BYU Card.'),
        'handler' => 'views_byu_card_plugin_style_byu_card',
        'theme' => 'views_view_byu_card',
        'uses row plugin' => TRUE,
        'uses row class' => FALSE,
        'uses options' => TRUE,
        'uses grouping' => TRUE,
        'type' => 'normal',
      ),
    ),
  );
}
