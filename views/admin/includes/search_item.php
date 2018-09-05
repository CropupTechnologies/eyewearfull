<div class="row">
    <span><h4 class="text-center">Search Item</h4></span>
    <div class="col-md-6">
        <div class="form-group">
            <label for="item-category">Category</label>
            <select class="form-control" id="item-category" name="item-category">
                <option value="0">Select Item....</option>
                <?php
                foreach ($categories as $cat) {
                    if ($cat['parent_category_id'] == 0) {
                        ?>
                        <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
                        <?php
                    }
                }
                ?>
            </select>
        </div>
    </div>
    <div class="col-md-6"></div>
    <div class="clearfix"></div>
    <div class="col-md-6" >
        <div class="form-group">
            <label for="item-sub-category">Sub Category</label>
            <select class="form-control" id="item-sub-category" name="item-sub-category">
                <option>Select Sub Category..</option>
            </select>
        </div>
    </div>                                
    <div class="col-md-6"></div>
    <div class="clearfix"></div>
    <span class="or">OR</span>
    <div class="vl"></div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="item-code-combo">Item</label>
            <select id="item-code-combo" name="item-code-combo" class="form-control">
                <option>Select Item..</option>
            </select>
        </div>
    </div>     
    <div class="col-md-6">
        <div class="form-group">
            <label for="item-code-txt">Item Code</label>
            <div class="input-group m-b-sm">
                <input type="text" id="item-code-txt" class="form-control search-anim" placeholder="Enter Item Code" style="">
                <span class="input-group-btn">
                    <button class="btn btn-info" id="btn-search-item-code" type="button"><i class="fa fa-search"></i>&nbsp;&nbsp;Search Item</button>
                </span>
            </div>        
        </div>
    </div>
</div>
<div class="item-details-div">
    <div class="row">
        <div class="col-md-12"><h4 class="text-center">Item Details</h4></div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="item-name">Item Name</label>
                <input type="text" class="form-control" id="item-name" name="item-name" readonly="true" placeholder="Name"/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="item-model">Model</label>
                <input type="text" class="form-control" id="item-model" name="item-model" readonly="true" placeholder="Model"/>
            </div>
        </div>                                
        <div class="col-md-12">
            <div class="form-group">
                <label for="item-desc">Description</label>
                <textarea class="form-control" id="item-desc" name="item-desc" readonly="true" placeholder="Description"></textarea>
            </div>
        </div>                                
    </div>
</div>                                

