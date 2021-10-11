<?php
	include('config/bd_conexao.php');

	if(isset($_GET['id'])){
        //Limpa a query sql
        $id = mysqli_real_escape_string($conn, $_GET['id']);

        //Monta a query
        $sql = "SELECT * FROM tb_banda WHERE id_banda = $id";

        //Pega o resultado da query
        $result = mysqli_query($conn, $sql);

        //Busca um unico resultado em formato de vetor
        $banda = mysqli_fetch_assoc($result);

        mysqli_free_result($result);
        mysqli_close($conn);
    }

	//Remove a pizza do banco de dados
    if(isset($_POST['delete'])) {
        //Limpando a query
        $id = mysqli_real_escape_string($conn, $_POST['id_banda']);
        //Montando a query
        $sql = "DELETE FROM tb_banda WHERE id_banda = $id";
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
            <img src="images/homem-do-rock.png" alt="Mão do Rock">
            <div class="center">
                <h4><?php echo htmlspecialchars($banda['nm_banda']); ?></h4>
                <p style="font-size: 18px;padding: 0 80px;">Aqui você vai encontra algumas curiosidade sobre a origem da sua banda preferida e o nome dos seus atuais integrantes.</p>
            </div>            
        </div> 		
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
        <div class="titulo-inf">
            <form action="alterarBND.php" method="POST">
                <input type="hidden" name="id_banda" value="<?php echo $banda['id_banda']; ?>">
                <input type="submit" name="alterarBND" value="Editar" class="btn black z-depth-0">
            </form>
            <form action="informacao.php" method="POST">
                    <input type="hidden" name="id_banda" value="<?php echo $banda['id_banda']; ?>">
                    <input type="submit" name="delete" value="Remover" class="btn red z-depth-0">
            </form>		
        </div>
	</div>    
	<?php include('templates/footer.php') ?>
</html>