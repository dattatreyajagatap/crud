<?php 
    class db{

        private $host = "localhost";
        private $username = "root";
        private $password = "";
        private $dbname = "test";

        private $conn = false;
        private $sqli_var = "";
        private $result_error = array();

        private $mysqli = ""; // This will be our mysqli object
		private $myQuery = "";// used for debugging process with SQL return

        public function __construct(){

            if(!$this->conn){
                $this->sqli_var = new mysqli(
                    $this->host,
                    $this->username,
                    $this->password,
                    $this->dbname
                );

                $this->conn = true;

                if($this->sqli_var->connect_error){
                    array_push($this->result_error, $this->sqli_var->connect_error);
                    return false;
                }
            }else{
                return true;
            }

        }

        // insert
        public function insert($table, $params = array()){
            if($this->checktable($table)){
                print_r($params);

                $table_colms = implode(', ', array_keys($params));

                $table_values = implode("', '", $params);
                
                echo $sql = "insert into $table ($table_colms) values ('$table_values')";

                if($this->sqli_var->query($sql)){
                    array_push($this->result_error, $this->sqli_var->insert_id);
                    return true;
                }else{
                    array_push($this->result_error, $this->sqli_var->error);
                    return false;
                }

            }else{
                return false;
            }

        }

        // update
        public function update($table, $params = array(), $where = null){
            if($this->checktable($table)){
                // print_r($params);

                $args = array();
                foreach ($params as $key => $value){
                    $args[] = "$key = '$value' ";
                }

                // print_r($args);

                $table_values = implode(", ", $args);

                
                $sql = "UPDATE $table SET ".$table_values;

                if($where != null){
                    $sql .= "where $where";
                }


                if($this->sqli_var->query($sql)){
                    array_push($this->result_error, $this->sqli_var->affected_rows);
                    return true;
                }else{
                    array_push($this->result_error, $this->sqli_var->error);
                    return false;
                }

            }else{
                return false;
            }
        }

        // delete 
        public function delete($table, $where){
            if($this->checktable($table)){
                echo $sql = "delete from $table where $where";
                if($this->sqli_var->query($sql)){
                    array_push($this->result_error, $this->sqli_var->affected_rows);
                    return true;
                }else{
                    array_push($this->result_error, $this->sqli_var->error);
                    return false;
                }
            }else{
                return false;
            }

        }

        // get
        public function select( $table, $row = "*", $join = null, $where = null, $order = null, $limit = null){

            if($this->checktable($table)){
                $sql = "select $row from $table";
                if($join != null){
                    $sql .= " JOIN $join";
                }
                if($where != null){
                    $sql .= " where $where";
                }
                if($order != null){
                    $sql .= " order by $order";
                }
                if($limit != null){
                    if(isset($_GET["page"])){
                        $page = $_GET["page"];
                    }
                    else{
                        $page = 1;
                    }
                    $start = ($page-1) * $limit;
    
                    $sql .= ' LIMIT '.$start.','.$limit;
                }
                // $query = $this->sqli_var->query($sql);

                // echo $sql;

                $this->myQuery = $sql; // Pass back the SQL 
                // The table exists, run the query
                $query = $this->sqli_var->query($sql);   

				if($query){
					$this->result_error = $query->fetch_all(MYSQLI_ASSOC);
                    // array_push($this->result_error, $this->sqli_var->affected_rows);
					return true; // Query was successful
				}else{
					array_push($this->result,$this->sqli_var->error);
					return false; // No rows where returned
				}
            }else{
                return false;
            }

        }

        public function normalSelect($sql){
            $qry = $this->sqli_var->query($sql);
            if($sql){
                $this->result_error = $qry->fetch_all(MYSQLI_ASSOC);
                return true;
            }else{
                array_push($this->result_error, $this->sqli_var->error);
                return false;
            }
        }

        // check table
        private function checktable($table){
            $qry = "Show tables from $this->dbname LIKE '$table' ";
            $tableInDB = $this->sqli_var->query($qry);
            if($tableInDB->num_rows == 1){
                return true;
            }else{
                array_push($this->result_error, $table."doesnt exist");
                return false;
            }
        }

        // result
        public function getResult(){
            $val = $this->result_error;
            $this->result_error = array();
            return $val;
        }

        //Pass the SQL back for debugging
        public function getSql(){
            $val = $this->myQuery;
            $this->myQuery = array();
            return $val;
        }
        
        // 
        public function __destruct(){
            if($this->conn){
                if($this->sqli_var->close()){
                    $this->conn = false;
                    return true;
                }
            }else{
                return false;
            }

        }

        // FUNCTION to show pagination
        public function pagination($table, $join = null, $where = null, $limit = null){
            // Check to see if table exists
            if($this->checktable($table)){
                //If no limit is set then no pagination is available
                if( $limit != null){
                    // select count() query for pagination
            $sql = "SELECT COUNT(*) FROM $table";
            if($where != null){
            $sql .= " WHERE $where";
            }
            if($join != null){
                $sql .= ' JOIN '.$join;
            }
            // echo $sql; exit;
            $query = $this->sqli_var->query($sql);
            
            $total_record = $query->fetch_array();
            $total_record = $total_record[0];

            $total_page = ceil( $total_record / $limit);

            $url = basename($_SERVER['PHP_SELF']);

                if(isset($_GET["page"])){
                        $page = $_GET["page"];
                        }
                        else{
                            $page = 1;
                        }

            // show pagination
            $output =   "<ul class='pagination'>";
            if($page>1){
                $output .="<li><a href='$url?page=".($page-1)."' class='page-link'>Prev</a></li>";
            }
            if($total_record > $limit){
                for ($i=1; $i<=$total_page ; $i++) {
                if($i == $page){
                    $cls = "class='active'";
                }else{
                    $cls = '';
                }
                    $output .="<li $cls><a class='page-link' href='$url?page=$i'>$i</a></li>";
                }
            }
            if($total_page>$page){
                $output .="<li> <a class='page-link' href='$url?page=".($page+1)."'>Next</a></li>";
            }
            $output .= "</ul>";

            return $output;
                }

            }else{
            return false; // Table does not exist
            }
        }

        // Escape your string
        public function escapeString($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $this->mysqli->real_escape_string($data);
        }

    }

    

?>