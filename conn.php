<?php

class Database{
        private $conn;
    
    public function __construct($host, $user, $pass, $dbname){
        try{
            $this->conn = new mysqli($host, $user, $pass, $dbname);
            
            if($this->conn->connect_error){
                throw new Exception("Chyba connectoru" . $this->conn->connect_error);
            }else{
                echo "conn succ";
            }
        }catch(Exception $e){
            die("Vyjímka" . $e->getMessage());
        }
        
        
    }
    
    
 /**
 * Spustí SQL dotaz s parametry.
 *
 * @param string $query SQL dotaz s otazníky jako placeholdery
 * @param array $params Parametry pro bind
 * @return mysqli_result|bool Vrací výsledky SELECT dotazu nebo true/false pro INSERT/UPDATE/DELETE
 */


    public function query($query, $params = []){
        try{
            $stmt = $this->conn->prepare($query);

            
            if(!$stmt){
                throw new Exception("Chyba dotazu na DB" . $this->conn->error);
            }
        if(!empty($params)){
            $data_types = str_repeat("s", count($params));
            //Lepší verze pro více informací naráz
            $stmt->bind_param($data_types, ...$params);
        }

        if(!$stmt->execute()){
          throw new Exception("Nepovedlo se spustit příkaz z jiného souboru" . $stmt->error);
        }

            if (stripos(trim($query), 'SELECT') === 0) {
                //stripos - Hledá bez důrazu na diakritiku nějaký string
                //Když najde SELECT na nulté pozici (Úplně na začátku) tak poznáme že je to SELECT příkaz
                $result = $stmt->get_result();
                $stmt->close();
                return $result;
            } else {
                // Pro UPDATE, INSERT, DELETE vrátíme true
                $affected = $stmt->affected_rows;
                $stmt->close();
                //Vetší než jedna je zde použito protože update může působit na více řádků naráz
                //To stejné platí pro insert a pro delete
                return $affected > 0;
            }


        }catch(Exception $e){
            echo "Vyjímka" . $e->getMessage();
            return false;
        }
    }//konec query
    
    public function __destruct(){
        if($this->conn){
            $this->conn->close();
        }
    }
    public function lastInsertId() {
        return $this->conn->insert_id;
    }
    
    
}//konec class database

    
    
?>