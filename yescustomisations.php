<?php

require_once 'yescustomisations.civix.php';

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function yescustomisations_civicrm_config(&$config) {
  _yescustomisations_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @param $files array(string)
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function yescustomisations_civicrm_xmlMenu(&$files) {
  _yescustomisations_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function yescustomisations_civicrm_install() {
  _yescustomisations_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function yescustomisations_civicrm_uninstall() {
  _yescustomisations_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function yescustomisations_civicrm_enable() {
  _yescustomisations_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function yescustomisations_civicrm_disable() {
  _yescustomisations_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed
 *   Based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function yescustomisations_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _yescustomisations_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function yescustomisations_civicrm_managed(&$entities) {
  _yescustomisations_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function yescustomisations_civicrm_caseTypes(&$caseTypes) {
  _yescustomisations_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function yescustomisations_civicrm_angularModules(&$angularModules) {
_yescustomisations_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function yescustomisations_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _yescustomisations_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_buildForm().
 */
function yescustomisations_civicrm_buildForm($formName, &$form) {
  if ($formName == 'CRM_Contribute_Form_Contribution_Main') {
    $formID = $form->get('id');
    if ($formID == 3) {
      $form->setDefaults(array('is_recur' => 1));
      $form->setDefaults(array('installments' => 50));
      $form->setDefaults(array('price_24' => 20));
      CRM_Core_Resources::singleton()->addScript('
        cj("#is_recur").hide();
      ');
    }
    elseif ($formID == 1) {
      CRM_Core_Resources::singleton()->addScript("
      cj('[data-amount=0]').hide().next('label').hide();
      cj('input[type=radio]').on('click', function(){
        if (cj(this).data('amount') > 0) {
          cj('#price_2').val('').trigger('keyup');
        }
      });

      cj('#price_2').on('focus', function() {
        cj('[data-amount=0]').click().trigger('click');
      });"
      );
    }

  }
}

/**
 * Functions below this ship commented out. Uncomment as required.
 *

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function yescustomisations_civicrm_preProcess($formName, &$form) {

}

*/
