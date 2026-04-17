<?php
include('../connection/bd.php');
class stats{
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    

    public function getTotalSales(){
        
        return $this->totalSales(); 
    }

    public function getTotalDiscount(){
        return $this->totalDiscount();
    }
    
    public function getLowStockAlert(){
        return $this-> lowStockAlert();
    }

    public function getTopSales() {
        return $this->topSales();
    }

    private function salesList(){
        try {
            $sql = "SELECT s.*, i.name as product_name, i.category, i.price, i.image, i.stock 
                    FROM sales s
                    JOIN inventory i ON s.inventory_id = i.id
                    ORDER BY s.sale_date DESC";
            return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            return [];
        }
    }

    private function totalSales(){

            $salesList = $this->salesList();
            $totalSales = 0;
            foreach($salesList as $sale){
                $totalSales += $sale['price']; 
            }
            return $totalSales;
        
    }

    private function totalDiscount(){
        $salesList = $this->salesList();
            $totalDiscount = 0;
            foreach($salesList as $sale){
                if($sale['payment_type']=="Tarjeta OH"){
                    $totalDiscount += $sale['price'] * 0.05;
                }

            }
            return $totalDiscount;

    }

    private function lowStockAlert(){
        $lowStockSQL = "SELECT * FROM inventory WHERE stock < 10";
        return $this->pdo->query($lowStockSQL)->fetchAll(PDO::FETCH_ASSOC);


    }

    private function topSales(){
        $sql = "SELECT 
                i.id as product_id, 
                i.name as product_name, 
                i.category, 
                i.price, 
                i.image, 
                i.stock, 
                SUM(s.quantity) as total_units_sold
            FROM sales s
            JOIN inventory i ON s.inventory_id = i.id
            GROUP BY i.id, i.name, i.category, i.price, i.image, i.stock
            ORDER BY total_units_sold DESC";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    }

}


// We initialize the controller and handle the request
$statsManager = new stats($pdo);
$totalSales = $statsManager->getTotalSales();
$totalDiscount = $statsManager->getTotalDiscount();
$lowStock = $statsManager->getLowStockAlert();
$topSales = $statsManager->getTopSales();