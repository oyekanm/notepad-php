<?php
include("config/db_connect.php");
$sql = 'SELECT title,note,id from notes ORDER BY created_at';
$result = mysqli_query($conn, $sql);

$notes = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);

mysqli_close($conn);

// print_r($notes)

?>
<!DOCTYPE html>
<html lang="en">

<?php include('Components/Layout/Header.php') ?>
<section class="container mx-auto px-4 sm:px-8 md:px-12 pt-16">

   <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-8">

      <?php foreach ($notes as $note): ?>
         <div class="p-8 shadow-[0px_2px_10px_5px_rgba(0,0,0,0.6)] transition-all duration-[700ms] rounder-[10px] break-words hover:scale-[1.1] ">
            <p class="text-[10px] font-bold uppercase">
               <?php echo htmlspecialchars($note["title"]) ?>
            </p>
            <i class='fa-brands fa-php'></i>
            <p class="text-[15px] mt-4">
               <?php echo substr(htmlspecialchars($note['note']),0,50); ?>.....
               <a class="text-[15px] capitalize font-[500]"  href="details.php?id=<?php echo $note['id']?>">more</a>
            </p>
           
         </div>

      <?php endforeach; ?>
   </div>
</section>

<?php include('Components/Layout/Footer.php') ?>


</html>