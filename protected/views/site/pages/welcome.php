<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<?php
$name = $_POST['fname'];
$temp = "<html>
<body>  $name";

echo $temp;

?>
Welcome <h1 style="display:none"><?php echo $_POST["fname"]; ?>!</h1><br />
You are <?php echo $_POST["age"]; ?> years old.

</body>
</html>

<script>
$(document).ready(function() {
  $("h1").slideToggle();
});
</script>
