<html>
<head>
  <title>To Do List</title>

  <style>
    body {
      display: flex; 
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }
  </style>
</head>
  
<body>
  <h1>To Do List</h1>

  <form method = "POST">
    <label> Add a task </label>
    <input type = "text" name = "task">

    <button> Add </button>
  </form>

  <?php 
    $file = "task.txt";
  
    if (file_exists ($file)) {
      $tasks = file ($file, FILE_IGNORE_NEW_LINES);
    } else {
      $tasks = [];
    }

    if ($_SERVER ["REQUEST_METHOD"] == "POST") {
      if (isset ($_POST ['task'])) {
        $tasks [] = $_POST ['task'];
        file_put_contents ($file, implode (PHP_EOL, $tasks));
      }

      if (isset ($_POST ['delete'])) { 
        $index = intval ($_POST['delete']);


        if (isset ($tasks[$index])) {
          unset ($tasks[$index]);
          $tasks = array_values ($tasks);
          file_put_contents ($file, implode (PHP_EOL, $tasks));
        }
      }
    }  

    if (empty ($tasks)) {
      echo "<p> No tasks </p>";
    } else {
      echo "<ul>";
      foreach ($tasks as $index => $task) {
        echo "<li>";
          echo $task;
          echo "<form method = 'POST'>";
          echo "<input type='hidden' name='delete' value='$index'>";
          echo "<button> delete </button>";
          echo "</form>";
        echo "</li>";
      }
      echo "</ul>";
    }
  ?>

</body>
</html>
