<?php echo $this->Html->link('<i class="icon icon-home"></i> Home', '/', array('class' => 'btn', 'escape' => false))?>
 <?php echo $this->Html->link('Create Domain', array('action' => 'create'), array('class' => 'btn'))?>

<table>
	<thead>
		<tr>
			<td>Domain Id</td>
			<td>Domain</td>
			<td>Black Listed</td>
			<td>Active</td>
			<td>Needs Article</td>
			<td>Approved</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach($domains as $domain){?>
		<tr>
			<td><?php echo $this->Html->link($domain['Domain']['domain_id'], array('action' => 'edit', $domain['Domain']['id']))?></td>
			<td><?php echo $domain['Domain']['domain']?></td>
			<td><?php echo $domain['Domain']['blacklisted']?'True':'False'?></td>
			<td><?php echo $domain['Domain']['active']?'True':'False'?></td>
			<td><?php echo $domain['Domain']['needs_article']?'True':'False'?></td>
			<td><?php echo $domain['Domain']['approved']?'True':'False'?></td>
		</tr>
		<?php }?>
	</tbody>
</table>
<?php echo $this->element('paginator')?>