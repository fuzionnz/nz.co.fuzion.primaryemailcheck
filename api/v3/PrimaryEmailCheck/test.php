<?php

civicrm_initialize();
$query  = 'SELECT count(*) as num from (';
$query .= ' SELECT contact_id FROM civicrm_email';
$query .= ' WHERE contact_id IS NOT NULL ';
$query .= ' GROUP BY contact_id ';
$query .= ' HAVING SUM(is_primary) = 0';
$query .= ') as no_primary_email';

       
$result = CRM_Core_DAO::executeQuery($query);

$result->fetch();


var_dump($result);
