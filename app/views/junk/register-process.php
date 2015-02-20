<md-content md-theme="default">
  <section layout="row" layout-sm="column" layout-align="center center">
    <p>Testing</p>
    <?php
    if (isset($_POST['submit'])) {
      echo "<p>form was submitted</p>";

      // set default values
      if (!empty($_POST["firstName"])) {
        $firstName = $_POST["firstName"];
      } else {
        $firstName = "";
      }
      if (!empty($_POST["lastName"])) {
        $lastName = $_POST["lastName"];
      } else {
        $lastName = "";
      }
      // set default values using ternary operator
      // boolean_test ? value_if_true : value_if_false
      $email = !empty($_POST['email']) ? $_POST['email'] : "";

      if (!empty($_POST["experience"])) {
        $experience = $_POST["experience"];
      } else {
        $experience = "";
      }

    } else {
      $firstName = "John";
      $lastName = "";
      $experience = "";
    }

    $file = 'members.txt';
    // $lines = file('members.txt');
    if($handle = fopen($file, 'a')) {

      $content = $firstName." | ".$lastName." | ".$lastName." | ".$lastName."\n";
      $pos = ftell($handle);
      fseek($handle, $pos-6);
      fwrite($handle, $content);
      fclose($handle);
    } else {
      echo "Could not open file for writing.";
    }

    ?>
  </section>
</md-content>
