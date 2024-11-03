<fieldset>
    <div class="form-group">
        <label for="name">Name *</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($edit ? $customer['name'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Name" class="form-control" required="required" id="name">
    </div>

    <div class="form-group">
        <label for="description">Description *</label>
        <textarea name="description" placeholder="Address Line 1" class="form-control" id="description"><?php echo htmlspecialchars(($edit) ? $customer['description'] : '', ENT_QUOTES, 'UTF-8'); ?></textarea>
    </div>

    <div class="form-group">
        <label for="price">Price *</label>
        <input type="text" name="price" value="<?php echo htmlspecialchars($edit ? $customer['price'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Price" class="form-control" required="required" id="price">
    </div>

    <div class="form-group">
        <label for="stock">Stock *</label>
        <input type="text" name="stock" value="<?php echo htmlspecialchars($edit ? $customer['stock'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Stock" class="form-control" required="required" id="stock">
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
        <select name="category_id" class="form-control selectpicker" required onchange="getSubcategories(this.value)">
            <option value="">Please select the category name</option>
            <?php
            foreach ($opt_arr as $opt) {
                if ($edit && $opt == $customer['category_id']) {
                    $sel = "selected";
                } else {
                    $sel = "";
                }
                echo '<option value="' . $opt['id'] . '" ' . $sel . '>' . $opt['name'] . ' - ' . $opt['gender'] . '</option>';
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label>Subcategory *</label>
        <select name="subcategory_id" id="subcategory_list" class="form-control selectpicker" required>
            <option value="">Please select the subcategory name</option>
        </select>
    </div>

    <script>
        function getSubcategories(category_id) {
            $.ajax({
                url: "get_subcategories.php",
                type: "POST",
                data: {
                    category_id: category_id
                },
                dataType: "html",
                success: function(response) {
                    $("#subcategory_list").html(response);
                }
            });
        }
    </script>

    <div class="form-group">
        <label for="image_url">Image *</label>
        <input type="file" name="image_url" id="image_url">
    </div>

    <div class="form-group text-center">
        <label></label>
        <button type="submit" class="btn btn-warning">Save <span class="glyphicon glyphicon-send"></span></button>
    </div>
</fieldset>