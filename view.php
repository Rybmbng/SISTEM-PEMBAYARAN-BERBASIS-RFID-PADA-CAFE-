<div class="row">
				<div class="col-md-12">
					<div class="table-wrap">
						<table class="table table-striped">
						  <thead>
						    <tr>
						      <th>#</th>
						      <th>Customer</th>
						      <th>Kode Transaksi</th>
						      <th>Tanggal</th>
						      <th>Total</th>
						    </tr>
						  </thead>
						  <tbody>
						  <?php
                          $no = 1;
                          foreach ($data_transaksi  as $row) : ?>
						    <tr>
						      <th scope="row"><?= $no++; ?></th>
						      <td><a href="?admin=detail_old&kd_transaksi=<?= $row['kd_transaksi']; ?>"><?= ucwords($row['username']); ?></a></td>
						      <td><?= $row['kd_transaksi']; ?></td>
							  <td><?= $row['tanggal']; ?></td>
							  <td>Rp.<?= $row['total']; ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
						</table>
					</div>

				</div>
                
			</div>