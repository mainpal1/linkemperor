<?php echo $this->Html->link('Domain List', array('action' => 'index'))?>

<?php echo $this->Form->create('Domain');?>
<?php echo $this->Form->input('domain');?>
<?php echo $this->Form->input('needs_article', array('label' => "Needs Article", "type" => 'checkbox'));?>
<?php echo $this->Form->end('Create');?>