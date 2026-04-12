<?php
include_once('../connection/bd.php');

            

class inventoryManager{
    private $pdo;
    private $id;
    
    private $name;
    private $category;
    private $price;
    private $stock;
    private $saveAction;
    


    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->id = (isset($_POST['id'])) ? $_POST['id'] : "";
        
        $this->name = (isset($_POST['name'])) ? $_POST['name'] : "";
        $this->category = (isset($_POST['category'])) ? $_POST['category'] : "";
        $this->price = (isset($_POST['price'])) ? $_POST['price'] : "";
        $this->stock = (isset($_POST['stock'])) ? $_POST['stock'] : "";
        $this->saveAction = (isset($_POST['saveAction'])) ? $_POST['saveAction'] : NULL;
    }

    // Getters 
    public function getId(){return $this-> id;}
    public function getName(){return $this->name;}
    public function getCategory(){return $this->category;}
    public function getPrice(){return $this->price;}
    public function getStock(){return $this->stock;}


    public function handleRequest(){
        // 1. we get the deleteId
        if(isset($_GET['deleteId'])){
            $this->deleteProduct($_GET['deleteId']);
            
            // we redirect to a new address (inventory) but inside we have a new query status....
            header("Location: inventory.php?status=deleted");
            exit; 
        }

        // 2. Insertar o Actualizar desde formulario POST
        if(isset($this->saveAction)){
            if(empty($this->id)){
                $this->createProduct();
            }else{
                $this->updateProduct();
            }
        }
    }

    private function createProduct(){
            $addSQL =$this->pdo->prepare("INSERT INTO inventory (name, category, price, stock) VALUES(:name, :category, :price, :stock)");
            $addSQL->bindParam(':name', $this->name);
            $addSQL->bindParam(':category', $this->category);
            $addSQL->bindParam(':price', $this->price);
            $addSQL->bindParam(':stock', $this->stock);
            $addSQL->execute();

            $this->clearForm();
            //echo "product added successfully...";
    }

    private function updateProduct(){
            $editSQL = $this->pdo->prepare("UPDATE inventory SET name = :name, category = :category, price = :price, stock = :stock WHERE id = :id");
            $editSQL->bindParam(':id', $this->id);
            $editSQL->bindParam(':name', $this->name);
            $editSQL->bindParam(':category', $this->category);
            $editSQL->bindParam(':price', $this->price);
            $editSQL->bindParam(':stock', $this->stock);
            $editSQL->execute();

            $this->clearForm();
            //echo "product modified successfully...";
    }

    private function deleteProduct($id){
        $deleteSQL = $this->pdo->prepare("DELETE FROM inventory WHERE id = :id");
        $deleteSQL->bindParam(':id', $id);
        $deleteSQL->execute();
    }
    
    private function clearForm(){
        $this->id="";
        $this->name = "";
        $this->category = "";
        $this->price = "";
        $this->stock = "";

    }
    
    public function getCategoriesList(){
       $categoriesList = $this->CategoriesList();
       return $categoriesList;
    }
    
    public function getAllProducts(){
        $productListSQL = $this->pdo->prepare('SELECT * FROM inventory WHERE 1');
        $productListSQL->execute();
        $productListSQL = $productListSQL->fetchAll(PDO::FETCH_ASSOC);
        return $productListSQL;
    }
    private function CategoriesList(){
        return [
            "Electrónica", "Computación", "Hogar y Cocina", "Herramientas", "Deportes", 
            "Libros", "Juguetes", "Ropa", "Calzado", "Belleza", 
            "Salud", "Automotriz", "Muebles", "Iluminación", "Jardinería", 
            "Papelería", "Mascotas", "Videojuegos", "Música", "Fotografía"
        ];
    }

    
};

$controller = new inventoryManager($pdo);

$controller->handleRequest();


$productList = $controller->getAllProducts();
$categoryList = $controller->getCategoriesList();


$id = $controller->getId();
$name = $controller->getName();
$category = $controller->getCategory();
$price = $controller->getPrice();
$stock = $controller->getStock();

