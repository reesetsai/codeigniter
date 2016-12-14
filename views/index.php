<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php 

echo form_open('login/validate');
echo form_input(array('id'=>'user','name'=>'user'));
echo form_password(array('id'=>'user_password','name'=>'user_password'));
echo form_submit('submit','登入');
echo form_close();
?>
</body>
</html>