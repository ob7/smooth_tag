<?php  defined('C5_EXECUTE') or die("Access Denied."); ?>
<script>
$(document).ready(function(){
	$(".smooth-tag-settings [type='checkbox']").bootstrapSwitch();
});
</script>
<div class="bs-callout bs-callout-info">
    Smooth tag causes links within a page to have a smooth transition rather than jumping to them.  A nice effect for any pages of your site that contain anchor links.
</div>
<form class="smooth-tag-settings" method="post" action="<?php echo $this->action('save_settings');?>">

    <?php  echo $this->controller->token->output('save_settings'); ?>

    <fieldset>
        <div class="form-group">
            <?php echo $form->checkbox('enabled', 1, $enabled, array('data-size' => 'small', 'data-on-color' => 'success', 'data-off-color' => 'danger'))?>
            <label style="margin-left: 16px;" class="control-label" for="enabled"><?php echo t('Enable Smooth Tag')?>
                <i class="launch-tooltip fa fa-question-circle" 
                   title="When enabled, Smooth Tag is loaded onto all of your websites pages.  If you wish, you may turn the effect off here."></i>
            </label>
        </div>
        <div class="bs-callout bs-callout-warning">
            <h4>Include and Exclude Selectors:</h4>
            Smooth Tag works by executing whenever an anchor link on a page is clicked.  Other plugins may also make use of anchor links for different functionality such as changing a slide in a slideshow or switching through different tabs of content in a block that does such a thing.<br><br>
            <b>Therefore Smooth Tag needs to ignore certain elements that may cause conflicts.</b>  <br>Smooth Tag will excplicitly ignore anchor links contained within the classes listed in the 'Exclude Selectors' text area below, and similarily, it will act upon any anchor links contained within the selectors listed in the 'Include Selectors' text area.<br><br>
            You can utilize both include and exclude selectors.  By default we've listed known selectors for Smooth Tag to ignore, and you may add more if you need.<br><br>
            If you had a FAQ page with lots of anchor links you wanted to animate, but have the plugin ignore anything else on the site, then simply add a class name or id that contains all the FAQs anchor links.<br><br>
            <b>If no include selectors are given, Smooth Tag will run on any anchor links not contained within one of the exclude selectors.</b><br>
            <b>You can target ID's with include, but you may only use class names with exclude.</b><br>
            <b>Exclude parameters override include parameters.</b>
        </div>
        <div class="form-group">
            <label class="control-label" for="text" name="text"><?php echo t('Include Selectors')?>
                <i class="launch-tooltip fa fa-question-circle" 
                   title="A list of classes or ids for smooth tag to target.  If no classes or id names are given, Smooth Tag runs globally minus whats excluded below. Seperate multiple selectors with a single space character."></i>
            </label>
            <?php  echo $form->textArea('include', $include); ?>
        </div>
        <div class="form-group">
            <label class="control-label" for="text" name="text"><?php echo t('Exclude Selectors')?>
                <i class="launch-tooltip fa fa-question-circle" 
                   title="Class names only.  Seperate multiple class names with a single space character."></i>
            </label>
            <?php  echo $form->textArea('exclude', $exclude); ?>
        </div>
    </fieldset>
    <div class="ccm-dashboard-form-actions-wrapper">
        <div class="ccm-dashboard-form-actions">
            <button class="pull-right btn btn-success" type="submit"><?php echo t('Save');?></button>
        </div>
    </div>
</form>
