<?php include '../view/header.php';

	if(!isset($_POST['submit'])){
		header('Location: ../example-form/');
	}

?>

    <section role=main>
        
        <div class="slim">

			<h2>Thanks, <?php echo $fname; ?>!</h2>

			<?php echo $fields->getSummary($_POST); ?>

		</div>

	</section>

<?php include '../view/footer.php'; ?>
