<?php
class Database{

    private $host='localhost';
    private $port='5432';
    private $dbname='book_management';
    private $user='postgres';
    private $password='1234';
    protected $con;



    public function __construct($host , $port , $dbname,$user, $password ){
        $this->host=$host;
        $this->port=$port;
        $this->dbname=$dbname;
        $this->user=$user;
        $this->password=$password;
    }
    
    public function connect(){
        $this->con=pg_connect("host=$this->host port=$this->port dbname=$this->dbname user=$this->user password=$this->password ");
        if(!$this->con){
            echo "error";
        }else{
            
            return $this->con;
        }
    }

    public function createBooksTable() {
        $query = "CREATE TABLE IF NOT EXISTS books (
            book_id SERIAL PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            author VARCHAR(255) NOT NULL,
            published_date DATE,
            genre VARCHAR(100),
            price DECIMAL(10, 2)
        )";

        $result = pg_query($this->con, $query);
        if (!$result) {
            die("Error creating books table: " . pg_last_error($this->con));
        } else {
            echo "Books table created successfully!";
        }
    }
    public function close(){
        pg_close($this->con);
    }



}