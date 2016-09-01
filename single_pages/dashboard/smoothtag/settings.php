<?php  defined('C5_EXECUTE') or die("Access Denied."); ?>
<script>
$(document).ready(function(){
	$(".smooth-tag-settings [type='checkbox']").bootstrapSwitch();
});
</script>
<style>
 .switch-control label {
     display: block !important;
 }
 .form-group {
     border-bottom: 1px solid #dcdcdc;
     padding-bottom: 26px;
     margin-bottom: 30px;
 }
</style>
<form class="smooth-tag-settings" method="post" action="<?php echo $this->action('save_settings');?>">
    <?php  echo $this->controller->token->output('save_settings'); ?>
    <!-- Plugin Enabled -->
    <div class="form-group">
        <div class="switch-control">
            <label class="control-label" for="enabled"><?php echo t('Plugin Enabled')?>
                <i class="launch-tooltip fa fa-question-circle" 
                   title="<?php echo t('When enabled the plugin is loaded onto all non-admin pages of your website.  If you wish, you may disable it from here.')?>"></i>
            </label>
            <?php echo $form->checkbox('enabled', 1, $enabled, array('data-size' => 'small', 'data-on-color' => 'success', 'data-off-color' => 'danger'))?>
        </div>
    </div>
    <!-- Include Areas -->
    <div class="form-group">
        <h3>
            <?php echo t('Include Areas')?>
            <i class="launch-tooltip fa fa-question-circle" 
               title="<?php echo t('A list of classes, ids, or any dom elements for the plugin to target.  If no classes or id names are given, it runs globally (via the body element) minus what its told to exclude. Multiple selectors are to be seperated with a single space character.')?>">
            </i>
        </h3>
        <div class="alert alert-info">
            <strong><?php echo t('Include Area Selectors:')?></strong> <?php echo t('You may use any type of CSS selector for the areas to be included.  The entire page can be targeted via \'body\'.  These are to be the elements that contain the anchor links, not the anchor links themselves.')?>
        </div>
        <?php  echo $form->textArea('include', $include); ?>
    </div>

    <!-- Exclude Areas -->
    <div class="form-group">
        <h3>
            <?php echo t('Exclude Areas')?>
            <i class="launch-tooltip fa fa-question-circle" 
               title="<?php echo t('Class names only. Seperate multiple class names with a single space character.')?>">
            </i>
        </h3>
        <div class="alert alert-danger">
            <strong><?php echo t('Exclude Area Selectors:')?></strong> <?php echo t('You may only use class names for elements to exclude.  Any anchor link, or container that includes anchor links with one of these classes will be ignored by the plugin.')?>
        </div>
        <?php  echo $form->textArea('exclude', $exclude); ?>
    </div>

    <!-- Additional Info -->
    <h3>
        <?php echo t('Additional Info')?>
        <i class="launch-tooltip fa fa-question-circle" 
           title="<?php echo t('This area is here just to help explain things incase you want to understand how the plugin works.')?>">
        </i>
    </h3>
    <div class="alert alert-success">
        <strong><?php echo t('Include and Exclude Selectors:')?></strong>  <?php echo t('This plugin works by controlling what happens when an anchor link is clicked.  Since other plugins may also make use of anchor links for their own functionality, this plugin allows you to control what anchor links the plugin should actually target.  Instead of assuming every anchor link it finds is for jumping to content on a page, this plugin will only target what you tell it to.')?><br><br>
        <strong><?php echo t('An \'Exclude\' selector will always override an \'Include\' selector.')?></strong>  <?php echo t('So if you tell it to include items with class name .my-link, and exclude class names of .exclude-link, and element that contains both these class names with be ignored.')?><br><br>
        <strong><?php echo t('Include Selectors are not applied to anchor links themselves.')?></strong>  <?php echo t('If you set it to include an element with the id of #my-link, and this element is an anchor link itself, the element will be ignored.  Include Selectors are applied to the container element.  All anchor links within these elements are what gets targeted.')?><br><br>
        <strong><?php echo t('Exclude Selectors can be applied directly to an anchor link itself.')?></strong>  <?php echo t('You may set it to exclude class name of .exclude-me and apply this class directly to an anchor link tag.  Likewise it will ignore all anchor links that are within an element that has that class name.')?><br><br>
        <strong><?php echo t('An example case:')?></strong>  <?php echo t('Say you had a FAQ page on your website with the questions linking to answers on the same page.  If you don\'t want the plugin to run on the entire body element, you could instead give it a class name or id that contains the question links, and then only they would be targeted by the plugin.')?><br><br>
        <strong><?php echo t('Typical use requires no configuration:')?></strong>  <?php echo t('The \'Include\' and \'Exclude\' features are here to give you total control over what gets targeted.  But typically, its fine to run it on the entire body element, which is the default setting.  In the scenario you need to ignore certain areas, or you prefer to only target certain areas, that is what this settings page is here for.')?>
    </div>

    <!-- Dashboard Form Action Area -->
    <div class="ccm-dashboard-form-actions-wrapper">
        <div class="ccm-dashboard-form-actions">
            <button class="pull-right btn btn-success" type="submit"><?php echo t('Save');?></button>
        </div>
    </div>
</form>
