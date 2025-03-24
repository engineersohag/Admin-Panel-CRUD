<?php include 'header.php';?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-3 text-gray-800">Exparts</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Exparts Data</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Date of Birth</th>
                                            <th>Nationality</th>
                                            <th colspan="2" class="text-center">Operation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $select_expart = "SELECT * FROM `exparts`";
                                    $expart_query = mysqli_query($conn, $select_expart);

                                    if (mysqli_num_rows($expart_query) > 0) {
                                        while ($item = mysqli_fetch_assoc($expart_query)) { ?>
                                            <tr>
                                                <td><?= htmlspecialchars($item['name']) ?></td>
                                                <td><?= htmlspecialchars($item['email']) ?></td>
                                                <td><?= htmlspecialchars($item['date_of_birth']) ?></td>
                                                <td><?= htmlspecialchars($item['nationality']) ?></td>
                                                <td class="text-center">
                                                    <a class="text-success" href="details-expart.php?expart_id=<?= $item['expart_id'] ?>"><i class="fa-solid fa-eye"></i></a>
                                                </td>
                                                <td class="text-center">
                                                    <form method="POST" onsubmit=" return confirm('Are you sure you want to delete?')">
                                                        <input type="hidden" name="id" value="<?=$item['id']?>">
                                                        <input type="hidden" name="profile_img" value="<?=$item['profile_img']?>">
                                                        <input type="hidden" name="cert_img" value="<?=$item['certificate_img']?>">
                                                        <button class="btn btn-transparent text-danger cursor-pointer" type="submit" name="DeleteBtn"><i class="fa-solid fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php }
                                    } else {
                                        echo "<tr><td colspan='7' class='text-center'>No Data Found</td></tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

<?php include 'footer.php';
if (isset($_POST['DeleteBtn'])) {
    $id = $_POST['id'];
    $profile_img = $_POST['profile_img'];
    $cert_img = $_POST['cert_img'];

    // ** Check if file exists before deleting **
    if (!empty($profile_img) && file_exists($profile_img)) {
        unlink($profile_img);
    }

    if (!empty($cert_img) && file_exists($cert_img)) {
        unlink($cert_img);
    }

    // ** SQL Query to Delete Record **
    $delete = "DELETE FROM `exparts` WHERE id = ?";
    $stmt = $conn->prepare($delete);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Record deleted successfully!'); window.location.href='view-expart.php';</script>";
    } else {
        echo "<script>alert('Error deleting record!'); window.location.href='view-expart.php';</script>";
    }

    $stmt->close();
}

?>