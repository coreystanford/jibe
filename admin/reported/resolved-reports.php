<?php include '../view/header.php'; ?>

	<section role=main>

		<div class="main-admin">

			<div class="report-container">

				<h1>Reports</h1>

				<h2>Resolved Reports</h2>

				<a href="." class="resolved"><i class="fa fa-arrow-left fa-lg"></i>  Back</a>

				<table id="reports">

					<tr>
						<th class="center">ID</th>
						<th>Reported</th>
						<th>Project</th>
						<th>Reported By</th>
						<th> </th>
						<th> </th>
						<th> </th>
					</tr>

					<!-- loop through reports -->
					<?php foreach ($sum as $report) : ?>
						
						<tr>

							<td class="report-id"><?php echo $report['id']; ?></td>

							<td><?php echo $report['reported']->getUser()->getFname(); ?> <?php echo $report['reported']->getUser()->getLname(); ?></td>

							<td><?php echo $report['reported']->getProjTitle(); ?></td>

							<td><?php echo $report['reporter']->getFName(); ?> <?php echo $report['reporter']->getLName(); ?></td>

							<td class="edit-td"><a href="./?action=details&id=<?php echo $report['id']; ?>" title="Details"><i class="fa fa-info-circle fa-lg"></i></a></td>
							<td class="delete-td"><a href="./?action=unresolve&id=<?php echo $report['id']; ?>" title="Unresolve Report"><i class="fa fa-times fa-lg"></i></a></td>
							<td class="delete-td"><a href="./?action=delete-report&id=<?php echo $report['id']; ?>" title="Delete Report"><i class="fa fa-trash fa-lg"></i></a></td>

						</tr>

					<?php endforeach; ?>
					<!-- end loop -->

				</table><!-- end table -->

			</div><!-- end report-container -->

		</div><!-- end main-admin -->

	</section><!-- end main section -->

<?php include '../view/footer.php'; ?>