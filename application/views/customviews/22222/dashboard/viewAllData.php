<h1>View all data</h1>

<H1>Here is the contact table:</H1>
<?php 
    $this->table->set_heading($this->data['dataSetup']['tableHeadings']['contact']);
    echo $this->table->generate($this->data['records']['contact']); 
    ?>

<H1>Here is the contactAction table:</H1>
<?php 
    $this->table->set_heading($this->data['dataSetup']['tableHeadings']['contactAction']);
    echo $this->table->generate($this->data['records']['contactAction']); 
    ?>

<H1>Here is the contactJoin table:</H1>
<?php 
    $this->table->set_heading($this->data['dataSetup']['tableHeadings']['contactjoin']);
    echo $this->table->generate($this->data['records']['contactjoin']); 
    ?>


