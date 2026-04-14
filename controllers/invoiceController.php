<?php
include_once('../connection/bd.php');

class invoiceManager{
    private $pdo;
    private $invoice_id;
    
    

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->invoice_id = (isset($_POST['id'])) ? $_POST['id'] : "";

    }
    public function handleRequest(){
        // 1. we get the deleteId
        if(isset($_GET['invoiceID'])){
            $this->getInvoice($_GET['invoiceID']);
            
            // we redirect to a new address (inventory) but inside we have a new query status....
            header("Location: invoice.php?status=calculated");
            exit; 
        }

        
    }

    public function getInvoice($invoice_id){return $this->invoiceDetails($invoice_id);}
    private function invoiceDetails($invoice_id){
        $getSQL = "SELECT s.*, i.name as product_name, i.category, i.price, i.image 
                    FROM sales s
                    JOIN inventory i ON s.inventory_id = i.id
                    WHERE s.id  = :invoice_id
                    ORDER BY s.sale_date DESC";
        $getSQL = $this->pdo->prepare($getSQL);
        $getSQL->bindParam(':invoice_id', $invoice_id);
        $getSQL->execute();

    }

    
}


$invoiceManager = new invoiceManager($pdo);
$invoice = $invoiceManager->handleRequest();

