<?php echo $this->Html->link('<i class="icon icon-home"></i> Home', '/', array('class' => 'btn', 'escape' => false))?>
 <?php echo $this->Html->link('Get Next Target Order', array('action' => 'next'), array('class' => 'btn'))?> <?php echo $this->Html->link('Fetch All Target Orders', array('action' => 'getAll'), array('class' => 'btn'))?>

<style>
table.target tr td div{
	max-height: 100px;
	overflow: hidden;
}
</style>

<table class="target table">
	<thead>
		<tr>
			<td>Target Order Id</td>
			<td>Domain</td>
			<td>Target</td>
			<td>Anchor Text</td>
			<td>Status</td>
			<td>Article Title</td>
			<td>Article Body</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach($targetOrders as $targetOrder){?>
		<tr>
			<td><?php echo $this->Html->link($targetOrder['TargetOrder']['target_order_id'], array('action' => 'edit', $targetOrder['TargetOrder']['id']))?></td>
			<td><?php echo $targetOrder['TargetOrder']['domain']?></td>
			<td><?php echo $targetOrder['TargetOrder']['target']?></td>
			<td><?php echo $targetOrder['TargetOrder']['anchor_text']?></td>
			<td><?php echo $targetOrder['TargetOrder']['status']?></td>
			<td><?php echo $targetOrder['TargetOrder']['article_title']?></td>
			<td><div><?php echo $targetOrder['TargetOrder']['article_body']?></div></td>
		</tr>
		<?php }?>
	</tbody>
</table>
<?php echo $this->element('paginator')?>