<?php

class CustomerReport
{
    
    public function __construct(private $gateway){ }
    
    public function getCustomers(){
        $query = new Query($this->gateway, 'SELECT * FROM customers', []);
        return $query->results;
    }
    
    public function getCustomer($customerId){
        $query = new Query($this->gateway, 'SELECT * FROM customers WHERE id=:id', ['id' => $customerId]);
        return $query->results[0];
    }
    
    public function getSortInvoices($sortInvoicesBy, $invoicesOrder ){
        switch ($sortInvoicesBy) {
            case 'number':
                $sort = " ORDER BY $sortInvoicesBy";
                break;
            case 'date':
                $sort = " ORDER BY $sortInvoicesBy";
                break;
            case 'due_date':
                $sort = " ORDER BY $sortInvoicesBy";
                break;
            case 'gross_total':
                $sort = " ORDER BY $sortInvoicesBy";
                break;
            case 'status':
                $sort = " ORDER BY p.invoice_id";
                break;
            default:
                $sort = '';
        }
        return $sort . (($invoicesOrder == 'ASC' || $invoicesOrder == 'DESC') ? " $invoicesOrder " : '');
    }
    
    public function getFiltersInvoice($iFilter){
        $whereClause = '';
        if($iFilter['iNumber']) $whereClause .= " AND i.number LIKE '%" . $iFilter['iNumber'] . "%' ";
        if($iFilter['iDate']) $whereClause .= " AND i.date LIKE '%" . $iFilter['iDate'] . "%' ";
        if($iFilter['iDueDate']) $whereClause .= " AND i.due_date LIKE '%" . $iFilter['iDueDate'] . "%' ";
        if($iFilter['iGrossTotal']) $whereClause .= " AND i.gross_total LIKE '%" . $iFilter['iGrossTotal'] . "%' ";
        
        return $whereClause;
        
    }
    
    public function getInvoices($customerId, $sortInvoicesBy, $invoicesOrder, $iFilters){
        $sort = $this->getSortInvoices($sortInvoicesBy, $invoicesOrder);
        
        $whereClause = $this->getFiltersInvoice($iFilters);
        
        $query = new Query($this->gateway, "SELECT i.*, p.invoice_id FROM invoices AS i LEFT JOIN payments AS p ON i.id=p.invoice_id WHERE i.customer_id=:id $whereClause $sort", ['id' => $customerId]);
        return $query->results;
    }
    
    public function getSortPayments($sortPaymentsBy, $paymentsOrder ){
        switch ($sortPaymentsBy) {
            case 'payment_title':
                $sort = " ORDER BY $sortPaymentsBy";
                break;
            case 'amount':
                $sort = " ORDER BY $sortPaymentsBy";
                break;
            case 'payment_date':
                $sort = " ORDER BY $sortPaymentsBy";
                break;
            case 'bank_number_for_payment':
                $sort = " ORDER BY $sortPaymentsBy";
                break;
            default:
                $sort = '';
        }
        return $sort . (($paymentsOrder == 'ASC' || $paymentsOrder == 'DESC') ? " $paymentsOrder " : '');
    }
    
    public function getPayments($customerId, $sortPaymentsBy, $paymentsOrder){
    
        $sort = $this->getSortPayments($sortPaymentsBy, $paymentsOrder);
        
        $query = new Query($this->gateway, "SELECT * FROM payments WHERE customer_id=:id $sort", ['id' => $customerId]);
        
        return $query->results;
    }
    
}
