<h3>Upload</h3>

<?php
if (!isset($_POST['uppbtn']))
{
?>

<form action="index.php?page=2" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="myfile">Select file for upload</label>
        <input type="hidden" name="MAX_FILE_SIZE" value="2000000"/>
        <input type="file" class = "form-control" name="myfile" accept="image/*">
    </div>
    <button type="submit" class = "btn btn-primary" name = "uppbtn">Upload</button>
</form>

<?php
}
else
{
    if (isset($_POST['uppbtn']))
    {
        // $_FILES['myfile']['name'];
        // $_FILES['myfile']['tmp_name'];
        // $_FILES['myfile']['size'];
        // $_FILES['myfile']['type'];
        // $_FILES['myfile']['error'];

        if ($_FILES['myfile']['error'] != UPLOAD_ERR_OK)
        {
            echo "<h3><span style = 'color:red';>
                Upload error code: ".$_FILES['myfile']['error'] ."</span></h3>";
            exit();
        }
        if (is_uploaded_file($_FILES['myfile']['tmp_name']))
        {
            move_uploaded_file($_FILES['myfile']['tmp_name'], "./images/".$_FILES['myfile']['name']);
        }

        echo "<h3><span style = 'color:green';>
                File uploaded successfuly</span></h3>";
    }
}

?>