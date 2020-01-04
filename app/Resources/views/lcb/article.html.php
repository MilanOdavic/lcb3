

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

	<script type="text/javascript">



		$(document).ready(function(){


			var buttonpressed;
	    $('button').click(function() {
	          buttonpressed = $(this).attr('value');
	    });


			$('.form_article').on('submit',function(e){
				if(buttonpressed=='delete') {
						e.preventDefault();

						if (!confirm("Click OK if you are sure")) {return false;}

						var article_id = $(this).find('input[name="article_id"]').val();

						$.ajax({
							 url:"delete_article",
							 method:"POST",
							 data:{article_id: article_id},
							 success:function(response_json)
							 {
								 alert('Success deleted');
							 }
						});
				}

			});


			$('.form_comment').on('submit',function(e){
				if(buttonpressed=='delete') {
						e.preventDefault();

						if (!confirm("Click OK if you are sure")) {return false;}

						var comment_id = $(this).find('input[name="comment_id"]').val();

						$.ajax({
							 url:"delete_comment",
							 method:"POST",
							 data:{comment_id: comment_id},
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
?>

<br/><br/><hr/><br><br/>



<h2> 3. Create Article </h2>

<?php
if($user_id != '') {
?>
<form action='create_article' method='POST' >
  categories_id: <input type='text' name='tbCategories_id' /> <br/>
  text: <input type='text' name='tbText' /> <br/>
  title: <input type='text' name='tbTitle' /> <br/>
  <input type='submit' name='btnCreateArticle' value='Create article'/>
</form>

<?php
}
else {
  echo "First log in, and then you can create.";
}
?>



<br/><br/><hr/><br><br/>











<h2> 5. Articles (Read + Update + Delete) AND Comments</h2>
	<?php

		// >>>>>>>>>> COMMENTS >>>>>>>>>>>>
		function comments_block($user_id, $comments, $article_id) {
			if($user_id != '') {
				echo "<form action='create_comment' method='POST'>";
					echo "title: <input type='text' name='tbTitle' /> *** ";
					echo "text: <input type='text' name='tbText' /> ";
					echo "<input type='hidden' name='article_id' value='" . $article_id . "'/> ";
					echo "<input type='submit' name='btnCreateComment' value='Add comment'>";
				echo "</form>";
			}
			else {
				echo "you first must loggin to post comment.";
			}
			echo "<br/>comments:<br/>";
			foreach($comments as $row) {
				if ($row->getArticles_id()->getId() != $article_id) continue;
				if ($row->getUsers_id()->getId() == $user_id) {
					echo "<form class='form_comment' action='update_comment' method='POST' >";
						echo "id:" . $row->getId() . " *** ";
						echo "title: <input type='text' name='tbTitle' value='".$row->getTitle()."'/> *** ";
						echo "text: <input type='text' name='tbText' value='".$row->getText()."'/> ";
						echo "text: <input type='hidden' name='article_id' value='".$row->getArticles_id()->getId()."'/> ";
						echo "text: <input type='hidden' id='comment_id' name='comment_id' value='".$row->getId()."'/> ";
						echo "<button type='submit' name='btnUpdateComment' value='update'>Update</button>";
						echo "<button type='submit' name='btnDeleteComment' value='delete'>Delete</button>";
					echo "</form>";
				}
				else
				{
					echo 'id: ' .$row->getId(). ' *** title: ' . $row->getTitle() . ' *** text: ' . $row->getText() . ', <br/>';
				}
			}

			echo "<br/>";
			echo "<br/>";
			echo "---------------------------------------------------------------------<br/>";
			echo "<br/>";
		}

		// <<<<<< COMMENTS <<<<<<<<





		// >>>>>> ARTICTLES >>>>>>>>
		if(isset($articles)){
			foreach($articles as $row) {
				if ($row->getUsers_id()->getId() == $user_id) {
					echo "<form class='form_article' name='formArticle' action='update_article' method='POST' >";
						echo "Article => id:".$row->getId()." *** ";
						echo "title: <input type='text' name='tbTitle' value='".$row->getTitle()."'/> *** ";
						echo "text: <input type='text' name='tbText' value='".$row->getText()."'/> ";
						echo "categories_id: <input type='text' name='tbCategories_id' value='".$row->getCategories_id()->getId()."'/> ";
						echo "<input type='hidden' name='article_id' id='article_id' value='".$row->getId()."'>";
						echo "<button type='submit' name='btnUpdateArticle' value='update'>Update</button>";
						echo "<button type='submit' name='btnDeleteArticle' value='delete'>Delete</button>";
					echo "</form>";
					comments_block($user_id, $comments, $row->getId());
				}
				else
				{
					echo 'Article => id: ' .$row->getId(). ' *** title: ' . $row->getTitle() . ' *** text: ' . $row->getText() . ' *** categories_id: ' . $row->getCategories_id()->getId().', <br/>';
					comments_block($user_id, $comments, $row->getId());
				}
			}
		}
		// <<<<<<<< ARTICLES <<<<<<<<<<

	?>
