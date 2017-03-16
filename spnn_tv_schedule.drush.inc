<?php

/**
 * Implements hook_drush_command().
 */
function spnn_tv_schedule_drush_command() {
  $items['cma-delete-all'] = array(
    'callback' => 'spnn_tv_schedule_airing_delete_all',
    'description' => 'Deletes all airing data including fields. Only use this for debugging.',
    'aliases' => array('cma-d'),
  );
  return $items;
}

/**
 * Callback function.
 */
function spnn_tv_schedule_airing_delete_all() {
  $query = new EntityFieldQuery;
  $query->entityCondition('entity_type', 'airing');
  $result = $query->execute();

  if (isset($result['airing'])) {
    $airing_ids = array_keys($result['airing']);
    cm_airing_delete_multiple($airing_ids);

    drush_print('All airings and related field data deleted! Really hope you intended to do this. :/');
  }
}
