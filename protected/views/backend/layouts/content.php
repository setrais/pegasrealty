<?php $this->beginContent('/layouts/layout'); ?>
<?php if ($this->hasFlash('default')) { ?>
<script type="text/javascript">
    $.pnotify({
        pnotify_text: '<?php echo $this->getFlash('default'); ?>'
    });
</script>
<?php } ?>

<?php if ($this->hasFlash('error')) { ?>
<script type="text/javascript">
    $.pnotify({
        pnotify_title: 'Ошибка',
        pnotify_type: 'error',
        pnotify_text: '<?php echo $this->getFlash('error'); ?>'
    });
</script>
<?php } ?>

<?php echo $content; ?>
<?php $this->endContent(); ?>
