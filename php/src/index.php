<?php

	session_start();
	include('config.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>DIARY</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	
	<style>
h1{
		text-align:center;

}
</style>


</head>
<body>

<div class="container">

<br><br><br>
	<h1 DIARY </h1>

	<?php
		if (isset($_SESSION['success']) && $_SESSION['success'] !='')
		{
		echo '<div class="alert alert-success" role="alert">
		'.$_SESSION['success'].'</div>';
		unset($_SESSION['success']);
		}

		if (isset($_SESSION['failed']) && $_SESSION['failed'] !='')
		{
		echo '<div class="alert alert-danger" role="alert"> '.$_SESSION['failed'].'</div>';
		unset($_SESSION['failed']);
		}
	?>



<br><br>
	<div class="float-right">
		<!-- Button trigger modal -->
	<button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#staticBackdrop">
	Add
	</button>
	</div>

	<table class="table table-striped">
		<thead>
			<tr>
			<th>ID </th>
				<th>ENTRY</th>
				<th> </th>
			
			</tr>
		</thead>

		<tbody>

		<?php
			$query = "SELECT * FROM diary";
			$query_run = mysqli_query($connection,$query);
		?>


		<?php
			if (mysqli_num_rows($query_run) > 0){

				while($row = mysqli_fetch_assoc($query_run)){
		?>


		<tr style="text-transform: capitalize;">
		<td><?php echo htmlspecialchars($row['id']); ?> </td>
			<td><?php echo htmlspecialchars($row['entry']); ?> </td>		
					
			<td width="2%">
				<form action ="edit.php" method="post">
					<input  type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
					<button type="submit" name="edit_btn" class="btn btn-success btn-circle"> Edit </button>
				</form>  	
		    </td>
			<td width="2%">
				<form action ="crud.php" method="post">
					<input  type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
					<button type="submit" name="delete_btn" class="btn btn-danger btn-circle"> Delete </button>
				</form>   
            </td>
        </tr>

        <?php
				}
       		}
		?>

		</tbody>

	</table>	
  
</div>




<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Anything to write?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
			<form action="crud.php" method="post">
				<div class="mb-3">
					<label for="exampleInputEmail1" class="form-label">Entry</label>
					<input type="text" name="entry" class="form-control" id="exampleInputPassword1">
				</div>

			
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit"  name="add" class="btn btn-primary">Add</button>
		</form>
      </div>
    </div>
  </div>
</div>

</body>
</html>

