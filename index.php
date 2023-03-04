<?php 
    session_start();
    include ('db.php');
    $db = new db();
?>
<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
  <header>
    <!-- place navbar here -->
  </header>
  <main>
    <div class="container">
        <div class="row">
            
            <?php 
                if(isset($_GET['id'])){
                    $id = $_GET['id'];

                    $db->select('patient_details','*',null, "patient_details.patient_table_id = '{$id}'",'patient_details.patient_table_id DESC', 0);
                    $response = $db->getResult();

                    foreach($response as $row) {
                        $patient_table_id = $row['patient_table_id'];
                        $patient_name = $row['patient_name'];
                        $patient_fh = $row['patient_fh'];
                        $patient_conatct = $row['patient_conatct'];
                        $patient_age = $row['patient_age'];
                        $patient_gender = $row['patient_gender'];
                        $patient_blood = $row['patient_blood'];
                        $patient_address = $row['patient_address'];

                    }

            ?>
            <div class="col-md-6">
                <form action="patient.php" class="card" role="form" id="new_opd_form" name="new_opd_form" method="post" autocomplete="off">
                        <h5 class="text-center bg-primary text-white">New OPD Registration</h5>
                        <div class="row justify-content-end">
                            <div class="col-md-3">
                                <span class="mb-2 btn text-xs badge badge-sm bg-gradient-success" data-bs-toggle="modal" data-bs-target="#get_patient">Get Infromation</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Patient Name <span class="star">*</span></label>
                                    <div class="input-group mb-4">
                                        <input class="form-control" placeholder="" name="patient_name" id="patient_name" aria-label="Patient Name..." type="text" required value="<?php echo $patient_name ?>">
                                       
                                    </div>
                                </div>
                                <div class="col-md-6 ps-2">
                                    <label>Father/Spouse/Guide</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="patient_fh" id="patient_fh" placeholder="" aria-label="Father/Spouse/Guide Name..." value="<?php echo $patient_fh ?>">
                                    </div>
                                </div>
                            </div>
                            <input class="form-control" placeholder="" name="patient_table_id" id="patient_table_id" aria-label="patient_table_id..." type="text" required value="<?php echo $patient_table_id ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Phone <span class="star">*</span></label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="patient_conatct" id="patient_conatct" placeholder="" required value="<?php echo $patient_conatct ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label>Age </label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" placeholder="" name="patient_age" id="patient_age" value="<?php echo $patient_age ?>" >
                                    </div>
                                </div>
                            </div>
            
                            <div class="row mt-4">
                                <div class="col-md-6 ps-2">
                                    <label>Gender <span class="star">*</span></label>
                                    <div class="input-group">
                                        <select class="form-control" name="gender" id="gender" required >
                                            <option <?php echo ($patient_gender == "") ? "selected" : ""; ?> value="">Select</option>
                                            <option <?php echo ($patient_gender == "M") ? "selected" : ""; ?> value="M">Male</option>
                                            <option <?php echo ($patient_gender == "F") ? "selected" : ""; ?> value="F">Female</option>
                                            <option <?php echo ($patient_gender == "O") ? "selected" : ""; ?> value="O">Others</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 ps-2">
                                    <label>Blood Groud</label>
                                    <select class="form-control" name="bloodGroup" id="bloodGroup" >
                                        <option <?php echo ($patient_blood == "") ? "selected" : ""; ?> value="">Select</option>
                                        <option <?php echo ($patient_blood == "A+") ? "selected" : ""; ?> value="A+">A+</option>
                                        <option <?php echo ($patient_blood == "O+") ? "selected" : ""; ?> value="O+">O+</option>
                                        <option <?php echo ($patient_blood == "B+") ? "selected" : ""; ?> value="B+">B+</option>
                                        <option <?php echo ($patient_blood == "AB+") ? "selected" : ""; ?> value="AB+">AB+</option>
                                        <option <?php echo ($patient_blood == "A-") ? "selected" : ""; ?> value="A-">A-</option>
                                        <option <?php echo ($patient_blood == "O-") ? "selected" : ""; ?> value="O-">O-</option>
                                        <option <?php echo ($patient_blood == "B-") ? "selected" : ""; ?> value="B-">B-</option>
                                        <option <?php echo ($patient_blood == "AB-") ? "selected" : ""; ?> value="AB-">AB-</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group mb-4">
                                <label>Address <span class="star">*</span></label>
                                <textarea class="form-control" rows="4" name="patient_address" id="patient_address" required ><?php echo $patient_address ?></textarea>
                            </div>
            
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <input type="submit" name="update" id="update" class="btn btn-primary" value="Register">
                                    <!-- <button type="submit" >Send Message</button> -->
                                </div>
                            </div>
                        </div>
                </form>
            </div>
            <?php
                }else{
            ?>
            <div class="col-md-6">
                <form action="patient.php" class="card" role="form" id="new_opd_form" name="new_opd_form" method="post" autocomplete="off">
                        <h5 class="text-center bg-primary text-white">New OPD Registration</h5>
                        <div class="row justify-content-end">
                            <div class="col-md-3">
                                <span class="mb-2 btn text-xs badge badge-sm bg-gradient-success" data-bs-toggle="modal" data-bs-target="#get_patient">Get Infromation</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Patient Name <span class="star">*</span></label>
                                    <div class="input-group mb-4">
                                        <input class="form-control" placeholder="" name="patient_name" id="patient_name" aria-label="Patient Name..." type="text" required>
                                    </div>
                                </div>
                                <div class="col-md-6 ps-2">
                                    <label>Father/Spouse/Guide</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="patient_fh" id="patient_fh" placeholder="" aria-label="Father/Spouse/Guide Name..." >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Phone <span class="star">*</span></label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="patient_conatct" id="patient_conatct" placeholder="" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label>Age </label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" placeholder="" name="patient_age" id="patient_age" >
                                    </div>
                                </div>
                            </div>
            
                            <div class="row mt-4">
                                <div class="col-md-6 ps-2">
                                    <label>Gender <span class="star">*</span></label>
                                    <div class="input-group">
                                        <select class="form-control" name="gender" id="gender" required>
                                            <option value="">Select</option>
                                            <option value="M">Male</option>
                                            <option value="F">Female</option>
                                            <option value="O">Others</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 ps-2">
                                    <label>Blood Groud</label>
                                    <select class="form-control" name="bloodGroup" id="bloodGroup" >
                                        <option value="">Select</option>
                                        <option value="A+">A+</option>
                                        <option value="O+">O+</option>
                                        <option value="B+">B+</option>
                                        <option value="AB+">AB+</option>
                                        <option value="A-">A-</option>
                                        <option value="O-">O-</option>
                                        <option value="B-">B-</option>
                                        <option value="AB-">AB-</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group mb-4">
                                <label>Address <span class="star">*</span></label>
                                <textarea class="form-control" rows="4" name="patient_address" id="patient_address" required></textarea>
                            </div>
            
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <input type="submit" name="new_opd_submit" id="new_opd_submit" class="btn btn-primary" value="Register">
                                    <!-- <button type="submit" >Send Message</button> -->
                                </div>
                            </div>
                        </div>
                </form>
            </div>
            <?php
                }
            ?>
        </div>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-md-10">
            <table class="table ">
                <thead style="background-color: #80808030;">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>phone</th>
                        <th>age</th>
                        <th>blood</th>
                        <th>action</th>
                    </tr>
                </thead>
                <thead>
                    <?php
                        
                        $limit = 10;
                        $i=1;
                        $db->select('patient_details','*',null,null,'patient_details.patient_table_id DESC',$limit);
                        $result = $db->getResult();
                        
                        $span="";
                        if (count($result) > 0) {

                            foreach($result as $row) {
                    ?>
                    <tr>
                        <td> <?php  
                                $row['patient_table_id'];
                                echo $i;
                        ?></td>
                        <td><?php echo $row['patient_name']; ?></td>
                        <td><?php echo $row['patient_conatct']; ?></td>
                        <td><?php echo $row['patient_age']; ?></td>
                        <td><?php echo $row['patient_blood']; ?></td>
                        <td>
                            <a href="index.php?id=<?php echo $row['patient_table_id']; ?>"  class="btn btn-warning">Edit</a>
                            <a href="patient.php?delete_id=<?php echo $row['patient_table_id']; ?>"  class="btn btn-danger">delete</a>
                        </td>
                    </tr>
                    <?php
                        $i++;
                            }

                        }

                    ?>
                </thead>
            </table>
        </div>
    </div>
  </main>


  <?php 
    if(isset($_SESSION['success'])){

        if($_SESSION['success'] == "added"){
            echo "
                <script>alert('added')</script>
            "; 
        }elseif($_SESSION['success'] == "updated"){
            echo "
                <script>alert('updated')</script>
            ";

            
        }elseif($_SESSION['success'] == "deleted"){
            echo "
                <script>alert('deleted')</script>
            ";

            
        }
    }
    unset($_SESSION['success']);
  ?>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>