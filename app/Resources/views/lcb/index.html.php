



	<a href='http://localhost/xxx2/web/app_dev.php/index'> Home </a> &nbsp&nbsp&nbsp | &nbsp&nbsp&nbsp
	<a href='http://localhost/xxx2/web/app_dev.php/articles'> Articles </a> &nbsp&nbsp&nbsp | &nbsp&nbsp&nbsp
	<a href='http://localhost/xxx2/web/app_dev.php/categories'> Categories </a> &nbsp&nbsp&nbsp | &nbsp&nbsp&nbsp




<br/><br/><hr/><br><br/>


<h2> 1. Registration</h2>
  <form action='create_user' method='POST'>
		name: <input type='text' name='tbName' /> <br/>
		pass: <input type='text' name='tbPass' /> <br/>
		<input type='submit' name='btnCreateAccount' value='Create account'/>
	</form>




  <br/><br/><hr/><br><br/>


<h2> 2. Login</h2>
<form action='login_user' method='POST' >
  name: <input type='text' name='tbName' /> <br/>
  pass: <input type='text' name='tbPass' /> <br/>
  <input type='hidden' name='name_func' value='login'>
  <input type='submit' name='btnLogin' value='Login'/>
</form>

<?php

if($user_id != '') {
	echo "you are LOGGED IN. <br/>";
	echo "<a href='http://localhost/xxx2/web/app_dev.php/logout_user'>LOGOUT</a>";
}
else {
	echo "you are NOT LOGGED IN";
}

?>
