<?php 
	include('config/bd_conexao.php');
    $erros = array('preco' => '', 'nm_banda' => '', 'data' => '', 'horario' => '', 'local' => '', 'estoque' => '', 'id_banda' => '', 'formulario' => '');
    $preco = $nm_banda = $data = $horario = $local = $estoque = $id_banda = $banda = '';

	if (isset($_POST['enviar'])){
		
		if (empty($_POST['nm_banda'])){
			$erros['nm_banda'] = 'Campo obrigatorio';
		} else{
            $nm_banda = $_POST['nm_banda'];

			$sql = "SELECT * FROM tb_banda WHERE nm_banda = '$nm_banda'";
			$result = mysqli_query($conn, $sql);
			$banda = mysqli_fetch_assoc($result);
			
			if($result){
				$id_banda = $banda['id_banda'];
			}else{
				$erros['nm_banda'] = 'Banda não cadastrada';
			}
			if (!preg_match('/^([a-zA-Z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÊÍÏÓÔÕÖÚÇÑ\s]+)(,\s*[a-zA-Z0-9záàâãéèêíïóôõöúçñÁÀÂÃÉÈÊÍÏÓÔÕÖÚÇÑ\s]*)*$/',
			$nm_banda)){
				$erros['nm_banda'] = 'O nome deve conter somente letras e numeros';
                $nm_banda = '';
            }
		}
		
		if (empty($_POST['data'])){
			$erros['data'] = 'Campo obrigatorio';
		} else{
			$data = $_POST['data'];
			if (!preg_match('/^([0-9\/-0-9\/-0-9\s]+)(,\s*[0-9\/-0-9\/-0-9\s]*)*$/',
			$data)){
				$erros['data'] = 'Formato da data DD/MM/AAAA';
                $data = '';
            }
		}

		if (empty($_POST['horario'])){
			$erros['horario'] = 'Campo obrigatorio';
		} else{
			$horario = $_POST['horario'];
			if (!preg_match('/^([0-9:0-9\s]+)(,\s*[0-9:0-9\s]*)*$/',
			$horario)){
				$erros['horario'] = 'O horario devem conter somente letras';
                $horario = '';
            }
		}

		if (empty($_POST['local'])){
			$erros['local'] = 'Campo obrigatorio';
		} else{
			$local = $_POST['local'];
			if (!preg_match('/^([a-zA-ZáàâãéèêíïóôõöúçñÁÀÂÃÉÈÊÍÏÓÔÕÖÚÇÑ\s]+)(,\s*[a-zA-ZzáàâãéèêíïóôõöúçñÁÀÂÃÉÈÊÍÏÓÔÕÖÚÇÑ\s]*)*$/',
			$local)){
				$erros['local'] = 'O local devem conter somente letras';
                $local = '';
            }
		}

		if (empty($_POST['preco'])){
			$erros['preco'] = 'Campo obrigatorio';
		} else{
			$preco = $_POST['preco'];
			if (!preg_match('/^[0-9,0-9]*$/', $preco)){
				$erros['preco'] = 'O preco devem conter somente numeros';
                $preco = '';
            }
		}

		if (empty($_POST['estoque'])){
			$erros['estoque'] = 'Campo obrigatorio';
		} else{
			$estoque = $_POST['estoque'];
			if (!preg_match('/^[0-9]*$/', $estoque)){
				$erros['estoque'] = 'O estoque devem conter somente numeros';
                $estoque = '';
            }
		}
        
        if(array_filter($erros)){
            $erros['formulario'] = 'Erro no formulario';
        }else {		

			// Limpador de codigos
            $preco = mysqli_real_escape_string($conn, $_POST['preco']);
            $data = mysqli_real_escape_string($conn, $_POST['data']);
            $horario = mysqli_real_escape_string($conn, $_POST['horario']);
            $estoque = mysqli_real_escape_string($conn, $_POST['estoque']);
            $local = mysqli_real_escape_string($conn, $_POST['local']);

			// Criando a query
			$sql = "INSERT INTO tb_local(id_banda, data, horario, estoque, local, preco) VALUES('$id_banda', '$data', '$horario', '$estoque', '$local', '$preco')";
			
			// Salva no banco de dados
			if(mysqli_query($conn, $sql)){
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
				<form action="adicionar.php" method="POST" >
					<header>Adicionar Novo Show</header>
					<div class="field input">
						<label>Nome da Banda</label>
						<input type="text" placeholder="Digite o nome da banda..." name="nm_banda" value="<?php echo $nm_banda ?>">
						<div class="red-text"><?php echo $erros['nm_banda']; ?></div>	
					</div>
					<div class="field input">
						<label>Data</label>
						<input type="text" placeholder="Digite a data no formato DD/MM/AAAA" name="data" value="<?php echo $data ?>">
						<div class="red-text"><?php echo $erros['data']; ?></div>	
					</div>
					<div class="field input">
						<label>Horario</label>
						<input type="text" placeholder="Digite o horario no formato hh:mm" name="horario" value="<?php echo $horario ?>">
						<div class="red-text"><?php echo $erros['horario']; ?></div>	
					</div>
					<div class="field input">
						<label>Estoque</label>
						<input type="text" placeholder="Digite o numero maximo de ingressos..." name="estoque" value="<?php echo $estoque ?>">
						<div class="red-text"><?php echo $erros['estoque']; ?></div>	
					</div>
					<div class="field input">
						<label>Local</label>
						<input type="text" placeholder="Digite o local do show..." name="local" value="<?php echo $local ?>">
						<div class="red-text"><?php echo $erros['local']; ?></div>	
					</div>
					<div class="field input">
						<label>Preço</label>
						<input type="text" placeholder="Digite o preço do ingresso" name="preco" value="<?php echo $preco ?>">
						<div class="red-text"><?php echo $erros['preco']; ?></div>	
					</div>
					<div class="field button">
						<input type="submit" name="enviar" value="Cadastrar">
					</div>
					<div class="red-text"><?php echo $erros['formulario']; ?></div>	
				</form>	
			</section>
		</div>	
	</section>
	
	<?php include('templates/footer.php') ?>
</html>
