<div class="bandas" id="bd">
    <div class="container">
        <img src="images/baixo.png" alt="Estrela do Rock">
        <div class="texto">
            <h4>Bandas</h4>
            <p>Quer saber mais sobre sua banda faovrita? Clicando em informações, você vai encontra algumas curiosidade sobre a origem da sua banda preferida e o nome dos seus atuais integrantes. São varias bandas para você connhecer um pouca mais sobre sua historia. Quem sabe não encontra mais uma que você goste</p>
            <p>Click e confira!!!</p>
        </div>
        
    </div>
    <div class="row">
        <?php foreach($bandas as $banda) { ?>
            <div class="col s4 md3">
                <div class="card z-depth-0" style="font-size: 17px; border-radius: 10px; background: #010f1f; color: #fff;">
                    <div class="card-content">
                        <h6 class="center" style="font-family: 'New Rocker', cursive; font-size: 32px; border-radius: 10px; background: #FFF; padding: 30px 10px; color: #010f1f;"><?php echo htmlspecialchars($banda['nm_banda']); ?></h6>
                    </div>
                    <div class="card-action right-align" style="border-radius: 10px">
                        <a class="brand-text" href="informacao.php?id=<?php echo $banda['id_banda'] ?>">Informações</a>
                    </div>
                </div>
            </div>
        <?php } ?>			
    </div>
</div>