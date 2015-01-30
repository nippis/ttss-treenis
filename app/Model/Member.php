<?php

/**
 * Member model.
 * Links to bands, holds contact information of a user
 * and info about membership fee.
 */
class Member extends AppModel {
   
   public $hasMany = array(
      'BandMembership' => array(
         'className' => 'BandMembership'
      ),
      'MembershipFee' => array(
      	'className' => 'MembershipFee',
      ),
   	  'LoginAccount' => array(
   	    'className' => 'LoginAccount',
   	  ),
   );
   
   public $actsAs = array('Containable');
   
   public $hasAndBelongsToMany = array(
      'Band' => array(
         'className' => 'Band',
         'joinTable' => 'bands_members',
         'foreignKey' => 'member_id',
         'associationForeignKey' => 'band_id',
         'unique' => 'keepExisting'
       ),
   );
   
   // Return an array of bands indexed by Id
   public function getNameListIndexedById() {
   
   	$res = $this->find('all');
   	$ret = array();
   
   	foreach($res as $member) {
   		 
   		$ret[$member['Member']['id']] = $member['Member']['first_name']." ".$member['Member']['last_name'];
   		 
   	}
   
   
   	return $ret;
   
   }
   
}