<?php 
include 'model.php';

$obj = new Model();

/*Insert Record*/
if (isset($_POST['submit'])) {
	$obj->insertRecord($_POST);
}

/*Update Record*/
if (isset($_POST['update'])) {
	$obj->updateRecordById($_POST);
}

/*Delete Record*/
if (isset($_GET['deleteId'])) {
	$delId = $_GET['deleteId'];
	$obj->deleteRecordById($delId);
}


$data = $obj->displayRecord();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CRUD Operation in PHP OOPS</title>
	<!-- Latest compiled and minified CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- Latest compiled JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
	<br>
	<h2 class="text-center text-info">CRUD Operation in PHP Using OOPS</h2><br>
	<div class="container">
		<?php if (isset($_GET['msg']) && $_GET['msg'] == 'ins') { ?>
			<div class="alert alert-primary" role="alert">
				Record inserted Successfully!
			</div>
		<?php } ?>
		<?php if (isset($_GET['msg']) && $_GET['msg'] == 'ups') { ?>
			<div class="alert alert-success" role="alert">
				Record updated Successfully!
			</div>
		<?php } ?>
		<?php if (isset($_GET['msg']) && $_GET['msg'] == 'del') { ?>
			<div class="alert alert-warning" role="alert">
				Record deleted Successfully!
			</div>
		<?php } ?>
		<form action="index.php" method="POST">
			<?php if (isset($_GET['updateId'])) {
				$editId = $_GET['updateId'];
				$myRecord = $obj->displayRecordById($editId);
				?>
				<div class="form-group">
					<label>Name</label>
					<input type="text" name="name" value="<?php echo $myRecord['name']; ?>" placeholder="Enter your name" class="form-control"> 
					<br>
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="text" name="email" value="<?php echo $myRecord['email']; ?>" placeholder="Enter your email" class="form-control"> 
					<br>
				</div>
				<div class="form-group">
					<input type="hidden" name="hid" value="<?php echo $myRecord['id']; ?>"> 
					<input type="submit" name="update" value="Update" class="btn btn-primary text-white"> 
					<br>
				</div>
			<?php } else { ?>
				<div class="form-group">
					<label>Name</label>
					<input type="text" name="name" placeholder="Enter your name" class="form-control"> 
					<br>
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="text" name="email" placeholder="Enter your email" class="form-control"> 
					<br>
				</div>
				<div class="form-group">
					<input type="submit" name="submit" value="Submit" class="btn btn-primary text-white"> 
					<br>
				</div>				
			<?php } ?>
		</form>
		<br>
		<h4 class="text-center text-danger">Display Student Details</h4>
		<table class="table table-bordered">
			<tr class="bg-info text-center text-white">
				<th>S.No</th>
				<th>Name</th>
				<th>Email</th>
				<th>Action</th>
			</tr>
			<?php if (isset($data)) { 
				$i = 0;
				foreach ($data as $row) { 
					$i++;?>
					<tr>
						<td class="text-center"><?php echo $i; ?></td>
						<td class="text-center"><?php echo $row['name']; ?></td>
						<td class="text-center"><?php echo $row['email']; ?></td>
						<td class="text-center">
							<a href="index.php?updateId=<?php echo $row['id']; ?>" class="btn btn-primary">
								Edit
							</a>
							<a href="index.php?deleteId=<?php echo $row['id']; ?>" class="btn btn-danger">
								Delete
							</a>
						</td>
					</tr>
			<?php }
			} ?>
		</table>
	</div>
</body>
</html>