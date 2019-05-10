<?php

require_once 'primaryemailcheck.civix.php';

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function primaryemailcheck_civicrm_config(&$config) {
  _primaryemailcheck_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @param array $files
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function primaryemailcheck_civicrm_xmlMenu(&$files) {
  _primaryemailcheck_civix_civicrm_xmlMenu($files);
}


function primaryemailcheck_civicrm_check(&$messages) {
    $result = civicrm_api3('PrimaryEmailCheck','check',[
        'sequential' => 1,
    ]);
    if (!empty($result['count'])) {
        $msg = '<p>' . ts('%1 contact/s have an email but no primary email address set.',
                          [
                              1 => $result['count'],
                          ]) . '</p><ul>';
        $count = 0;
        foreach ($result['values'] as $contact_id) {
            $msg .= '<li>' . ts('%1', [1 => $contact_id]) . '</li>';
            $count += 1;
            if ($count > 10) {
                $msg .= '<li>...</li>';
                break;
            }
        }

        $msg .= '</ul>';
        
        $messages[] = new CRM_Utils_Check_Message(
            'primaryemailcheck',
            $msg,
            ts('Primary Email Set'),
            'error'
        );            
    }
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function primaryemailcheck_civicrm_install() {
  _primaryemailcheck_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function primaryemailcheck_civicrm_uninstall() {
  _primaryemailcheck_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function primaryemailcheck_civicrm_enable() {
  _primaryemailcheck_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function primaryemailcheck_civicrm_disable() {
  _primaryemailcheck_civix_civicrm_disable();
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
function primaryemailcheck_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _primaryemailcheck_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function primaryemailcheck_civicrm_managed(&$entities) {
  _primaryemailcheck_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * @param array $caseTypes
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function primaryemailcheck_civicrm_caseTypes(&$caseTypes) {
  _primaryemailcheck_civix_civicrm_caseTypes($caseTypes);
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
function primaryemailcheck_civicrm_angularModules(&$angularModules) {
_primaryemailcheck_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function primaryemailcheck_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _primaryemailcheck_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Functions below this ship commented out. Uncomment as required.
 *

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function primaryemailcheck_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
function primaryemailcheck_civicrm_navigationMenu(&$menu) {
  _primaryemailcheck_civix_insert_navigation_menu($menu, NULL, array(
    'label' => ts('The Page', array('domain' => 'nz.co.fuzion.primaryemailcheck')),
    'name' => 'the_page',
    'url' => 'civicrm/the-page',
    'permission' => 'access CiviReport,access CiviContribute',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _primaryemailcheck_civix_navigationMenu($menu);
} // */
