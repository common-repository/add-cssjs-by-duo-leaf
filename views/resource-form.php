<?php

class dl_acj_ViewResourceForm {

    public $view;

    public function __construct($view) {
        $this->view = $view;
    }

    public function execute() {
        ?>
        <div class="bootstrap-iso">
            <h2><?php echo $this->view->pluginInfo->displayName; ?></h2>
            <hr />
            <div class="wrap">
                <div class="row">
                    <div class="col-md-9">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <?php if ($this->view->resource->id == 0) { ?>
                                    <span class="glyphicon glyphicon-plus"></span> Add new
                                <?php } else { ?>
                                    <span class="glyphicon glyphicon-pencil"></span> Edit
                                <?php } ?>
                            </div> 
                            <div class="panel-body">
                                <form action="admin.php?page=<?php echo $this->view->pluginInfo->name ?>&action=resource-form<?php echo ($this->view->resource->id != 0) ? "&resourceID=" . $this->view->resource->id : ""; ?>" method="post">
                                    <?php
                                    if (!empty($this->view->message)) {
                                        ?>
                                        <div class="alert alert-success" role="alert">
                                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                            <span><?php echo $this->view->message; ?></span>
                                        </div>
                                        <?php
                                    }
                                    if (!empty($this->view->errorMessage)) {
                                        ?>
                                        <div class="error fade"><p><?php echo $this->view->errorMessage; ?></p></div>  
                                        <?php
                                    }
                                    ?> 

                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active">
                                            <a href="#content" aria-controls="content" role="tab" data-toggle="tab">
                                                <span class="glyphicon glyphicon-align-justify"></span>Content
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a href="#urls" aria-controls="urls" role="tab" data-toggle="tab">
                                                <span class="glyphicon glyphicon-link"></span>Urls
                                            </a>
                                        </li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active voffset3" id="content">
                                            <?php wp_nonce_field($this->view->pluginInfo->name, $this->view->onceName); ?>
                                            <input type="hidden" name="resourceID" id="resourceID" value="<?php echo $this->view->resource->id; ?>">
                                            <div class="col-md-3 col-xs-8">
                                                <label for="resourceName"><strong><?php _e('Name', $this->view->pluginInfo->name); ?></strong></label>
                                                <input type="text" name="resourceName" id="resourceName" class="form-control"  value="<?php echo $this->view->resource->name; ?>" size="50"><?php ?>
                                            </div>
                                            <div class="col-md-2 col-xs-4">
                                                <label for="resourceLocation"><strong><?php _e('Location', $this->view->pluginInfo->name); ?></strong></label>
                                                <select name="resourceLocation" id="resourceLocation" class="form-control">
                                                    <?php
                                                    foreach ($this->view->resourceLocations as $locationResourceID => $locationResource) {
                                                        $selected = ($locationResourceID == $this->view->resource->location) ? 'selected="true"' : '';
                                                        echo '<option ' . $selected . ' value="' . $locationResourceID . '" >' . $locationResource . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-2 col-xs-4">
                                                <label for="resourceType"><strong><?php _e('Type', $this->view->pluginInfo->name); ?></strong></label>                            
                                                <select name="resourceType" id="resourceType" class="form-control">
                                                    <?php
                                                    foreach ($this->view->resourceTypes as $resourceTypeID => $resourceType) {
                                                        $selected = ($resourceTypeID == $this->view->resource->type) ? 'selected="true"' : '';
                                                        echo '<option ' . $selected . ' value="' . $resourceTypeID . '" >' . $resourceType . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3 col-xs-6 ">
                                                <label for="resourceAttributes"><strong><?php _e('Attributes', $this->view->pluginInfo->name); ?></strong></label>                                
                                                <input type="text" name="resourceAttributes" id="resourceAttributes" class="form-control" size="30" value="<?php echo $this->view->resource->attributes; ?>" >
                                            </div>
                                            <div class="col-md-2 col-xs-2 ">
                                                <br class="voffset3">
                                                <input type="checkbox" data-toggle="toggle" id="resourceEnabled" name="resourceEnabled" <?php echo ($this->view->resource->enabled) ? "checked" : ""; ?> data-on="Enabled" data-off="Disabled" />
                                            </div>

                                            <div class="col-md-12 col-xs-12 voffset3">
                                                <label for="resourceContent"><strong><?php _e('Your Content', $this->view->pluginInfo->name); ?></strong></label>                                
                                                <textarea name="resourceContent" id="resourceContent"  class="form-control" rows="15" style="font-family:Courier New;"><?php echo $this->view->resource->content; ?></textarea>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade in voffset3" id="urls">
                                            <div class="col-md-12">
                                                <label for="resourceUrls"><strong><?php _e('Urls', $this->view->pluginInfo->name); ?></strong></label>                                
                                                <textarea name="resourceUrls" id="resourceUrls"  class="form-control" rows="8" style="font-family:Courier New;"><?php echo stripslashes($this->view->resource->urls); ?></textarea>
                                                <p>The above field you can specify the urls in your code will take effect. It can be specified the complete url or just part of it. If you type a line with 'some-content' your code will run on all urls who contain the text 'some-content'. You can also use regular expressions.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xs-12 voffset3">
                                        <button name="submit" type="submit" class="btn btn-success pull-right" >
                                            <span class="glyphicon glyphicon-floppy-disk"></span>
                                            <?php _e('Save', $this->view->pluginInfo->name); ?>
                                        </button>
                                        <a class="btn btn-default" href="admin.php?page=<?php echo $this->view->pluginInfo->name ?>" >
                                            <span class="glyphicon glyphicon-arrow-left"></span>
                                            <?php _e('Back', $this->view->pluginInfo->name); ?>
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php include 'panel.php'; ?>
                </div> 
            </div> 
        </div> 
        <?php
    }
}
