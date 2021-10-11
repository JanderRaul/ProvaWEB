<?php
	include('config/bd_conexao.php');

	//query para buscar
	$sql = "SELECT b.nm_banda, l.local, l.data, l.horario, v.quant, v.total, v.nome FROM tb_banda b INNER JOIN tb_local l ON(b.id_banda = l.id_banda) INNER JOIN tb_vendas v ON(l.id = v.id_local);";
	$result = mysqli_query($conn, $sql);
	$ingressos = mysqli_fetch_all($result, MYSQLI_ASSOC);

	//limpa a memória de $result
	mysqli_free_result($result);

	//fecha a conexão
	mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
    <?php include('templates/header.php') ?>

    <div class="infShow" style="padding: 20px;">
        <div class="container">
            <img style="margin-top: 0;" src="images/ingressos.png" alt="Ingressos">
            <div class="center">
                <h4>Seus Ingressos</h4>                
                <p style="font-size: 18px;padding: 0 80px;">Lista com seus ingressos para te lembrar do shows que já foi ou que ainda vão rolar!!</p>
            </div>            
        </div>
        <?php foreach($ingressos as $ingresso) { ?>
            <div class="ingressos">
                <div class="inf">
                    <h4><?php echo htmlspecialchars($ingresso['nm_banda']); ?></h4>
                    <p><?php echo htmlspecialchars($ingresso['local']); ?></p>
                    <div class="linha">
                        <p><?php echo htmlspecialchars($ingresso['data']); ?></p><p><?php echo htmlspecialchars($ingresso['horario']); ?> H</p>
                    </div>
                    <div class="linha">
                        <p><?php echo htmlspecialchars($ingresso['quant']); ?> unid</p><p style="color: #b92c2c; font-size: 24px;">R$ <?php echo htmlspecialchars($ingresso['total']); ?>,00</p>
                    </div>  
                    <p style="margin-top: 10px;"><?php echo htmlspecialchars($ingresso['nome']); ?></p>              
                </div>
                <img src="images/qr.png" alt="QR Code">
            </div>
        <?php } ?>
    </div>
	    
	<?php include('templates/footer.php') ?>
</html>