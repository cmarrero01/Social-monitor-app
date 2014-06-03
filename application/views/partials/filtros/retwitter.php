<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>
        <?php if($idRed == 2):?>
            Compartir publicacion:
        <?php else: ?>
            Retwittear:
        <?php endif; ?>
    </h3>
</div>
<div class="modal-body">
    <form action="#" method="post" id="sendRetwitt">
        <input type="hidden" value="<?=$idRed;?>" name="idRed">
        <input type="hidden" value="<?=$idPost;?>" name="idPost">
        <textarea name="message" class="input-xlarge" rows="4" cols="60"><?php if($idRed == 2):?><?php echo '@'.$post['name'];?>
            <?php else: ?><?=$post->text;?><?php endif; ?>
        </textarea>
        <input type="hidden" value="0" name="is_answer">
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" id="btnRetwitt">Retwitt</button>
</div>