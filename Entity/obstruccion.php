<?php
    class Obstruccion{
        // Connection
        private $conn;
        // Table
        private $db_table = "obstruccion";
        // Columns
        public $id;
        public $calle_id;
        public $altura;
        public $motivo;
        public $temporalidad;
        public $incidencia;
        public $longitud;
        public $latitud;
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getEmployees(){
            $sqlQuery = "SELECT id, name, email, age, designation, created FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        // CREATE
        public function createObstruccion(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                    calle_id = :calle_id, 
                    altura = :altura, 
                    motivo = :motivo, 
                    temporalidad = :temporalidad, 
                    incidencia = :incidencia, 
                    longitud = :longitud, 
                    latitud = :latitud";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->calle_id=htmlspecialchars(strip_tags($this->calle_id));
            $this->altura=htmlspecialchars(strip_tags($this->altura));
            $this->motivo=htmlspecialchars(strip_tags($this->motivo));
            $this->temporalidad=htmlspecialchars(strip_tags($this->temporalidad));
            $this->incidencia=htmlspecialchars(strip_tags($this->incidencia));
            $this->longitud=htmlspecialchars(strip_tags($this->longitud));
            $this->latitud=htmlspecialchars(strip_tags($this->latitud));
        
            // bind data
            $stmt->bindParam(":calle_id", $this->calle_id);
            $stmt->bindParam(":altura", $this->altura);
            $stmt->bindParam(":motivo", $this->motivo);
            $stmt->bindParam(":temporalidad", $this->temporalidad);
            $stmt->bindParam(":incidencia", $this->incidencia);
            $stmt->bindParam(":longitud", $this->longitud);
            $stmt->bindParam(":latitud", $this->latitud);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // READ single
        public function getSingleObstruccion(){
            $sqlQuery = "SELECT
                        id, 
                        calle_id, 
                        altura, 
                        motivo, 
                        temporalidad, 
                        incidencia, 
                        longitud, 
                        latitud
                      FROM
                        ". $this->db_table ."
                    WHERE 
                    calle_id = :calle_id
                    AND
                    altura BETWEEN " . $this->altura - 200 . " AND " . $this->altura + 200 . "
                    LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(":calle_id", $this->calle_id);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->calle_id = $dataRow['calle_id'];
            $this->altura = $dataRow['altura'];
            $this->motivo = $dataRow['motivo'];
            $this->temporalidad = $dataRow['temporalidad'];
            $this->incidencia = $dataRow['incidencia'];
            $this->longitud = $dataRow['longitud'];
            $this->latitud = $dataRow['latitud'];
        }        
        // UPDATE
        public function updateObstruccion(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                    calle_id = :calle_id, 
                    altura = :altura, 
                    motivo = :motivo, 
                    temporalidad = :temporalidad, 
                    incidencia = :incidencia, 
                    longitud = :longitud, 
                    latitud = :latitud
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->calle_id=htmlspecialchars(strip_tags($this->calle_id));
            $this->altura=htmlspecialchars(strip_tags($this->altura));
            $this->motivo=htmlspecialchars(strip_tags($this->motivo));
            $this->temporalidad=htmlspecialchars(strip_tags($this->temporalidad));
            $this->incidencia=htmlspecialchars(strip_tags($this->incidencia));
            $this->longitud=htmlspecialchars(strip_tags($this->longitud));
            $this->latitud=htmlspecialchars(strip_tags($this->latitud));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":calle_id", $this->calle_id);
            $stmt->bindParam(":altura", $this->altura);
            $stmt->bindParam(":motivo", $this->motivo);
            $stmt->bindParam(":temporalidad", $this->temporalidad);
            $stmt->bindParam(":incidencia", $this->incidencia);
            $stmt->bindParam(":longitud", $this->longitud);
            $stmt->bindParam(":latitud", $this->latitud);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // DELETE
        function deleteEmployee(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>