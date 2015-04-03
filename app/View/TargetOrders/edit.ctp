<style>
.deleteButton {
	display: inline;
	font-size: 110%;
	width: auto;
}
form .submit .deleteButton {
	background:#AF5656;
	background-image: -webkit-gradient(linear, left top, left bottom, from(#BF6B6B), to(#823030));
	background-image: -webkit-linear-gradient(top, #BF6B6B, #823030);
	background-image: -moz-linear-gradient(top, #BF6B6B, #823030);
	border-color: #2d6324;
	color: #fff;
	text-shadow: rgba(0, 0, 0, 0.5) 0px -1px 0px;
	padding: 8px 10px;
}
form .submit .deleteButton:hover {
	background: #A15050;
}
.actions ul{display: inline-block; margin-left: 5px;}
</style>
<?php echo $this->Html->link('<i class="icon icon-home"></i> Home', '/', array('class' => 'btn', 'escape' => false))?>
 <?php echo $this->Html->link('Target Order List', array('action' => 'index'), array('class' => 'btn'))?>
<br>
<br>
<?php echo $this->Form->create('TargetOrder');?>
<b><?php echo $this->Form->label('Target', $this->request->data['TargetOrder']['target']);?></b>
<?php echo $this->Form->input('placement_url', array('label' => "Placement URL"));?>
<?php echo $this->Form->submit('Update', array('div' => false, 'class' => "btn btn-success"));?>
 <?php echo $this->Html->link('Delete', array('action' => 'delete', $this->request->data['TargetOrder']['id']), array('class' => 'btn btn-danger'));?>

<?php echo $this->Form->end();?>