<?php


include_once('../connection/bd.php');

class invoiceManager{
    private $pdo;
    private $invoice_id;
    private $igv = 0.18;
    private $subtotal;
    private $discount;
    private $total;
    
    

    public function __construct($pdo) {
        $this->pdo = $pdo;

       

    }
    //getters 
    public function getIGV($subtotal){
        return 0.18 * $subtotal;
    }
    
    public function getSubtotal($price, $quantity){
        return ($price * $quantity);
    }

    public function getDiscount($payment_type, $subtotal){
        if($payment_type == "Tarjeta OH"){
            return $subtotal * 0.05;
        }
        return 0;
    }

    public function getTotal($subtotal, $igv, $discount){
        return $subtotal + $igv - $discount;
    }
    public function handleRequest(){
        // Cambiamos a 'invoiceID' para que sea igual a tu URL
        if(isset($_GET['invoiceID'])){
            return $this->getInvoice($_GET['invoiceID']);
        }
        return null;
    }
 
    public function getInvoice($invoice_id){
        // Si no hay ID, devolvemos un array vacío para evitar errores
        if(!$invoice_id) return [];
        return $this->invoiceDetails($invoice_id);
    }
    private function invoiceDetails($invoice_id){
        $sql = "SELECT s.*, i.name as product_name, i.category, i.price, i.image 
                FROM sales s
                JOIN inventory i ON s.inventory_id = i.id
                WHERE s.id  = :invoice_id
                ORDER BY s.sale_date DESC";
        $getSQL = $this->pdo->prepare($sql);
        $getSQL->bindParam(':invoice_id', $invoice_id);
        $getSQL->execute();
        $invoiceDetails = $getSQL->fetchAll(PDO::FETCH_ASSOC);

        return  $invoiceDetails;

    }

    
}


$invoiceManager = new invoiceManager($pdo);

// Usamos 'invoiceID' que es lo que llega por la URL
$invoiceId = isset($_GET['invoiceID']) ? $_GET['invoiceID'] : null;
$getInvoice = $invoiceManager->getInvoice($invoiceId);

// Inicializamos variables en 0
$invoice = null;
$subtotal = 0;
$discount = 0;
$igv = 0;
$total = 0;

if (!empty($getInvoice)) {
    //
    $invoice = $getInvoice[0];
    
    $subtotal = $invoiceManager->getSubtotal($invoice['price'], $invoice['quantity']);
    $discount = $invoiceManager->getDiscount($invoice['payment_type'], $subtotal);
    $igv = number_format((($subtotal - $discount) * 0.18),2);
    $total = number_format((($subtotal - $discount) * 1.18),2);
}

?>
