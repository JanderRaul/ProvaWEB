<?php 
	include('config/bd_conexao.php');
   	$erros = array('quant' => '', 'tipo' => '', 'nome' => '', 'email' => '', 'formulario' => '');
    $nm_banda = $quant = $tipo = $nome = $email = '';

	if(isset($_POST['comprar'])){
		//Limpa os dados de sql injection
		$id = mysqli_real_escape_string($conn,$_POST['id']);
		
		//Monta a query
		$sql = "SELECT * FROM tb_local l INNER JOIN tb_banda b ON b.id_banda = l.id_banda WHERE l.id = $id;";
		
		//Executa a query e guarda em $result
		$result = mysqli_query($conn,$sql);
		
		//Busca o resultado em forma de vetor
		$banda = mysqli_fetch_assoc($result);
		
		$nm_banda = $banda['nm_banda'];		
		
		mysqli_free_result($result);
		
		mysqli_close($conn);	
	}
	
	if (isset($_POST['enviar'])){

		if (empty($_POST['quant'])){
			$erros['quant'] = 'Campo obrigatorio';
		} else{
            $quant = $_POST['quant'];
			if (!preg_match('/^([0-9])*$/',
			$quant)){
				$erros['quant'] = 'Deve conter somente numeros';
                $quant = '';
            }
		}
		if (empty($_POST['tipo'])){
			$erros['tipo'] = 'Campo obrigatorio';
		} else{
            $tipo = $_POST['tipo'];
			if (!preg_match('/^([A-Za-z])*$/',
			$tipo)){
				$erros['tipo'] = 'Deve conter somente letras';
                $tipo = '';
            }
		}
		if (empty($_POST['nome'])){
			$erros['nome'] = 'Campo obrigatorio';
		} else{
            $nome = $_POST['nome'];
			if (!preg_match('/^([a-zA-ZáàâãéèêíïóôõöúçñÁÀÂÃÉÈÊÍÏÓÔÕÖÚÇÑ\s]+)(,\s*[a-zA-ZáàâãéèêíïóôõöúçñÁÀÂÃÉÈÊÍÏÓÔÕÖÚÇÑ\s]*)*$/',
			$nome)){
				$erros['nome'] = 'O nome deve conter somente letras';
                $nome = '';
            }
		}
		if(empty($_POST['email'])){
			$erros['email']= 'O e-mail é obrigatório';
		} else{
			$email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$erros['email']= 'Insira um e-mail válido ';
				$email = '';
			}
		}
		
        
        if(array_filter($erros)){
            echo 'Erro no formulario';
        }else {
			// Limpador de codigos

            $id = mysqli_real_escape_string($conn, $_POST['id']);
            $quant = mysqli_real_escape_string($conn, $_POST['quant']);
            $tipo = mysqli_real_escape_string($conn, $_POST['tipo']);
			$tipo = strtoupper($tipo);
			if($tipo == 'MEIA'){
				$sql4 = "SELECT preco FROM tb_local WHERE id = $id";
				$result = mysqli_query($conn,$sql4);
				$local = mysqli_fetch_assoc($result);
				$preco = $local['preco'];

				$valor = $preco / 2;
			}else{
				$valor = $preco;
			}
            $nome = mysqli_real_escape_string($conn, $_POST['nome']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
			$valor = $valor * $quant;
            

			// Criando a query
			$sql = "INSERT INTO tb_vendas(id_local, quant, tipo, nome, email, total) VALUES('$id', '$quant', '$tipo', '$nome', '$email', '$valor')";

			// Salva no banco de dados
			if(mysqli_query($conn, $sql)){
				//Sucesso
				$sql2 = "SELECT estoque FROM tb_local WHERE id = $id";
				$result = mysqli_query($conn,$sql2);
				$local = mysqli_fetch_assoc($result);
				$estoque = $local['estoque'];
				$estoque = $estoque - $quant;	

				$sql3 = "UPDATE tb_local SET estoque = '$estoque' WHERE id = $id";
				if(mysqli_query($conn, $sql3)){
					header('Location: index.php');
				}
				else{
					echo 'query error: '.mysqli_error($conn);
				}				
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
				<form action="comprar.php" method="POST" >
					<header>Comprar Ingresso</header>
					<input type="hidden" name="id" value="<?php echo $id ?>">
					<h4><?php echo $nm_banda ?></h4>
					<div class="field input">
						<label>Numero de Ingressos</label>
						<input type="text" placeholder="Digite a quantidade desejada..." name="quant" value="<?php echo $quant ?>">
						<div class="red-text"><?php echo $erros['quant']; ?></div>
					</div>
					<div class="field input">
						<label>Tipo do Ingresso</label>
						<input type="text" placeholder="Meia ou Inteira" name="tipo" value="<?php echo $tipo ?>">
						<div class="red-text"><?php echo $erros['tipo']; ?></div>
					</div>
					<div class="field input">
						<label>Nome do Comprador</label>
						<input type="text" placeholder="Digite o seu nome..." name="nome" value="<?php echo $nome ?>">
						<div class="red-text"><?php echo $erros['nome']; ?></div>	
					</div>
					<div class="field input">
						<label>Email</label>
						<input type="email" placeholder="Digite o seu endereço de email" name="email" value="<?php echo $email ?>">
						<div class="red-text"><?php echo $erros['email']; ?></div>	
					</div>
					<div class="field button">
						<input type="submit" name="enviar" value="Comprar">
						<div class="red-text"><?php echo $erros['formulario']; ?></div>
					</div>
				</form>	
			</section>
		</div>	
	</section>
	<?php include('templates/footer.php') ?>
</html>
