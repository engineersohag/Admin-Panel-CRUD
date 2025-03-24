<?php include 'header.php' ?>

<div class="container-fluid">

<style>
    .ck-editor__editable[role="textbox"]{
        min-height: 200px;
    }
</style>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Expart</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> View Expart</a>
    </div>

    <div class="row">
        <div class="col-12 col-md-10">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-2">
                    <label for="name" class="form-label">Name :</label>
                    <input type="text" id="name" name="name" required class="form-control" placeholder="Jone..">
                </div>
                <!-- Phone & Email in one row -->
                <div class="row mb-2">
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Phone :</label>
                        <input type="number" class="form-control" id="phone" name="phone" placeholder="+44 20.." required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email :</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="example@gmail.." required>
                    </div>
                </div>

                <div class="mb-2 d-flex align-items-center">
                    <div class="w-75">
                        <label for="profile" class="form-label">Profile Photo :</label>
                        <input type="file" id="profile" name="profile" required class="form-control me-5" onchange="previewImage(event)">
                    </div>
                    <div class="border rounded d-flex align-items-center justify-content-center" style="width: 150px; margin-left: 40px; height: 120px; border: 1px dashed #355CCD;">
                        <img id="profilePreview" src="img/" alt="Select a Photo" class="img-fluid rounded" style="max-width: 100%; max-height: 100%;">
                    </div>
                </div>

                <div class="mb-2 d-flex align-items-center">
                    <div class="w-75">
                        <label for="certificate" class="    form-label">Certificate Photo :</label>
                        <input type="file" id="certificate" name="cer_img" required class="form-control me-5" onchange="previewImage2(event)">
                    </div>
                    <div class="border rounded d-flex align-items-center justify-content-center" style="width: 150px; margin-left: 40px; height: 120px; border: 1px dashed #355CCD;">
                        <img src="img/" id="certi_img" alt="Select a Photo" class="img-fluid rounded" style="max-width: 100%; max-height: 100%;">
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-6 mb-3">
                        <label for="dateofB" class="form-label">Date Of Birth :</label>
                        <input type="date" class="form-control" id="dateofB" name="date" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="nationality" class="form-label">Nationality :</label>
                        <select class="custom-select" id="nationality" name="nationality" required>
                            <option value="" selected disabled>Loading countries...</option>
                        </select>
                    </div>

                </div>

                <div class="row mb-2">
                    <div class="col-md-6 mb-3">
                        <label for="citizenship" class="form-label">Citizenship :</label>
                        <input type="text" class="form-control" id="citizenship" name="citizenship" placeholder="America, Japan.." required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="language" class="form-label">Knows Language :</label>
                        <input type="text" class="form-control" id="language" name="language" placeholder="English, Arabic.." required>
                    </div>
                </div>
                
                <div class="mb-2">
                    <label for="description" class="form-label">Description :</label>
                    <textarea id="description" name="description" rows="8" class="form-control" placeholder="Write your description..."></textarea>

                </div>
                
                <input type="submit" value="Save" class="btn btn-primary mt-4 px-5">
        
            </form>
        </div>
    </div>
</div>

<!-- Include CKEditor CDN -->
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error('CKEditor Error:', error);
            });
    });

    document.addEventListener("DOMContentLoaded", function () {
        const countryDropdown = document.getElementById("nationality");

        fetch("https://restcountries.com/v3.1/all")
            .then(response => response.json())
            .then(data => {
                countryDropdown.innerHTML = '<option value="" selected disabled>Select Your Nationality</option>';
                data.sort((a, b) => a.name.common.localeCompare(b.name.common)); // Alphabetically sort countries
                data.forEach(country => {
                    let option = document.createElement("option");
                    option.value = country.name.common;
                    option.textContent = country.name.common;
                    countryDropdown.appendChild(option);
                });
            })
            .catch(error => {
                console.error("Error fetching country list:", error);
                countryDropdown.innerHTML = '<option value="" selected disabled>Error loading countries</option>';
            });
    });

    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('profilePreview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    function previewImage2(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('certi_img');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>


<?php include 'footer.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $date_of_birth = mysqli_real_escape_string($conn, $_POST['date']);
    $nationality = mysqli_real_escape_string($conn, $_POST['nationality']);
    $citizenship = mysqli_real_escape_string($conn, $_POST['citizenship']);
    $language = mysqli_real_escape_string($conn, $_POST['language']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);


    $expart_id = random_int(1000000000, 9999999999);

    $select = "SELECT * FROM `exparts` WHERE email = '$email'";
    $query = mysqli_query($conn, $select);

    if(mysqli_num_rows($query)){
        echo "<script>alert('This data is already exits!')</script>";
    }else{
        // File upload for profile image
        $profile_img = '';
        if (isset($_FILES['profile']) && $_FILES['profile']['error'] == 0) {
            $profile_img = 'img/uploads/' . $_FILES['profile']['name'];
            move_uploaded_file($_FILES['profile']['tmp_name'], $profile_img);
        }

        // File upload for certificate image
        $certificate_img = '';
        if (isset($_FILES['cer_img']) && $_FILES['cer_img']['error'] == 0) {
            $certificate_img = 'img/uploads/' . $_FILES['cer_img']['name'];
            move_uploaded_file($_FILES['cer_img']['tmp_name'], $certificate_img);
        }

        // Insert data into the database
        $sql = "INSERT INTO `exparts` (`name`, `phone`, `email`, `profile_img`, `certificate_img`, `date_of_birth`, `nationality`, `citizenship`, `language`, `description`, `expart_id`) VALUES ('$name', '$phone', '$email', '$profile_img', '$certificate_img', '$date_of_birth', '$nationality', '$citizenship', '$language', '$description', '$expart_id')";


        if ($conn->query($sql) === TRUE) {
            header("Location: details-expart.php?expart_id=" . $expart_id);
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
    }

    
}


?>