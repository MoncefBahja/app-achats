<fieldset>
    <div class="form-group">
        <label for="name">Name *</label>
          <input type="text" name="name" value="<?php echo htmlspecialchars($edit ? $customer['name'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Name" class="form-control" required="required" id = "name" >
    </div> 

    <div class="form-group">
        <label>Gender * </label>
        <label class="radio-inline">
            <input type="radio" name="gender" value="men" <?php echo ($edit && $customer['gender'] =='men') ? "checked": "" ; ?> required="required"/> Male
        </label>
        <label class="radio-inline">
            <input type="radio" name="gender" value="women" <?php echo ($edit && $customer['gender'] =='women')? "checked": "" ; ?> required="required" id="women"/> Female
        </label>
    </div>

    <div class="form-group text-center">
        <label></label>
        <button type="submit" class="btn btn-warning" >Save <span class="glyphicon glyphicon-send"></span></button>
    </div>            
</fieldset>
