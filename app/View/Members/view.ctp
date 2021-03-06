<div class="separate-block">
<h2><?php 
echo $memberData['Member']['first_name']; 
?> <?php 
echo $memberData['Member']['last_name']; 
?></h2>
<p> Email: <?php echo $memberData['Member']['email']; ?> </p>
<!--  <p> Member of TTYY: <?php //echo $memberData['Member']['ttyy'] ? "Yes" : "No" ?> </p>-->
<p> Access rights:  <?php echo $memberData['Member']['access'] ? "Yes" : "No" ?> </p>

<?php echo $this->Html->link(
   'Edit', array('controller' => 'members', 'action' => 'edit', $memberData['Member']['id'])
); ?>
&nbsp
<?php echo $this->Form->postLink(
   'Delete member', 
   array(
      'controller' => 'members',
      'action' => 'remove',
      $memberData['Member']['id']
   ),
   array(), 
   'This will delete the member '.$memberData['Member']['first_name'].' '.
   $memberData['Member']['last_name'].' and all member relations. '.
   ' Any bands will not be deleted. Confirm deletion of member?'); ?>
</div>
<div class="separate-block">
<h3>This member belongs to following bands</h3>

<?php
echo $this->element('BandList', array('bands' => $memberData['Band']));
?>

</div>

<div class="separate-block">
<h3>Membership fees of this member</h3>
<table>
<tr><th>Year</th><th>Member of TTYY</th><th>Tools</th>
<?php  foreach($membershipFees as $fee): ?>
<tr><td><?php echo $fee['year']?></td><td><?php echo $fee['ttyy'] ? "Yes" : "no" ?></td><td><?php 
echo $this->Form->postLink('Remove', array(
      'controller' => 'MembershipFees',
      'action' => 'remove',
      $fee['id']
   ));
?></td></tr>
<?php endforeach; ?>
</table>
<?php 
echo $this->Html->link('Add Membership fee', array(
		'controller' => 'MembershipFees', 
		'action' => 'add', 
		$memberData['Member']['id']));
?>

</div>