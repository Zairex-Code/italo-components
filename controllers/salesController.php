<?php
include_once('../connection/bd.php');

class SalesManager {
    private $pdo;
    private $inventory_id;
    private $customer_name;
    private $quantity;
    private $payment_type;
    private $igv = 0.18;
    private $subtotal;
    private $discount;
    private $total;
    private $saveAction;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->inventory_id = (isset($_POST['id'])) ? $_POST['id'] : "";
        $this->customer_name = (isset($_POST['customer'])) ? $_POST['customer'] : "";
        $this->quantity = (isset($_POST['quantity'])) ? $_POST['quantity'] : 0;
        $this->payment_type = (isset($_POST['payment_type'])) ? $_POST['payment_type'] : "Efectivo";
        $this->saveAction = (isset($_POST['saveAction'])) ? $_POST['saveAction'] : NULL;
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

    public function handleRequest() {
        if ($this->saveAction !== NULL) {
            $this->createSale();
        }
    }
    public function getPaymentTypesList(){
        return $this->paymentTypeList();
    }

    private function createSale(){
        try {
            $addSql = $this->pdo->prepare("INSERT INTO sales (inventory_id, customer_name, quantity, payment_type) VALUES (:inventory_id, :customer_name, :quantity, :payment_type)");
            $addSql->bindParam(':inventory_id', $this->inventory_id);
            $addSql->bindParam(':customer_name', $this->customer_name);
            $addSql->bindParam(':quantity', $this->quantity);
            $addSql->bindParam(':payment_type', $this->payment_type);
            $addSql->execute();
            
            $this->updateStock($this->inventory_id, $this->quantity);

            header("Location: sales.php?status=saved");
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    private function updateStock($inventory_id, $quantity){
        $updateSQL = $this->pdo->prepare("UPDATE inventory SET stock = stock - :quantity WHERE id = :inventory_id");
        $updateSQL->bindParam(":quantity", $quantity);
        $updateSQL->bindParam(":inventory_id", $inventory_id);
        $updateSQL->execute();
    }
    
    private function paymentTypeList(){
        return ["Efectivo", "Yape", "Transferencia", "Tarjeta OH"];
    }

    public function getSalesList() {
        try {
            $sql = "SELECT s.*, i.name as product_name, i.category, i.price, i.image 
                    FROM sales s
                    JOIN inventory i ON s.inventory_id = i.id
                    ORDER BY s.sale_date DESC";
            return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }
}

// We initialize the controller and handle the request
$salesManager = new SalesManager($pdo);
$salesManager->handleRequest();
$salesList = $salesManager->getSalesList();
$paymentTypesList = $salesManager->getPaymentTypesList();

// Initialize variables for the form
$id = $name = $category = $customer = $price = $igv = $total = "";
$payment_type = "Efectivo";
$quantity = 1;
$stock = 0;
?>
