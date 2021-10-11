<?php
	include('config/bd_conexao.php');

	if(isset($_GET['id'])){
        //Limpa a query sql
        $id = mysqli_real_escape_string($conn, $_GET['id']);

        //Monta a query
        $sql = "SELECT * FROM tb_local l INNER JOIN tb_banda b ON b.id_banda = l.id_banda WHERE l.id = $id;";

        //Pega o resultado da query
        $result = mysqli_query($conn, $sql);

        //Busca um unico resultado em formato de vetor
        $show = mysqli_fetch_assoc($result);

        mysqli_free_result($result);
        mysqli_close($conn);
    }

	//Remove a pizza do banco de dados
    if(isset($_POST['delete'])) {
        //Limpando a query
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        //Montando a query
        $sql = "DELETE FROM tb_local WHERE id = $id";
        //Removendo do banco
        if(mysqli_query($conn, $sql)){
            //Sucesso
            header('Location: index.php');
        } else {
            echo 'query error: '.mysqli_error($conn);
        }
    }

?>

<!DOCTYPE html>
<html>
<?php include('templates/header.php') ?>
	<div class="infShow">
        <div class="container">
            <div class="texto">
                <h4><?php echo htmlspecialchars($show['nm_banda']); ?></h4>
                <p>Confira abaixo as informações desse inclivel show!!! Se quiser um ingresso basta clicar em comprar para garantir o seu lugar...</p>
                <p style="font-weight: 800; font-size: 18px;">Mas corre os ingressos são limitados!!!</p>
            </div>
            <img src="images/rock-and-roll.png" alt="Mão do Rock">
        </div>
		<div class="col s12 md3" style="margin: 0 30px; padding-bottom: 10px;">
			<div class="card z-depth-0">
				<div class="card-content">
					<span>Data</span>
					<h6 class="center"><?php echo htmlspecialchars($show['data']); ?></h6>
					<span>Horario</span>
					<h6 class="center"><?php echo htmlspecialchars($show['horario']); ?></h6>
					<span>Local</span>
					<h6 class="center"><?php echo htmlspecialchars($show['local']); ?></h6>
                    <span>Estoque</span>
					<h6 class="center"><?php echo htmlspecialchars($show['estoque']); ?></h6>
                    <span>Preço Inteiro</span>
					<h6 class="center">R$ <?php echo htmlspecialchars($show['preco']); ?></h6>
				</div>
			</div>
		</div>
        <div class="center">
            <form action="comprar.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $show['id']; ?>">
                <input type="submit" name="comprar" value="Comprar" class="btn btn-size green z-depth-0">
            </form>
        </div>
        <div class="titulo-inf">
			<form action="alterarSHOW.php" method="POST">
				<input type="hidden" name="id_show" value="<?php echo $show['id']; ?>">
				<input type="submit" name="alterar" value="Editar" class="btn black z-depth-0">
			</form>
			<form action="informacaoShow.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $show['id']; ?>">
                <input type="submit" name="delete" value="Remover" class="btn red z-depth-0">
            </form>		
		</div>	
	</div>
	<?php include('templates/footer.php') ?>
</html>