<?php


class Product
{
    // database connection and table name
    private $conn;
    private $table_name = 'products';

    // object properties
    public $id;
    public $name;
    public $description;
    public $price;
    public $category_id;
    public $category_name;
    public $created;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    /**
     * read products
     *
     * @return mixed
     */
    public function read()
    {

        // select all query
        $query = "SELECT c.name AS category_name,
                       p.id,
                       p.name,
                       p.description,
                       p.price,
                       p.category_id,
                       p.created
                FROM {$this->table_name} p
                         LEFT JOIN categories c on p.category_id = c.id
                ORDER BY p.created DESC";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;

    }
}