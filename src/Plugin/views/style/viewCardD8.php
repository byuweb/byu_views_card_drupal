<?php

// @file contains the BYU card style plugin.

//Style plugin to render each item in a BYU card.

namespace BYU\viewCardD8\Plugin\views\style;

use Drupal\Core\Form\FormStateInterface;
use Drupal\views\Plugin\views\style\StylePluginBase;

class viewCardD8 extends StylePluginBase {
	//set default options.
	function defineOptions() {
		$options = parent::defineOptions();
		$options['columns'] = array('default' => '3');
		return $options;
	}
	
	//render the given style
	
	function buildOptionsForm(&$form, &$form_state) {
		parent::buildOptionsForm($form, $form_state);
		//Flatten options to deal with the various hierarchy changes.
		$options = viewCardD8_get_options($this->options);
		
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
		
		$form ['border_radius'] = array(
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