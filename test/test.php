<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Multiple Select Dropdown in PHP</title>
  <style>
    .container {
      max-width: 350px;
      margin: 50px auto;
      text-align: center;
    }
    select {
      width: 100%;
      min-height: 150px;
      margin-bottom: 20px;
    }
    input[type="submit"] {
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <form action="" method="post" class="mb-3">
        <select name="Fruits[]" multiple>
          <option value="" disabled selected>Choose option</option>
          <option value="Apple">Apple</option>
          <option value="Banana">Banana</option>
          <option value="Coconut">Coconut</option>
          <option value="Blueberry">Blueberry</option>
          <option value="Strawberry">Strawberry</option>
        </select>
        <input type="submit" name="submit" vlaue="Choose options">
    </form>
    <div class="bg-primary"></div>
    <?php
      if(isset($_POST['submit'])){
        if(!empty($_POST['Fruits'])) {
          foreach($_POST['Fruits'] as $selected){
            echo '  ' . $selected;
          }          
        } else {
          echo 'Please select the value.';
        }
      }
    ?>
  </div>
</body>
</html>