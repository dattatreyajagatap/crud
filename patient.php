<?php 
    header('Content-Type: application/json; charset=utf-8');
    ob_start();
    session_start();
    include ('db.php');

    if(isset($_POST['new_opd_submit'])){

        $db = new db();
        $patient_name = $_POST['patient_name'];
        $patient_fh = $_POST['patient_fh'];
        $patient_conatct = $_POST['patient_conatct'];
        $patient_age = $_POST['patient_age'];
        $gender = $_POST['gender'];
        $bloodGroup = $_POST['bloodGroup'];
        $patient_address = $_POST['patient_address'];
        

            $params = [
                'patient_name' => $patient_name,
                'patient_fh' => $patient_fh,
                'patient_conatct' => $patient_conatct,
                'patient_age' => $patient_age,
                'patient_gender' => $gender,
                'patient_blood' => $bloodGroup,
                'patient_address' => $patient_address,
            ];

            $db->insert('patient_details',$params);
            $response = $db->getResult();
            if(!empty($response)){
                $_SESSION['success'] = "added";
                header('location: index.php');
            }

        

    }

    // delete
    if(isset($_GET['delete_id'])){

		$db = new db();

		$id = $_GET['delete_id'];

		$db->delete('patient_details',"patient_table_id ='{$id}'");
		$response = $db->getResult();
		if(!empty($response)){
			// echo json_encode(array('success'=>$response)); exit;
            $_SESSION['deleted'] = "deleted";
            header('location: index.php');
		}
	} 

    if(isset($_POST['update'])) {
        $db = new db();
        $patient_table_id = $_POST['patient_table_id'];
        $patient_name = $_POST['patient_name'];
        $patient_fh = $_POST['patient_fh'];
        $patient_conatct = $_POST['patient_conatct'];
        $patient_age = $_POST['patient_age'];
        $gender = $_POST['gender'];
        $bloodGroup = $_POST['bloodGroup'];
        $patient_address = $_POST['patient_address'];

            $params = [
                'patient_name' => $patient_name,
                'patient_fh' => $patient_fh,
                'patient_conatct' => $patient_conatct,
                'patient_age' => $patient_age,
                'patient_gender' => $gender,
                'patient_blood' => $bloodGroup,
                'patient_address' => $patient_address,
            ];

            $db->update('patient_details',$params, "patient_table_id = '{$patient_table_id}'");
            $response = $db->getResult();
            if(!empty($response)){
                $_SESSION['success'] = "updated";
                header('location: index.php');
            }


        
    }

    if(isset($_POST['login'])){
        $patient_name = $_POST['patient_name'];
        $patient_conatct = $_POST['patient_conatct'];

        $db = new db();

        $db->select('patient_details','*',null,"patient_name = '$patient_name' AND patient_conatct = '$patient_conatct'",null,0); 
        $response = $db->getResult();

        if($response){
            foreach($response as $row) {
                $patient_table_id = $row['patient_table_id'];
                $patient_name = $row['patient_name'];
            }
            $_SESSION["id"] = $patient_table_id; /* for admin */
            $_SESSION["name"] = $patient_name; /* for admin */
            header("location: index.php");

        }else{
            echo array('error'=>'flase'); exit;

        }




    }

    if(isset($_GET['logout'])){
        if($_GET['logout'] == "yes"){
            // mysqli_close($conn);
            unset($_SESSION["id"]);
            unset($_SESSION["name"]);
            header("location: login.php");
        }
    }
   
?>