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

<?php echo $this->Html->link('Domain List', array('action' => 'index'))?>
<br>
<br>
<?php echo $this->Form->create('Domain');?>
<b><?php echo $this->Form->label('domain', $this->request->data['Domain']['domain']);?></b>
<?php echo $this->Form->input('active', array('label' => "Activate", "type" => 'checkbox'));?>
<div class="submit actions">
<?php echo $this->Form->submit('Update', array('div' => false));?>
<ul>
	<li>
		<?php echo $this->Html->link('Delete', array('action' => 'delete', $this->request->data['Domain']['id']), array('class' => 'deleteButton'));?>
	</li>
</ul>

</div>
<?php echo $this->Form->end();?>