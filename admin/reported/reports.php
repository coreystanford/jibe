<?php include '../view/header.php'; 



?>

	<section role=main>

		<div class="main-admin">

			<div class="report-container">

				<h1>Reported</h1>

				<table id="reports">
					<tr>
						<th class="center">ID</th>
						<th>Reported</th>
						<th>Project</th>
						<th>Reported By</th>
						<th class="center">Edit</th>
						<th class="center">Delete</th>
					</tr>

					<?php foreach ($sum as $report) : ?>
						
						<tr>

							<td class="report-id"><?php echo $report['id']; ?></td>

							<td><?php echo $report['reported']->getUser()->getFname(); ?> <?php echo $report['reported']->getUser()->getLname(); ?></td>

							<td><?php echo $report['reported']->getProjTitle(); ?></td>

							<td><?php echo $report['reporter']->getFName(); ?> <?php echo $report['reporter']->getLName(); ?></td>

							<td class="edit-td"><a href="./?action=edit&id=<?php echo $report['id']; ?>" title="Edit Category"><i class="fa fa-pencil fa-lg"></i></a></td>
							<td class="delete-td"><a href="./?action=delete&id=<?php echo $report['id']; ?>" title="Delete Category"><i class="fa fa-trash-o fa-lg"></i></a></td>

						</tr>

					<?php endforeach; ?>

				</table>

			</div><!-- END report-container -->

		</div><!-- END main-admin -->

	</section><!-- END main section -->

<?php include '../view/footer.php';