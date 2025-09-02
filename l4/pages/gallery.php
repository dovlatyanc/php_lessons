<h3>Gallery</h3>

<form action="index.php?page=3" method="POST">

<p>Select graphics:</p>
<select name="ext">
<?php
$path = './images';
if ($dir = opendir($path))
{
    $arr = array();
    while (($file = readdir($dir)) !== false)
    {
        $fullname = $path . $file;
        $pos = strpos($fullname, '.');
        $ext = substr($fullname, $pos + 1);
        $ext = strtolower($ext);
        if (!in_array($ext, $arr))
        {
            $arr[] = $ext;
            echo "<option>" . $ext . "</option>";
        }
    }
    closedir($dir);
}
?>

</select>

<input type = "submit" value = "Show Picture" class = "btn btn-primary">
</form>
<br>
<?php
if (isset($_POST['submit']))
{
    $ext = $_POST['ext'];
    $arr = glob($path . "*.".$ext);
    echo "<div class = 'panel panel-primary'>";
    echo "<div class = 'panel-heading'>";
    echo "<h3 class = 'panel-title'>Gallery content</h3></div>";

    foreach ($arr as $pic)
    {
        echo "<a href = '" .$pic . "'target = 'blank'>
            <img src = '" .$pic . "'height = '100px' border = '0'
        class = 'imp-polaroid'/>
        </a>";
    }
    echo "</div>";
}

?>