<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>
        <?php if($idRed == 2):?>
            Etiquetar usuario en la publicaciòn:
        <?php else: ?>
            Responder:
        <?php endif; ?>
    </h3>
</div>
<div class="modal-body">
    <form action="#" method="post" id="sendAnswer">
        <input type="hidden" value="<?=$idRed;?>" name="idRed">
        <input type="hidden" value="<?=$idPost;?>" name="idPost">
        <textarea name="message" class="input-xlarge" rows="4" cols="60"><?php if($idRed == 2):?><?php echo '@'.$post['name'];?>
            <?php else: ?>@<?=$post->user->screen_name;?><?php endif; ?>
        </textarea>
        <input type="hidden" value="1" name="is_answer">
        <div class="span10">
            <strong>In response to:</strong>
            <?php if($idRed == 2):?>
                <?php echo '@'.$post['name'];?>
            <?php else: ?>
                <?=$post->text;?>
            <?php endif; ?>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" id="btnCompartir">Responder</button>
</div>