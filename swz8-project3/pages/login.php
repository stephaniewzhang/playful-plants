<!DOCTYPE html>
<html lang="en">

<head>
  <title> Login </title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="/public/styles/style.css" media="all" />
</head>

<body>
  <?php include('includes/header.php'); ?>
  <main>
      <div class = "center">
        <h4> Please enter your administrator username and password below </h4>
        <p> Thank you for your contribution to this meaningful cause and hard work! </p>
        <?php echo_login_form('/', $session_messages);?>
      </div>
  </main>

</body>

</html>
