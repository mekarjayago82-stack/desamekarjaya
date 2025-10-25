<?php
include('config.php');
$query = "SELECT * FROM aparatur ORDER BY id ASC";
$result = mysqli_query($conn, $query);
?>

<table border="1" cellpadding="5">
<tr>
  <th>ID</th>
  <th>Nama</th>
  <th>Jabatan</th>
  <th>Alamat</th>
  <th>No HP</th>
  <th>Email</th>
  <th>Foto</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)): ?>
<tr>
  <td><?= htmlspecialchars($row['id']); ?></td>
  <td><?= htmlspecialchars($row['nama']); ?></td>
  <td><?= htmlspecialchars($row['jabatan']); ?></td>
  <td><?= htmlspecialchars($row['alamat']); ?></td>
  <td><?= htmlspecialchars($row['no_hp']); ?></td>
  <td><?= htmlspecialchars($row['email']); ?></td>
  <td>
    <?php if(!empty($row['foto'])): ?>
      <img src="img/<?= htmlspecialchars($row['foto']); ?>" width="50">
    <?php endif; ?>
  </td>
</tr>
<?php endwhile; ?>
</table>
