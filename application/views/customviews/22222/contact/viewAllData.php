<h1>View all data</h1>

<?php if ($this->data['pageSetup']['message']) : ?>
<p><?php echo $this->data['pageSetup']['message']; ?></p>
<?php endif; ?>

<H1>Here is the contact table:</H1>
<?php 
    $this->table->set_heading($this->data['dataSetup']['tableHeadings']['contact']);
    echo $this->table->generate($this->data['records']['contact']); 