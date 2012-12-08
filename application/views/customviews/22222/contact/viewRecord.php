    <!-- Start the contact_record section -->
    <?php 
        echo form_open('contact/update');
        echo $this->data['pageSetup']['contactSection']; 
        //form_hidden('rID', $this->uri->segment(3, NULL));       
        echo '<label>Input Poscode</label><div class="input">' . form_input('postcode') . '<div>';
        echo '<SCRIPT LANGUAGE=JAVASCRIPT SRC="http://services.postcodeanywhere.co.uk/popups/javascript.aspx?account_code=build11129&license_key=ez72-up95-xn18-hc12"></SCRIPT>';
        echo form_input('address1');
        echo form_input('address2');
               
         echo form_input('city');
         ?>
    
    <?php
        echo form_submit('submit', 'Save');
        echo form_close();
        ?>
    <!-- End the contact_record section -->
