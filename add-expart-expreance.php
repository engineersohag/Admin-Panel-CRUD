<?php include 'header.php';
if(isset($_GET['expart_id'])){
    $expart_id = $_GET['expart_id'];
}
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Exprieance</h1>
        <p>Expart ID: <?=$expart_id?></p>
    </div>

    <div class="row">
        <div class="col-12 col-md-10">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Title :</label>
                    <input type="text" id="name" name="name" required class="form-control" placeholder="Sales Manager...">
                </div>
                <!-- Phone & Email in one row -->
                <div class="row mb-2">
                    
                    <div class="col-md-6 mb-3">
                        <label for="study" class="form-label">Company Name :</label>
                        <input type="text" class="form-control" id="study" name="study" placeholder="Google.." required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="degree" class="form-label">Employment Type :</label>
                        <select class="custom-select" id="degree" name="degree" required>
                            <option value="" selected>Please select</option>
                            <option value="full time">Full Time</option>
                            <option value="part time">Part Time</option>
                            <option value="self-employed">self-employed</option>
                            <option value="freelance">Freelance</option>
                            <option value="contract">Contract</option>
                            <option value="Intership">Intership</option>
                        </select>
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label for="address" class="form-label">Address :</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Amarica.." required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="duration" class="form-label">Duration :</label>
                        <input type="text" class="form-control" id="duration" name="duration" placeholder="2022 - Present.." required>
                    </div>

                </div>
                
                <input type="submit" value="Save" class="btn btn-primary mt-4 px-5">
        
            </form>
        </div>
    </div>
</div>


<?php include 'footer.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $expart_id = $_GET['expart_id']; 
    $title = mysqli_real_escape_string($conn, $_POST['name']);
    $organization_name = mysqli_real_escape_string($conn, $_POST['study']);
    $emp_type = mysqli_real_escape_string($conn, $_POST['degree']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $duration = mysqli_real_escape_string($conn, $_POST['duration']);


    // SQL Query
    $sql = "INSERT INTO expart_experience (expart_id, title, emp_type, organization_name, duration, address) 
            VALUES ('$expart_id', '$title', '$emp_type', '$organization_name', '$duration', '$address')";

    if ($conn->query($sql) === TRUE) {
        header("Location: details-expart.php?expart_id=" . $expart_id);
        exit(); 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>