<?php
include('../connection/bd.php');

class inventoryManager{
    private $id;
    private $name;
    private $category;
    private $price;
    private $stock;
    private $modifyAction = false;


    public function __construct($id,$name,$category,$price,$stock)
    {
        $this->id = $id;        
        $this->name = $name;
        $this->category = $category;
        $this->price = $price;
        $this->stock = $stock;
        
    }

    public function getId(){
        return $this-> id;
    }
    /*
    public function getImage(){
        return $this-> image;
    }
    */
    
    public function getName(){
        return $this->name;
    }
    public function setName($newName){
        return $this->name = $newName;
    }
    public function getCategory(){
        return $this->category;
    }
    public function setCategory($newCategory){
        return $this-> category = $newCategory;
    }
    public function getPrice(){
        return $this->price;
    }
    public function setPrice($newPrice){
        return $this->price = $newPrice;
    }
    public function getStock(){
        return $this->stock;
    }
    public function setStock($newStock){
        return $this->stock = $newStock;
    }
    /*
    public function getModifyAction(){
        return $this-> modifyAction;
    }
    public function toggleModifyAction($modifyAction){
        if($modifyAction){
            return $modifyAction = $this->modifyAction = false; 
        }
        return $modifyAction = $this->modifyAction = true;


    }
    */
    public function saveButton($id, $name, $category, $price, $stock, $modifyAction , $pdo){
        $product = [
            'id'       => $id,
            'name'     => $name,
            'category' => $category,
            'price'    => $price,
            'stock'    => $stock,
            
        ];

        if($modifyAction){
            $editSQL = $pdo->prepare("UPDATE inventory (  name, category price, stock) VALUES( :name, :category,:price, :stock) WHERE id = :id");
            $editSQL-> bindparam(':id', $product['id']);
            $editSQL-> bindparam(':name', $product['name']);
            $editSQL-> bindparam(':category', $product['category']);
            $editSQL-> bindparam(':price', $product['price']);
            $editSQL-> bindparam(':stock', $product['stock']);
            $editSQL->execute();
            echo "product modified successfully...";


        }else{
            $addSQL = $pdo->prepare("INSERT INTO inventory (  name, category price, stock) VALUES( :name, :category,:price, :stock)");
            $addSQL-> bindparam(':name', $product['name']);
            $addSQL-> bindparam(':category', $product['category']);
            $addSQL-> bindparam(':price', $product['price']);
            $addSQL-> bindparam(':stock', $product['stock']);
            $addSQL-> execute();
            echo "product added successfully...";

        };
    }

    public function editButton(){
        
    }
};