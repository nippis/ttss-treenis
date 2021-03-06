<?php

/**
 * ConstReservAccount model
 * Represents an owned timeslot.
 * Basically an informative connection model between bands and Slots
 * Has fields is_paid, is_valid (for banning) and year.
 *
 */

class ConstReservAccount extends AppModel {
   
   public $actsAs = array('Containable');
   
   
   public $belongsTo = array(
      // Owned by a band
      'OwnedBy' => array(
         'className' => 'Band',
         'foreignKey' => 'band_id',
         //'associationForeignKey' => 'band_id',
      ),
      // connects to unigue slot
      'OwnsSlot' => array(
         'className' => 'Slot',
         'foreignKey' => 'slot_id',
         //'associationForeignKey' => 'slot_id',
      )
   );
   
   public $hasMany = array(
      //'Reservation'
   );
   
   public function beforeSave($options = array()) {
      
      // if we have a field Slot, change it to slot_id
      
      if($this->data['ConstReservAccount']['Slot']) {
         $this->data['ConstReservAccount']['slot_id'] = $this->data['ConstReservAccount']['Slot'];
      }
      
      
      return true;
   }
   	
   	public function getTimeslotsOfDayBySlotId($day) {
   		$settings = ClassRegistry::init('SystemSetting');
   		$year = $settings->getSystemYearOfDay($day);
   		
   		$ownedslots = $this->find('all', array(
   			'conditions' => array(
   				'ConstReservAccount.year' => $year,
   				'ConstReservAccount.is_paid' => true,
   				'ConstReservAccount.is_valid' => true,
   			),
   		));
   		   		
   		$res = array();
   		
   		foreach($ownedslots as $o) {
    		$res[$o['OwnsSlot']['id']] = $o;
   		}

   		return $res;
   		
   	}

}