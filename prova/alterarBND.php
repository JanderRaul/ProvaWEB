<?php 
	include('config/bd_conexao.php');
    $erros = array('nm_banda' => '', 'descricao' => '', 'integrantes' => '', 'formulario' => '');
    $nm_banda = $descricao = $integrantes = '';

	if(isset($_POST['alterarBND'])){
		//Limpa os dados de sql injection
		$id = mysqli_real_escape_string($conn,$_POST['id_banda']);
		
		//Monta a query
		$sql = "SELECT * FROM tb_banda WHERE id_banda = $id;";
		
		//Executa a query e guarda em $result
		$result = mysqli_query($conn,$sql);
		
		//Busca o resultado em forma de vetor
		$banda = mysqli_fetch_assoc($result);
		
		$nm_banda = $banda['nm_banda'];
		$descricao = $banda['descricao'];
		$integrantes = $banda['integrantes'];		
		
		mysqli_free_result($result);
		
		mysqli_close($conn);	
	}
	
	if (isset($_POST['enviar'])){
		
		if (empty($_POST['nm_banda'])){
			$erros['nm_banda'] = 'Campo obrigatorio';
		} else{
            $nm_banda = $_POST['nm_banda'];
			if (!preg_match('/^([a-zA-Z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÊÍÏÓÔÕÖÚÇÑ\s]+)(,\s*[a-zA-Z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÊÍÏÓÔÕÖÚÇÑ\s]*)*$/',
			$nm_banda)){
				$erros['nm_banda'] = 'O nome deve conter somente letras e numeros';
                $nm_banda = '';
            }
		}
		if (empty($_POST['descricao'])){
			$erros['descricao'] = 'Campo obrigatorio';
		} else{
            $descricao = $_POST['descricao'];
			if (!preg_match('/^([a-zA-Z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÊÍÏÓÔÕÖÚÇÑ\s]+)(,\s*[a-zA-Z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÊÍÏÓÔÕÖÚÇÑ\s]*)*$/',
			$descricao)){
				$erros['descricao'] = 'O nome deve conter somente letras e numeros';
                $descricao = '';
            }
		}
		if (empty($_POST['integrantes'])){
			$erros['integrantes'] = 'Campo obrigatorio';
		} else{
            $integrantes = $_POST['integrantes'];
			if (!preg_match('/^([a-zA-Z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÊÍÏÓÔÕÖÚÇÑ\s]+)(,\s*[a-zA-Z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÊÍÏÓÔÕÖÚÇÑ\s]*)*$/',
			$integrantes)){
				$erros['integrantes'] = 'O nome deve conter somente letras e numeros';
                $integrantes = '';
            }
		}
        
        if(array_filter($erros)){
            $erros['formulario'] = 'Erro no formulario';
        }else{
			// Limpador de codigos
            $id_banda = mysqli_real_escape_string($conn,$_POST['id_banda']);
            $nm_banda = mysqli_real_escape_string($conn, $_POST['nm_banda']);
            $descricao = mysqli_real_escape_string($conn, $_POST['descricao']);
            $integrantes = mysqli_real_escape_string($conn, $_POST['integrantes']);
        
			// Criando a query
			$sql = "UPDATE tb_banda SET nm_banda = '$nm_banda', descricao = '$descricao', integrantes = '$integrantes' WHERE id_banda = $id_banda;";

			// Salva no banco de dados
			if(mysqli_query($conn, $sql)){
				//Sucesso
				header('Location: index.php');
			}else{
				echo 'query error: '.mysqli_error($conn);
			}
        }
	}
?>

<!DOCTYPE html>
<html>
	<?php include('templates/header.php') ?>
	<section class="container2">
		<div class="wrapper">
			<section class="form login">
				<form action="alterarBND.php" method="POST" >
					<header>Adicionar Nova Banda</header>
					<div class="field input">
						<label>Nome da Banda</label>
						<input type="text" placeholder="Digite o nome da banda..." name="nm_banda" value="<?php echo $nm_banda ?>">
						<div class="red-text"><?php echo $erros['nm_banda']; ?></div>
					</div>
					<div class="field input">
						<label>Descrição</label>
						<input type="text" placeholder="Digite uma breve descrição para a banda..." name="descricao" value="<?php echo $descricao ?>">
						<div class="red-text"><?php echo $erros['descricao']; ?></div>
					</div>
					<div class="field input">
						<label>Nome dos Integrantes</label>
						<input type="text" placeholder="Digite o nome dos integrantes do grupo..." name="integrantes" value="<?php echo $integrantes ?>">
						<div class="red-text"><?php echo $erros['integrantes']; ?></div>	
					</div>
					<div class="field button">
						<input type="submit" name="enviar" value="Alterar">
						<div class="red-text"><?php echo $erros['formulario']; ?></div>
					</div>
				</form>	
			</section>
		</div>	
	</section>
	<?php include('templates/footer.php') ?>
</html>
