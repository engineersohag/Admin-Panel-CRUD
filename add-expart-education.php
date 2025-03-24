<?php include 'header.php';
if(isset($_GET['expart_id'])){
    $expart_id = $_GET['expart_id'];
}
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Education</h1>
        <p>Expart ID: <?=$expart_id?></p>
    </div>

    <div class="row">
        <div class="col-12 col-md-10">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">University Name :</label>
                    <input type="text" id="name" name="name" required class="form-control" placeholder="Oxford...">
                </div>
                <!-- Phone & Email in one row -->
                <div class="row mb-2">
                    <div class="col-md-6 mb-3">
                        <label for="degree" class="form-label">Degree :</label>
                        <select class="custom-select" id="degree" name="degree" required>
                            <option value="" selected disabled>Loading degrees...</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="study" class="form-label">Field of Study :</label>
                        <input type="text" class="form-control" id="study" name="study" placeholder="example.." required>
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label for="grade" class="form-label">Grade :</label>
                        <input type="text" class="form-control" id="grade" name="grade" placeholder="4.00.." required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="year" class="form-label">Passing Year :</label>
                        <input type="number" class="form-control" id="year" name="year" placeholder="2025.." required>
                    </div>

                </div>
                
                <input type="submit" value="Save" class="btn btn-primary mt-4 px-5">
        
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const degreeSelect = document.getElementById("degree");

    // API URL 
    const apiUrl = "https://api.sampleapis.com/degrees/degrees"; 

    const fallbackDegrees = [
        { "name": "Bachelor of Science (BSc)" },
        { "name": "Master of Science (MSc)" },
        { "name": "Doctor of Philosophy (PhD)" },
        { "name": "Bachelor of Arts (BA)" },
        { "name": "Master of Business Administration (MBA)" },
        { "name": "Bachelor of Engineering (BEng)" }
    ];


    async function loadDegrees() {
        try {
            const response = await fetch(apiUrl);
            
            if (!response.ok) throw new Error("API Not Found");
            
            const degrees = await response.json();

           
            degreeSelect.innerHTML = '<option value="" selected disabled>Select a Degree</option>';

            degrees.forEach(degree => {
                const option = document.createElement("option");
                option.value = degree.name;
                option.textContent = degree.name;
                degreeSelect.appendChild(option);
            });
        } catch (error) {
            console.error("Error fetching degrees:", error);

            degreeSelect.innerHTML = '<option value="" selected disabled>API Failed, Using Default Data</option>';
            fallbackDegrees.forEach(degree => {
                const option = document.createElement("option");
                option.value = degree.name;
                option.textContent = degree.name;
                degreeSelect.appendChild(option);
            });
        }
    }

    loadDegrees();
});

</script>

<?php include 'footer.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $expart_id = $_GET['expart_id']; 
    $university = mysqli_real_escape_string($conn, $_POST['name']);
    $degree = mysqli_real_escape_string($conn, $_POST['degree']);
    $field_of_study = mysqli_real_escape_string($conn, $_POST['study']);
    $grade = mysqli_real_escape_string($conn, $_POST['grade']);
    $study_year = mysqli_real_escape_string($conn, $_POST['year']);

    // SQL Query
    $sql = "INSERT INTO expart_education (expart_id, school, degree, field_of_study, grade, study_year) 
            VALUES ('$expart_id', '$university', '$degree', '$field_of_study', '$grade', '$study_year')";

    
    if ($conn->query($sql) === TRUE) {
        header("Location: details-expart.php?expart_id=" . $expart_id);
        exit(); 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>