<?php

require_once 'CRM/Core/Page.php';

class CRM_Yescustomisations_Page_ProjectStatus extends CRM_Core_Page {
  function run() {
    $goal = 16250000;
    // Example: Set the page-title dynamically; alternatively, declare a static title in xml/Menu/*.xml
    CRM_Utils_System::setTitle(ts('Project Status'));

    // Example: Assign a variable for use in a template
    $this->assign('currentTime', date('Y-m-d H:i:s'));
    $pledgeTotals = CRM_Core_DAO::executeQuery("
      SELECT SQL_CALC_FOUND_ROWS
 sum(pledge.amount) as pledge_amount_sum,
 COALESCE(sum(pledge.amount), 0) - COALESCE(sum(pledge_payment_civireport.actual_amount), 0) as balance_amount ,
 sum(pledge_payment_civireport.actual_amount) as actual_amount_sum

FROM civicrm_pledge pledge
  LEFT JOIN (SELECT pledge_id, sum(IF(status_id =1, actual_amount, 0)) as actual_amount

FROM civicrm_pledge_payment

GROUP BY pledge_id ) as pledge_payment_civireport ON pledge_payment_civireport.pledge_id = pledge.id");
    $pledgeTotals->fetch();
    $this->assign('total_pledges', $pledgeTotals->pledge_amount_sum);
    $this->assign('pledge_balance', $pledgeTotals->balance_amount);
    $this->assign('pledge_paid', $pledgeTotals->actual_amount_sum);

    $totalReceived = CRM_Core_DAO::singleValueQuery("SELECT sum(total_amount) as total
FROM civicrm_contribution c
LEFT JOIN civicrm_entity_financial_account a ON a.entity_id = c.financial_type_id AND a.entity_table = 'civicrm_financial_type'
AND a.account_relationship = 1
LEFT JOIN civicrm_financial_account ac ON ac.id = a.financial_account_id
WHERE contribution_status_id = 1
AND is_test = 0
AND ac.account_type_code = 'INC'
#GROUP BY financial_type_id
");

    $this->assign('total_received', $totalReceived);
    $raised = $pledgeTotals->balance_amount + $totalReceived;
    $this->assign('raised', $raised);
    $this->assign('goal', $goal);
    $this->assign('to_raise', $goal - $raised);
    $this->assign('percent', (round($raised / $goal, 2)) * 100 . "");
    parent::run();
  }
}
