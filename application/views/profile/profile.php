<html>
<head>
    <title>My Form</title>
</head>
<body>


<?php echo form_open('profile'); ?>

Username:
<input type="text" name="username" value="<?php echo set_value('username'); ?>" size="50" />
<?php echo form_error('username'); ?>

Password:
<input type="text" name="password" value="<?php echo set_value('password'); ?>" size="50" />
<?php echo form_error('password'); ?>

Password Confirm:
<input type="text" name="passconf" value="<?php echo set_value('passconf'); ?>" size="50" />
<?php echo form_error('passconf'); ?>

Email Address:
<input type="text" name="email" value="<?php echo set_value('email'); ?>" size="50" />
<?php echo form_error('email'); ?>

<div><input type="submit" value="Submit"/></div>

</form>

</body>
</html>
