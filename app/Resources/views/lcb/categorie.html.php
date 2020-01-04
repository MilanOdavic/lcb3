

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

	<script type="text/javascript">



		$(document).ready(function(){


			var buttonpressed;
	    $('button').click(function() {
	          buttonpressed = $(this).attr('value');
	    });


			$('.form_categorie').on('submit',function(e){
				if(buttonpressed=='delete') {
						e.preventDefault();

						if (!confirm("Click OK if you are sure")) {return false;}

						var categorie_id = $(this).find('input[name="categorie_id"]').val();

						$.ajax({
							 url:"delete_categorie",
							 method:"POST",
							 data:{categorie_id: categorie_id},
							 success:function(response_json)
							 {
								 alert('Success deleted');
							 }
						});
				}

			});



		});
	</script>
















	<a href='http://localhost/xxx2/web/app_dev.php/index'> Home </a> &nbsp&nbsp&nbsp | &nbsp&nbsp&nbsp
	<a href='http://localhost/xxx2/web/app_dev.php/articles'> Articles </a> &nbsp&nbsp&nbsp | &nbsp&nbsp&nbsp
	<a href='http://localhost/xxx2/web/app_dev.php/categories'> Categories </a> &nbsp&nbsp&nbsp | &nbsp&nbsp&nbsp



<h2> MESSAGES:  </h2>
<?php
  echo $message;
  //unset($_SESSION['user_id']);
?>






  <br/><br/><hr/><br><br/>






<h2> Create Categories </h2>

<?php
if($user_id != '') {
?>
<form action='create_categorie' method='POST' >
  title: <input type='text' name='tbTitle' /> <br/>
  <input type='submit' name='btnCreateCategorie' value='Create categorie'/>
</form>

<?php
}
else {
  echo "First log in, and then you can create.";
}
?>







  <br/><br/><hr/><br><br/>


<h2> Categories (Read + Update + Delete) </h2>
<?php
	if(isset($categories)) {
		  foreach($categories as $row) {
		    if ($row->getUsers_id()->getId() == $user_id) {
		      echo "<form action='update_categorie' method='POST' class='form_categorie'>";
		        echo "id: " . $row->getId() . " *** ";
		        echo "title: <input type='text' name='tbTitle' value='".$row->getTitle()."'/> *** ";
		        echo "<input type='hidden' id='categorie_id' name='categorie_id' value='".$row->getId()."'>";
						echo "<button type='submit' name='btnUpdateCategorie' value='update'>Update</button>";
						echo "<button type='submit' name='btnDeleteCategorie' value='delete'>Delete</button>";
		      echo "</form>";
		    }
		    else
		    {
		      echo 'id: ' .  $row->getId()  .  ' *** title: ' . $row->getTitle() . ', <br/>';
		    }
		  }
		}


?>
