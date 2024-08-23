<?php 

class Controller {

    private $customerReport;

    public function __construct(private $gateway, private $url, private $customerId, private $sortInvoicesBy, private $invoicesOrder, private $sortPaymentsBy, private $paymentsOrder, private $iFilters){
        
        $this->customerReport = new CustomerReport($this->gateway);
        
        if($this->url == '/'){
            $this->index(); 
        }
        
        else if(isset($_GET['customerId']) && ctype_alnum($_GET['customerId'])){
            $this->customer();
        } else {
            $this->index(); 
        }
    }
    
    
    public function index()
    {
        $customers = $this->customerReport->getCustomers();
        require_once 'templates/index.php';
    }
    
    public function customer(){
        
        
        $customer = $this->customerReport->getCustomer($this->customerId);
        
        $invoices = $this->customerReport->getInvoices($this->customerId, $this->sortInvoicesBy, $this->invoicesOrder, $this->iFilters);
        
        $payments = $this->customerReport->getPayments($this->customerId, $this->sortPaymentsBy, $this->paymentsOrder);
        
        require_once 'templates/customer.php';
    }

}


