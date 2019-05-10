<?php

/**
 * PrimaryEmailCheck.Check API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see http://wiki.civicrm.org/confluence/display/CRMDOC/API+Architecture+Standards
 */
function _civicrm_api3_primary_email_check_Check_spec(&$spec) {
}

/**
 * PrimaryEmailCheck.Check API
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_primary_email_check_Check($params) {
    $inner_query = ' SELECT contact_id FROM civicrm_email';
    $inner_query .= ' WHERE contact_id IS NOT NULL ';
    $inner_query .= ' GROUP BY contact_id ';
    $inner_query .= ' HAVING SUM(is_primary) = 0';
    
    $query  = 'SELECT count(*) as num from (';
    $query .= $inner_query;
    $query .= ') as no_primary_email';
    
    $result = CRM_Core_DAO::executeQuery($query);
    $result->fetch();
    $contacts = [];
    if ($result->num > 0) {
        $result = CRM_Core_DAO::executeQuery($inner_query);
        while ($result->fetch()) {
            $contacts[] = $result->contact_id;
        }
    }           
    return civicrm_api3_create_success($contacts, $params, 'PrimaryEmailCheck', 'check');
}
