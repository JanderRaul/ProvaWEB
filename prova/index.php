<?php
	include('config/bd_conexao.php');

	
	//query para buscar
	$sql = "SELECT b.nm_banda, l.data, l.id FROM tb_banda b, tb_local l WHERE b.id_banda = l.id_banda ORDER BY data ASC";
	$result = mysqli_query($conn, $sql);
	$shows = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$sql2 = "SELECT nm_banda, id_banda FROM tb_banda ORDER BY nm_banda ASC";
	$result2 = mysqli_query($conn, $sql2);
	$bandas = mysqli_fetch_all($result2, MYSQLI_ASSOC);

	//limpa a memória de $result
	mysqli_free_result($result);
	mysqli_free_result($result2);

	//fecha a conexão
	mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
	<?php include('templates/header.php') ?>	
	<?php include('templates/slideshow.php') ?>
	<?php include('templates/proximos.php') ?>
	<?php include('templates/bandas.php') ?>		
	<?php include('templates/contatos.php') ?>
	<?php include('templates/footer.php') ?>
</html>