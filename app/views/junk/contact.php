<md-content md-theme="default">
  <section layout="row" layout-sm="column" layout-align="center center">
    <?php

    $file = 'members.txt';
    $lines = file('members.txt');
    if($handle = fopen($file, 'r')) { // Open file in read mode
      $content = fread($handle, filesize($file)); // set the number of characters to read
      fclose($handle); // closes conntection to the file

      echo "<table id='member-list'>";
      echo "<thead><tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Experience</th></tr></thead>";
      for($i = 0; $i <= (count($lines))-1; $i++) { //goes through each line in the file
        $line = $lines[$i]; //converts the current line to a variable
        $data = explode(" | ", $line);
        $firstName = $data[0];
        $lastName = $data[1];
        $email = $data[2];
        $experience = $data[3];

        echo "<tr>";
        echo "<td>".$firstName."</td><td>".$lastName."</td><td>".$email."</td><td>".$experience."</td>";
        echo "</tr>";
      }
      echo "</table>";
    }

    ?>
  </section>
</md-content>
