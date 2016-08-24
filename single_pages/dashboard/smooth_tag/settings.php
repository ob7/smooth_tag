<?php  defined('C5_EXECUTE') or die("Access Denied."); ?>
<form method="post" action="<?php echo $this->action('save_settings');?>">

    <?php  echo $this->controller->token->output('save_settings'); ?>

    <legend><?php echo t('General Settings')?></legend>
    <fieldset>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <?php echo $form->label('enableSmoothTag', t('Enable Smooth Tag'))?>
                    <?php echo $form->checkbox('enableSmoothTag', 1, $enableSmoothTag);?>
                    <?php echo $form->text('textBox', $textBox);?>
                </div>
                <div class="col-xs-12 col-md-6">
                </div>
            </div>
        </div>
    </fieldset>
    <div class="ccm-dashboard-form-actions-wrapper">
        <div class="ccm-dashboard-form-actions">
            <button class="pull-right btn btn-success" type="submit"><?php echo t('Save');?></button>
        </div>
    </div>
</form>
