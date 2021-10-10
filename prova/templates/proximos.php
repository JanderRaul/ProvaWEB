<div class="shows" id="sh">
    <h4>Próximos shows</h4>
    <div class="row">
        <?php foreach($shows as $show) { ?>
            <div class="col s6 md3">
                <div class="card z-depth-0" style="font-size: 17px; border-radius: 10px; background: #010f1f; color: #fff;">
                    <div class="card-content">
                        <p><?php echo htmlspecialchars($show['data']); ?></p>
                        <h6 class="center" style="font-family: 'New Rocker', cursive; font-size: 32px; border-radius: 10px; background: #FFF; padding: 30px 10px; color: #010f1f;"><?php echo htmlspecialchars($show['nm_banda']); ?></h6>
                    </div>
                    <div class="card-action right-align" style="border-radius: 10px">
                        <a class="brand-text" href="informacaoShow.php?id=<?php echo $show['id'] ?>">Comprar Ingresso</a>
                    </div>
                </div>
            </div>
        <?php } ?>						
    </div>
</div>