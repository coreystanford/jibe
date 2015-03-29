<?php include '../view/header.php'; ?>

	<section role=main>

		<div class="main-admin">

			<div class="report-container">

				<h1>Reports</h1>

				<a href="." class="resolved"><i class="fa fa-arrow-left fa-lg"></i>  Back</a>

				<table class="half-reports">

					<tr>
						<th colspan="4" class="center"><h3>Reported Profiles</h3></th>
					</tr>

					<tr>
						<th>Reported</th>
						<th class="center">Total</th>
						<th> </th>
						<th> </th>
					</tr>

					<!-- loop through reported users -->
					<?php foreach ($all_reported as $report) : ?>
						
						<!-- if count of reports for user is greater than (or equal to) 3 -->
						<!-- make row style red -->
						<?php if ($report['num'] >= 3): ?>
							
							<tr>
								<td class="bkgd-red"><?php echo $report['reported']->getFName(); ?> <?php echo $report['reported']->getLName(); ?></td>

								<td class="center bkgd-red"><?php echo $report['num']; ?></td>

								<td class="edit-td bkgd-red"><a href="../../profile?id=<?php echo $report['reported']->getID(); ?>" title="User Profile" target="_blank"><i class="fa fa-user fa-lg"></i></a></td>
								<td class="delete-td bkgd-red"><a href="./?action=delete-user&id=<?php echo $report['reported']->getID(); ?>" title="Delete Profile"><i class="fa fa-trash fa-lg"></i></a></td>
							</tr>

						<!-- else, when count of reports for user is less than 3 -->
						<!-- make row style normal -->
						<?php else: ?>

							<tr>
								<td class="bkgd"><?php echo $report['reported']->getFName(); ?> <?php echo $report['reported']->getLName(); ?></td>

								<td class="center bkgd"><?php echo $report['num']; ?></td>

								<td class="edit-td"><a href="../../profile?id=<?php echo $report['reported']->getID(); ?>" title="User Profile" target="_blank"><i class="fa fa-user fa-lg"></i></a></td>
								<td class="delete-td"><a href="./?action=delete-user&id=<?php echo $report['reported']->getID(); ?>" title="Delete Profile"><i class="fa fa-trash fa-lg"></i></a></td>
							</tr>

						<?php endif ?>
						<!-- end if -->

					<?php endforeach; ?>
					<!-- end loop -->

				</table><!-- end table -->

				<table class="half-reports">

					<tr>
						<th colspan="4" class="center"><h3>Reporter Profiles</h3></th>
					</tr>

					<tr>
						<th>Reporter</th>
						<th class="center">Total</th>
						<th> </th>
						<th> </th>
					</tr>

					<!-- loop through users who reported other users -->
					<?php foreach ($all_reporters as $report) : ?>
						
						<!-- if count of reports for user is greater than (or equal to) 5 -->
						<!-- make row sytle red -->
						<?php if ($report['num'] >= 5): ?>

						<tr>

							<td class="bkgd-red"><?php echo $report['reporter']->getFName(); ?> <?php echo $report['reporter']->getLName(); ?></td>

							<td class="center bkgd-red"><?php echo $report['num']; ?></td>

							<td class="edit-td bkgd-red"><a href="../../profile?id=<?php echo $report['reporter']->getID(); ?>" title="User Profile" target="_blank"><i class="fa fa-user fa-lg"></i></a></td>
							<td class="delete-td bkgd-red"><a href="./?action=delete-user&id=<?php echo $report['reporter']->getID(); ?>" title="Delete Profile"><i class="fa fa-trash fa-lg"></i></a></td>

						</tr>

						<!-- else, when count of reports for user is less than 3 -->
						<!-- make row style normal -->
						<?php else: ?>

						<tr>

							<td class="bkgd"><?php echo $report['reporter']->getFName(); ?> <?php echo $report['reporter']->getLName(); ?></td>

							<td class="center bkgd"><?php echo $report['num']; ?></td>

							<td class="edit-td"><a href="../../profile?id=<?php echo $report['reporter']->getID(); ?>" title="User Profile" target="_blank"><i class="fa fa-user fa-lg"></i></a></td>
							<td class="delete-td"><a href="./?action=delete-user&id=<?php echo $report['reporter']->getID(); ?>" title="Delete Profile"><i class="fa fa-trash fa-lg"></i></a></td>

						</tr>

						<?php endif ?>
						<!-- end if -->

					<?php endforeach; ?>
					<!-- end loop -->

				</table><!-- end table -->

			</div><!-- END report-container -->

		</div><!-- END main-admin -->

	</section><!-- END main section -->

<?php include '../view/footer.php'; ?>