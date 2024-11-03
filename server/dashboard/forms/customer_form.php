<fieldset>
    <div class="form-group">
        <label for="fullname">Full Name *</label>
          <input type="text" name="fullname" value="<?php echo htmlspecialchars($edit ? $customer['fullname'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Full Name" class="form-control" required="required" id = "fullname" >
    </div> 

    <div class="form-group">
        <label for="email">Email *</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($edit ? $customer['email'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Email" class="form-control" required="required" id="email">
    </div> 

    <div class="form-group">
        <label for="password">Password *</label>
        <input type="password" name="password" value="<?php echo htmlspecialchars($edit ? $customer['password'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Password" class="form-control" required="required" id="password">
    </div> 

    <div class="form-group">
        <label for="phone">Phone</label>
            <input type="phone" name="phone" value="<?php echo htmlspecialchars($edit ? $customer['phone'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="+212..." class="form-control"  type="text" id="phone">
    </div> 

    <div class="form-group">
        <label>Date of birth</label>
        <input name="birthdate" value="<?php echo htmlspecialchars($edit ? $customer['birthdate'] : '', ENT_QUOTES, 'UTF-8'); ?>"  placeholder="Birth date" class="form-control"  type="date">
    </div>

    <div class="form-group">
        <label>Gender * </label>
        <label class="radio-inline">
            <input type="radio" name="gender" value="male" <?php echo ($edit && $customer['gender'] =='male') ? "checked": "" ; ?> required="required"/> Male
        </label>
        <label class="radio-inline">
            <input type="radio" name="gender" value="female" <?php echo ($edit && $customer['gender'] =='female')? "checked": "" ; ?> required="required" id="female"/> Female
        </label>
    </div>

    <div class="form-group">
        <label for="address_line_one">Address Line 1</label>
          <textarea name="address_line_one" placeholder="Address Line 1" class="form-control" id="address_line_one"><?php echo htmlspecialchars(($edit) ? $customer['address_line_one'] : '', ENT_QUOTES, 'UTF-8'); ?></textarea>
    </div> 

    <div class="form-group">
        <label for="address_line_two">Address Line 2</label>
          <textarea name="address_line_two" placeholder="Address Line 2" class="form-control" id="address_line_two"><?php echo htmlspecialchars(($edit) ? $customer['address_line_two'] : '', ENT_QUOTES, 'UTF-8'); ?></textarea>
    </div> 
    
    <div class="form-group">
        <label>Country </label>
           <?php $opt_arr = array(
                                "MA" => "Morocco",
                                );
                            ?>
            <select name="country" class="form-control selectpicker" required>
                <option value=" " >Please select your country</option>
                <?php
                foreach ($opt_arr as $opt) {
                    if ($edit && $opt == $customer['country']) {
                        $sel = "selected";
                    } else {
                        $sel = "";
                    }
                    echo '<option value="'.$opt.'"' . $sel . '>' . $opt . '</option>';
                }

                ?>
            </select>
    </div>  

    <div class="form-group">
        <label>Region </label>
           <?php $opt_arr = array(
                                "Béni Mellal-Khénifra",
                                "Casablanca-Settat",
                                "Draa-Tafilalet",
                                "Fès-Meknès",
                                "Guelmim-Oued Noun",
                                "Laâyoune-Sakia El Hamra",
                                "Marrakech-Safi",
                                "Oriental",
                                "Rabat-Salé-Kénitra",
                                "Souss-Massa",
                                "Tanger-Tetouan-Al Hoceima"
                            );
            ?>
            <select name="region" class="form-control selectpicker" required>
                <option value=" " >Please select your region</option>
                <?php
                foreach ($opt_arr as $opt) {
                    if ($edit && $opt == $customer['region']) {
                        $sel = "selected";
                    } else {
                        $sel = "";
                    }
                    echo '<option value="'.$opt.'"' . $sel . '>' . $opt . '</option>';
                }

                ?>
            </select>
    </div>  

    <div class="form-group">
        <label>Region </label>
           <?php $opt_arr = array(
                                "Casablanca",
                                "Rabat",
                                "Fes",
                                "Marrakech",
                                "Tangier",
                                "Agadir",
                                "Meknes",
                                "Oujda",
                                "Kenitra",
                                "Tetouan",
                                "Temara",
                                "Safi",
                                "Mohammedia",
                                "Khouribga",
                                "El Jadida",
                                "Béni Mellal",
                                "Nador",
                                "Taza",
                                "Settat",
                                "Berrechid",
                                "Taourirt",
                                "Oued Zem",
                                "Fkih Ben Salah",
                                "Tiznit",
                                "Youssoufia",
                                "Larache",
                                "Ksar El Kebir",
                                "Guelmim",
                                "Essaouira",
                                "Al Hoceima",
                                "Berrechid",
                                "Errachidia",
                                "Taroudant",
                                "Sidi Slimane",
                                "Sidi Kacem",
                                "Tan-Tan",
                                "Ouarzazate",
                                "Guercif",
                                "Azemmour",
                                "Asilah",
                                "Chefchaouen",
                                "Bouznika",
                                "Fnideq",
                                "Sidi Yahya El Gharb"
                            );

            ?>
            <select name="city" class="form-control selectpicker" required>
                <option value=" " >Please select your city</option>
                <?php
                foreach ($opt_arr as $opt) {
                    if ($edit && $opt == $customer['city']) {
                        $sel = "selected";
                    } else {
                        $sel = "";
                    }
                    echo '<option value="'.$opt.'"' . $sel . '>' . $opt . '</option>';
                }

                ?>
            </select>
    </div> 
    
    <div class="form-group">
        <label for="postalcode">Postal Code</label>
            <input name="postalcode" value="<?php echo htmlspecialchars($edit ? $customer['postalcode'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Postal Code" class="form-control"  type="text" id="postalcode">
    </div> 

    <div class="form-group text-center">
        <label></label>
        <button type="submit" class="btn btn-warning" >Save <span class="glyphicon glyphicon-send"></span></button>
    </div>            
</fieldset>
