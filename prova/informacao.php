<?php
	include('config/bd_conexao.php');

	if(isset($_GET['id'])){
        //Limpa a query sql
        $id = mysqli_real_escape_string($conn, $_GET['id']);

        //Monta a query
        $sql = "SELECT * FROM tb_banda WHERE id = $id";

        //Pega o resultado da query
        $result = mysqli_query($conn, $sql);

        //Busca um unico resultado em formato de vetor
        $banda = mysqli_fetch_assoc($result);

        mysqli_free_result($result);
        mysqli_close($conn);
    }

?>

<!DOCTYPE html>
<html>
<?php include('templates/header.php') ?>
	<div class="bandas" id="bd" style="border-radius: 20px; margin: 0 20px">
		<h4 style="font-family: 'New Rocker', cursive; font-size: 48px; border-radius: 10px; background: #FFF; padding: 30px 10px; color: #010f1f;"><?php echo htmlspecialchars($banda['nm_banda']); ?></h4>
		<div class="col s12 md3" style="margin: 0 30px; padding-bottom: 10px;">
			<div class="card z-depth-0" style="font-size: 17px; border-radius: 10px; background: #010f1f; color: #fff;">
				<div class="card-content">
					<span>Descrição</span>
					<h6 class="center" style="font-family: 'New Rocker', cursive; font-size: 32px; border-radius: 10px; background: #FFF; padding: 30px 10px; color: #010f1f;"><?php echo htmlspecialchars($banda['descricao']); ?></h6>
					<span>Integrantes</span>
					<h6 class="center" style="font-family: 'New Rocker', cursive; font-size: 32px; border-radius: 10px; background: #FFF; padding: 30px 10px; color: #010f1f;"><?php echo htmlspecialchars($banda['integrantes']); ?></h6>
				</div>
			</div>
		</div>
	</div>
	<?php include('templates/footer.php') ?>
</html>