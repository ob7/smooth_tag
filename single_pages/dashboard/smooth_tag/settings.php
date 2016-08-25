<?php  defined('C5_EXECUTE') or die("Access Denied."); ?>
<script>
$(document).ready(function(){
	$(".smooth-tag-settings [type='checkbox']").bootstrapSwitch();
});
</script>
<div class="bs-callout bs-callout-info">
    <!-- <h4>Quick Use:</h4> -->
    Smooth tag causes links within a page to have a smooth transition rather than jumping to them.  A nice effect for any pages of your site that contain anchor links.
</div>
<form class="smooth-tag-settings" method="post" action="<?php echo $this->action('save_settings');?>">

    <?php  echo $this->controller->token->output('save_settings'); ?>

    <fieldset>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                        <?php echo $form->checkbox('enableSmoothTag', 1, $enableSmoothTag, array('data-size' => 'small', 'data-on-color' => 'success', 'data-off-color' => 'danger'))?>
                        <label style="margin-left: 16px;"class="control-label" for="text" name="text"><?php echo t('Enable Smooth Tag')?>
                            <i class="launch-tooltip fa fa-question-circle" 
                               title="When enabled, Smooth Tag is loaded onto all of your websites pages.  If you wish, you may turn the effect off here."></i>
                        </label>
                    </div>
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

<style>
 .bs-callout {
     padding: 20px;
     margin: 20px 0;
     border: 1px solid #eee;
     border-left-width: 5px;
     border-radius: 3px;
 }
 .bs-callout h4 {
     margin-top: 0;
     margin-bottom: 5px;
 }
 .bs-callout p:last-child {
     margin-bottom: 0;
 }
 .bs-callout code {
     border-radius: 3px;
 }
 .bs-callout+.bs-callout {
     margin-top: -5px;
 }
 .bs-callout-default {
     border-left-color: #777;
 }
 .bs-callout-default h4 {
     color: #777;
 }
 .bs-callout-primary {
     border-left-color: #428bca;
 }
 .bs-callout-primary h4 {
     color: #428bca;
 }
 .bs-callout-success {
     border-left-color: #5cb85c;
 }
 .bs-callout-success h4 {
     color: #5cb85c;
 }
 .bs-callout-danger {
     border-left-color: #d9534f;
 }
 .bs-callout-danger h4 {
     color: #d9534f;
 }
 .bs-callout-warning {
     border-left-color: #f0ad4e;
 }
 .bs-callout-warning h4 {
     color: #f0ad4e;
 }
 .bs-callout-info {
     border-left-color: #5bc0de;
 }
 .bs-callout-info h4 {
     color: #5bc0de;
 }
</style>
