<?php include 'header.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
}

$sql = "SELECT * FROM `expart_experience` WHERE id = $id";
$query = mysqli_query($conn, $sql);
$old = mysqli_fetch_array($query);

$expart_id = $old['expart_id'];
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Update Exprieance</h1>
    </div>

    <div class="row">
        <div class="col-12 col-md-10">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Title :</label>
                    <input type="text" id="name" name="name" class="form-control" value="<?=$old['title']?>">
                </div>
                <!-- Phone & Email in one row -->
                <div class="row mb-2">
                    
                    <div class="col-md-6 mb-3">
                        <label for="study" class="form-label">Company Name :</label>
                        <input type="text" class="form-control" id="study" name="study" value="<?=$old['organization_name']?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="degree" class="form-label">Employment Type :</label>
                        <select class="custom-select" id="degree" name="degree" required>
                            <option  value="<?=$old['emp_type']?>" selected><?=$old['emp_type']?></option>
                            <option value="Full time">Full Time</option>
                            <option value="Part time">Part Time</option>
                            <option value="Self-employed">Self-employed</option>
                            <option value="Freelance">Freelance</option>
                            <option value="Contract">Contract</option>
                            <option value="Intership">Intership</option>
                        </select>
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label for="address" class="form-label">Address :</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?=$old['address']?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="duration" class="form-label">Duration :</label>
                        <input type="text" class="form-control" id="duration" name="duration" value="<?=$old['duration']?>">
                    </div>

                </div>
                
                <input type="submit" value="Save" class="btn btn-success mt-4 px-5">
        
            </form>
        </div>
    </div>
</div>


<?php include 'footer.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $title = mysqli_real_escape_string($conn, $_POST['name']);
    $organization_name = mysqli_real_escape_string($conn, $_POST['study']);
    $emp_type = mysqli_real_escape_string($conn, $_POST['degree']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $duration = mysqli_real_escape_string($conn, $_POST['duration']);


    // SQL Query
    $sql = "UPDATE `expart_experience` SET `title`='$title',`emp_type`='$emp_type',`organization_name`='$organization_name',`duration`='$duration',`address`='$address' WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: details-expart.php?expart_id=" . $expart_id);
        exit(); 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>