<?php
include('config/db_connect.php');

$id = "" ;

// FETCH RECORD DATA
if (isset($_POST['edit'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id_to_edit']);
    $sql = "SELECT * FROM cohort_food WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $record = mysqli_fetch_assoc($result);
}


// HANDLE UPDATE FORM SUBMISSION
if (isset($_POST['update'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $ingredient = mysqli_real_escape_string($conn, $_POST['ingredients']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $id = mysqli_real_escape_string($conn, $_POST['id']); // Hidden field in form

    $update_sql = "UPDATE cohort_food SET title='$title', ingredients='$ingredient', email='$email' WHERE id=$id";

    if (mysqli_query($conn, $update_sql)) {
        header('Location: index.php');
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        
        <?php include('templates/header.php'); ?>

<div class="container mt-4">
    <h3>Edit Record</h3>

    <form action="" method="POST">
        <!-- Hidden ID Field -->
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($record['id']); ?>">

        <div class="mb-3">
            <label>Title:</label>
            <input type="text" name="title" class="form-control"
                   value="<?php echo htmlspecialchars($record['title']); ?>" >
        </div>

        <div class="mb-3">
            <label>Email:</label>
            <input type="text" name="email" class="form-control"
                   value="<?php echo htmlspecialchars($record['email']); ?>" >
        </div>

        <div class="mb-3">
            <label>Ingredient:</label>
            <input type="text" name="ingredients" class="form-control"
                   value="<?php echo htmlspecialchars($record['ingredients']); ?>" >
        </div>

        <button type="submit" name="update" class="btn btn-primary">Update</button>
    </form>
</div>
<?php include('templates/footer.php'); ?>

</body>
</html>


