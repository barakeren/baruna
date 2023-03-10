<h3 style=" text-align: center;">DATA PRODUK</h3><hr>
<?php 
if( isset($_GET['delete'] ) ) :
	$product->delete_produk($_GET['delete']);
endif;
?>
<div style="width: 50%; float: left; margin-top:10px;">
	<a href="?p=tambah_produk" class="tombol">Tambah Produk</a>
</div>
<div class="pull-right">
	<form action="index.php" method="get">
		<input type="text" name="q" style="width: 200px;"><input type="hidden" name="p" value="data_produk">
		<input type="submit" value="Cari" style="width: 50px; padding:6px;">
	</form>
</div>
<div class="grid_9">
	<p style="text-align: center; color: red;"><?php echo (isset($_GET['action'])) ? 'Gagal Menghapus Produk!!' : ''; ?></p>
</div>
<table width="100%">
	<thead>
		<tr>
			<th width="20">No.</th>
			<th>Kode Produk</th>
			<th>Nama Produk</th>
			<th>Stok </th>
			<th>Harga</th>
			<th width="78"></th>
		</tr>
	</thead>
	<tbody>
	<?php 
	$start=0;
	$limit=10;
	if(isset($_GET['page'])) :
		$id=$_GET['page'];
		$start=($id-1)*$limit;
	else :
		$id=1;
	endif;
	$cari = ( ! isset($_GET['q']) ) ? '' : $_GET['q']; 
	$query= $product->data_produk($cari, $start, $limit); 
	while( $row = mysqli_fetch_object($query) ) :
	?>
		<tr>
			<td><?php echo ++$start; ?>.</td>
			<td><?php echo $row->kode_produk; ?></td>
			<td><?php echo $row->nama_produk; ?></td>
			<td><?php echo $row->jumlah_stok; ?></td>
			<td><?php echo number_format($row->harga); ?></td>
			<td> 
			<a href="?p=edit_produk&id=<?php echo $row->id_produk; ?>" class="text-blue">Ubah</a> | <a href="#" onclick="delete_barang('<?php echo $row->id_produk; ?>');" class="text-red">Hapus</a></td>
		</tr>
	<?php endwhile; ?>
	</tbody>
</table>
<ul class='pagination'>
<?php
	$num_data = $product->num_produk($cari);
	$rows=mysqli_num_rows( $num_data );
	$total=ceil($rows/$limit);
	if($id>1) : echo "<li><a href='?p=data_produk&q={$cari}&page=".($id-1)."' class='button'>PREVIOUS</a></li>"; endif;
	if($id!=$total) : echo "<li><a href='?p=data_produk&q={$cari}&page=".($id+1)."' class='button'>NEXT</a></li>"; endif;
	for($i=1;$i<=$total;$i++) :
		if($i==$id) : 
				echo "<li><a class='active' href='#'>".$i."</a></li>"; 
		else :
				echo "<li><a href='?p=data_produk&q={$cari}&page=".$i."'>".$i."</a></li>"; 
		endif;
	endfor;
	?>
</ul>
<style>
table, td, th { border: 1px solid black;  font-size:12px; padding:7px; }
table { border-collapse: collapse;  width: 100%; }
th { height: 30px; }
ul.pagination { display: inline-block; padding: 0; margin: 0; margin-top:30px; }
ul.pagination li {display: inline; }
ul.pagination li a { color: black; border-radius:5px; margin-left: 10px; float: left; padding: 3px 8px; text-decoration: none; transition: background-color .3s; border: 1px solid #ddd; }
ul.pagination li a.active { background-color: #AF5855; color: white; border: 1px solid #AF5855; }
ul.pagination li a:hover:not(.active) {background-color: #ddd;}
.text-blue { color:blue; } .text-red { color:red; }

</style>

