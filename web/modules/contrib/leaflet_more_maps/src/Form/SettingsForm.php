<?php

/**
 * @file
 * Contains \Drupal\leaflet_more_maps\Form\SettingsForm.
 */

namespace Drupal\leaflet_more_maps\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}.
   */
  public function getFormID() {
    return 'leaflet_more_maps_settings';
  }

  /**
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $map_info =  [];

    _leaflet_more_maps_assemble_default_map_info($map_info);

    $all_layer_keys =  [];
    foreach ($map_info as $map_key => $map) {
      foreach ($map['layers'] as $layer_key => $layer) {
        // Unique.
        $all_layer_keys["$map_key $layer_key"] = "$map_key $layer_key";
      }
    }
    $config = $this->configFactory->get('leaflet_more_maps.settings');
    $custom_map_layers = $config->get('leaflet_more_maps_custom_maps',  []);

    if (empty($custom_map_layers)) {
      for ($i = 1; $i <= LEAFLET_MORE_MAPS_NO_CUSTOM_MAPS; $i++) {
        $custom_map_layers[$i] = [
          'map-key' => '',
          'layer-keys' =>  [],
          'reverse-order' => FALSE,
        ];
      }
    }
    for ($i = 1; $i <= LEAFLET_MORE_MAPS_NO_CUSTOM_MAPS; $i++) {
      $form['map'][$i] = [
        '#type' => 'fieldset',
        '#collapsible' => TRUE,
        '#collapsed' => $i > 1,
        '#title' => $this->t('Custom map #@number layer selection', ['@number' => $i]),
      ];
      $form['map'][$i]['map-key'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Name of custom map #@number in the administrative UI', ['@number' => $i]),
        '#default_value' => $custom_map_layers[$i]['map-key'],
        '#description' => $this->t('Use a blank field to remove this layer configuration from the set of selectable maps.'),
      ];
      $form['map'][$i]['layer-keys'] = [
        '#type' => 'checkboxes',
        '#title' => $this->t('Select one or more layers to be included in this map.'),
        '#options' => $all_layer_keys,
        '#default_value' => $custom_map_layers[$i]['layer-keys'],
        '#description' => $this->t('If you select two or more layers, these will be selectable via radio buttons in the layer switcher on your map.'),
      ];
      $form['map'][$i]['reverse-order'] = [
        '#type' => 'checkbox',
        '#title' => $this->t('Reverse order in layer switcher'),
        '#default_value' => $custom_map_layers[$i]['reverse-order'],
        '#description' => $this->t('The last layer in the switcher will be the default.'),
      ];
      // Organise the $form_state['values'] structure available after submission.
      $form['map'][$i]['map-key']['#parents'] = [
        'map', $i, 'map-key'];
      $form['map'][$i]['layer-keys']['#parents'] = [
        'map', $i, 'layer-keys'];
      $form['map'][$i]['reverse-order']['#parents'] = [
        'map', $i, 'reverse-order'];
    }

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $custom_maps = $form_state->getValue('map');

    // Clear out the unticked boxes before saving the form.
    foreach ($custom_maps as &$custom_map) {
      $custom_map['layer-keys'] = array_filter($custom_map['layer-keys']);
    }

    $this->config('leaflet_more_maps.settings')
      ->set('leaflet_more_maps_custom_maps', $custom_maps)
      ->save();

    parent::submitForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['leaflet_more_maps.settings'];
  }

}
