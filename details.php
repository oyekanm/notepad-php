<?php
include("config/db_connect.php");

if(isset($_POST["delete"])):

    $id = mysqli_real_escape_string($conn,$_POST["delete_id"]);

    $sql = "DELETE FROM notes WHERE id = $id";

    if(mysqli_query($conn,$sql)):
        header("Location:index.php");
    else:
        echo 'query error:' . mysqli_error($conn);
    endif;
endif;


if(isset($_GET["id"])):

    $id = mysqli_real_escape_string($conn,$_GET["id"]);

    $sql = "SELECT * from notes WHERE id = $id" ;

    $result = mysqli_query($conn,$sql);

    $notes = mysqli_fetch_assoc($result);

    mysqli_free_result($result);

mysqli_close($conn);

    // print_r($notes);
endif;
?>


<!DOCTYPE html>
<html lang="en">

<?php include('Components/Layout/Header.php') ?>

<section class="container mx-auto px-4 sm:px-8 md:px-12 pt-16">
    <?php 
    if($notes) :
    ?>

<span class="flex justify-between b">
    <p class="text-[15px] font-bold uppercase"><?php echo htmlspecialchars($notes["title"]) ?></p>
    <p><?php echo date($notes["created_at"]) ?></p>
</span>

<div class="break-words mt-8">
    <p class="text-[18px] "><?php echo htmlspecialchars($notes["note"]) ?></p>
</div>

<form action="details.php" method="POST" class="flex justify-end mt-8">
    <input type="hidden" name="delete_id" value="<?php echo $notes["id"] ?>">
    <input class="text-[18px] font-bold bg-gray-300 p-4 rounded shadow-lg hover:shadow-inner uppercase" type="submit" value="delete" name="delete">
</form>


<?php else: ?>
<?php endif; ?>

</section>

<?php include('Components/Layout/Footer.php') ?>


</html>