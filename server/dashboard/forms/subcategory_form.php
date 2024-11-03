<fieldset>
    <div class="form-group">
        <label for="name">Name *</label>
          <input type="text" name="name" value="<?php echo htmlspecialchars($edit ? $customer['name'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Name" class="form-control" required="required" id = "name" >
    </div>   

    <div class="form-group">
        <label>Category *</label>
            <?php 
                $pdo = getDbInstance();
                $stmt = $pdo->prepare("SELECT * FROM categories");
                $stmt->execute();
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $opt_arr = $res;
            ?>
            <select name="category_id" class="form-control selectpicker" required>
                <option value=" " >Please select the category name</option>
                <?php
                foreach ($opt_arr as $opt) {
                    if ($edit && $opt == $customer['category_id']) {
                        $sel = "selected";
                    } else {
                        $sel = "";
                    }
                    echo '<option value="'.$opt['id'].'"' . $sel . '>' . $opt['name'] . ' - ' . $opt['gender'] . '</option>';
                }

                ?>
            </select>
    </div>  

    <div class="form-group text-center">
        <label></label>
        <button type="submit" class="btn btn-warning" >Save <span class="glyphicon glyphicon-send"></span></button>
    </div>            
</fieldset>
