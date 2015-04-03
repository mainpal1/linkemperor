<?php echo $this->Html->link('<i class="icon icon-home"></i> Home', '/', array('class' => 'btn', 'escape' => false))?>
 <?php echo $this->Html->link('Domain List', array('action' => 'index'), array('class' => 'btn'))?>

<?php echo $this->Form->create('Domain');?>
<?php echo $this->Form->input('domain');?>
<?php echo $this->Form->input('needs_article', array('label' => "Needs Article", "type" => 'checkbox'));?>
<?php echo $this->Form->submit('Create', array('div' => false, 'class' => 'btn btn-success'))?>
<?php echo $this->Form->end();?>