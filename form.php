<?php
include("config/db_connect.php");

$email = $title = $message = "";
$errors = array("email" => "", "title" => "", "note" => "");


if (isset($_POST['submit'])) {
  // echo 'true';
  if (empty($_POST["Email"])) {
    $errors["email"] = 'An email is required';

  } else {
    $email = $_POST["Email"];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors["email"] = "Email must be a valid email address";
    }
  }
  if (empty($_POST["Title"])) {
    $errors["title"] = 'Title is empty';

  } else {
    $title = $_POST["Title"];
    if (!preg_match('/^[A-Za-z\s]+$/', $title)) {
      $errors["title"] = "Title must be letters and space only";
    }
  }
  if (empty($_POST["Message"])) {
    $errors["note"] = 'Note is empty';

  } else {
    $message = $_POST["Message"];
    if (!preg_match('/^[A-Za-z\s\d].+$/', $message)) {
      $errors["note"] = "Note is not a valid text";
    }
  }

  // CHECK ERRORS TO REDIRECT

  if (array_filter($errors)) :

  else:
    $email = mysqli_real_escape_string($conn,$_POST["email"]);
    $title = mysqli_real_escape_string($conn,$_POST["Title"]);
    $message = mysqli_real_escape_string($conn,$_POST["Message"]);

    $sql = "INSERT INTO notes (email,note,title) VALUES(
  '$email',
  '$message',
 '$title'
) ";
  if(mysqli_query($conn, $sql)):
    header("Location: index.php");
  else:
    echo 'query error:' . mysqli_error($conn);

  endif;



    endif;
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include('Components/Layout/Header.php') ?>
<section class="mt-[5rem]">
  <div class="container mx-auto px-4 sm:px-8 md:px-12">
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" >
      <div class="flex flex-col  mb-8">
        <label for="email" class="uppercase ">your email</label>
        <input type="email" name="Email" id="email" class="border-b-4 border-gray-100 focus-visible:outline-none pt-2"
          value="<?php echo $email ?>">
        <p class="capitalize text-red-500 mt-2">
          <?php echo $errors["email"] ?>
        </p>
      </div>
      <div class="flex flex-col  mb-8">
        <label for="title" class="uppercase ">your title</label>
        <input type="text" name="Title" id="title" class="border-b-4 border-gray-100 focus-visible:outline-none pt-2"
          value="<?php echo $title ?>">
        <p class="capitalize text-red-500 mt-2">
          <?php echo $errors["title"] ?>
        </p>

      </div>
      <div class="flex flex-col  mb-8">
        <label for="message" class="uppercase ">your note</label>
        <textarea name="Message" id="message" cols="30" rows="5"
          class="border-b-4 border-gray-100 focus-visible:outline-none pt-2"><?php echo $message ?></textarea>
        <p class="capitalize text-red-500 mt-2">
          <?php echo $errors["note"] ?>
        </p>

      </div>
      <input type="submit" value="send" name="submit"
        class="bg-gray-100 block w-full mb-8 p-4 rounded shadow-lg hover:shadow-inner uppercase text-[1rem]">
      <!-- <button type="submit"  class="bg-gray-100 block w-full mb-8 p-4 rounded shadow-lg hover:shadow-inner uppercase text-[1rem]">send</button> -->
    </form>
  </div>
</section>
<?php include('Components/Layout/Footer.php') ?>


</html>