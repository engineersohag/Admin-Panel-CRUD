<?php include 'header.php';

if(isset($_GET['expart_id'])){
    $expart_id = intval($_GET['expart_id']);  
}
?>

<style>
    .profile-img{
        width: 100%;
        text-align: center;
        margin-top: 10px;
    }
    .profile-img img{
        width: 200px;
        height: 200px;
        border-radius: 50%;
    }
</style>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Expart ID: <?=$expart_id?></h1>
    </div>

    <?php 

    $select = "SELECT * FROM `exparts` WHERE expart_id = $expart_id";
    $query = mysqli_query($conn, $select);
    $result = mysqli_fetch_assoc($query);
    
    ?>
    <div class="row">
        <div class="col-12 col-md-5">
            <div class="card border-0 shadow p-3">
                <h3 class="text-center text-bold text-dark text-uppercase">Personal <span class="text-primary">Information</span></h3>
                <div class="profile-img">
                    <img src="<?=$result['profile_img']?>" alt=".." class="img-fluid">
                </div>
                <div class="card-body">
                    <h3><?=$result['name']?></h3>
                    <p><strong>Phone:</strong> <?=$result['phone']?></p>
                    <p><strong>Email:</strong> <?=$result['email']?></p>
                    <p><strong>Nationality:</strong> <?=$result['nationality']?></p>
                    <p><strong>Date Of Birth:</strong> <?=$result['date_of_birth']?></p>
                    <p><strong>Language:</strong> <?=$result['language']?></p>
                    <p><strong>Citizenship:</strong> <?=$result['citizenship']?></p>
                    <div>
                        <?=$result['description']?>
                    </div>

                </div>
                <a href="edit-expart.php?expart_id=<?=$result['expart_id']?>" class="btn btn-primary">Update</a>
            </div>
        </div>
        <div class="col-12 col-md-7">
            <div class="row">
                <div class="col-12 card border-0 shadow p-3">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Education</h1>
                        <a href="add-expart-education.php?expart_id=<?=$result['expart_id']?>" class="btn btn-sm btn-primary shadow-sm">Add</a>
                    </div>
                    <table class="table table-hover text-center">
                        <tr class="table-active text-dark">
                            <th>University</th>
                            <th>Degree</th>
                            <th>Field of Study</th>
                            <th>Grade</th>
                            <th>Passing Year</th>
                            <th colspan="2">Operation</th>
                        </tr>
                        <?php
                        $select_edu = "SELECT * FROM `expart_education` WHERE expart_id = $expart_id";
                        $edu_query = mysqli_query($conn, $select_edu);

                        if (mysqli_num_rows($edu_query) > 0) {
                            while ($item = mysqli_fetch_assoc($edu_query)) { ?>
                                <tr>
                                    <td><?= htmlspecialchars($item['school']) ?></td>
                                    <td><?= htmlspecialchars($item['degree']) ?></td>
                                    <td><?= htmlspecialchars($item['field_of_study']) ?></td>
                                    <td><?= htmlspecialchars($item['grade']) ?></td>
                                    <td><?= htmlspecialchars($item['study_year']) ?></td>
                                    <td>
                                        <a class="text-success" href="edit-expart-education.php?id=<?= $item['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                    </td>
                                    <td class="text-center">
                                        <form method="POST" onsubmit=" return confirm('Are you sure you want to delete?')">
                                            <input type="hidden" name="edu_id" value="<?=$item['id']?>">
                                            <button class="btn btn-transparent text-danger cursor-pointer" type="submit" name="DeleteEdu"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                    </td>
                                </tr>
                            <?php }
                        } else {
                            echo "<tr><td colspan='7' class='text-center'>No Data Found</td></tr>";
                        }
                        ?>

                    </table>
                </div>
            </div>
            <br>
            <br>
            <div class="row">
                <div class="col-12 card border-0 shadow p-3">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Experiance</h1>
                        <a href="add-expart-expreance.php?expart_id=<?=$result['expart_id']?>" class="btn btn-sm btn-primary shadow-sm">Add</a>
                    </div>
                    <table class="table table-hover text-center">
                        <tr class="table-active text-dark">
                            <th>Title</th>
                            <th>Company Name</th>
                            <th>Address</th>
                            <th>Duration</th>
                            <th colspan="2">Operation</th>
                        </tr>
                        <?php
                        $select_exp = "SELECT * FROM `expart_experience` WHERE expart_id = $expart_id";
                        $exp_query = mysqli_query($conn, $select_exp);

                        if (mysqli_num_rows($exp_query) > 0) {
                            while ($item = mysqli_fetch_assoc($exp_query)) { ?>
                                <tr>
                                    <td><?= htmlspecialchars($item['title']) ?></td>
                                    <td><?= htmlspecialchars($item['organization_name']) ?></td>
                                    <td><?= htmlspecialchars($item['address']) ?></td>
                                    <td><?= htmlspecialchars($item['duration']) ?></td>
                                    <td>
                                        <a class="text-success" href="edit-expart-expreance.php?id=<?= $item['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                    </td>
                                    <td class="text-center">
                                        <form method="POST" onsubmit=" return confirm('Are you sure you want to delete?')">
                                            <input type="hidden" name="exp_id" value="<?=$item['id']?>">
                                            <button class="btn btn-transparent text-danger cursor-pointer" type="submit" name="DeleteExp"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                    </td>

                                </tr>
                            <?php }
                        } else {
                            echo "<tr><td colspan='7' class='text-center'>No Data Found</td></tr>";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include 'footer.php';

if (isset($_POST['DeleteEdu'])) {
    $id = $_POST['edu_id'];
    
    // ** SQL Query to Delete Record **
    $deleteEdu = "DELETE FROM `expart_education` WHERE id = $id";
    $eduQuery = mysqli_query($conn, $deleteEdu);
    
    if ($eduQuery) {
        echo "<script>alert('Record deleted successfully!'); window.location.href='details-expart.php?expart_id=".$expart_id."';</script>";
    } else {
        echo "<script>alert('Error deleting record!'); window.location.href='details-expart.php?expart_id=".$expart_id."';</script>";
    }
}

if (isset($_POST['DeleteExp'])) {
    $id = $_POST['exp_id'];
    
    // ** SQL Query to Delete Record **
    $deleteExp = "DELETE FROM `expart_experience` WHERE id = $id";
    $expQuery = mysqli_query($conn, $deleteExp);
    
    if ($expQuery) {
        echo "<script>alert('Record deleted successfully!'); window.location.href='details-expart.php?expart_id=".$expart_id."';</script>";
    } else {
        echo "<script>alert('Error deleting record!'); window.location.href='details-expart.php?expart_id=".$expart_id."';</script>";
    }
}


?>