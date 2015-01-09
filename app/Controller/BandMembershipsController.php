 
<?php

class BandMembershipsController extends AppController {

    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');
    public $uses = array('Band','Member', 'BandMembership');
    
    public function add($bandId = null) {
      if(!$bandId || !$this->Band->exists($bandId)) {
         throw new NotFoundException(__('Invalid band id'));
      }
      
      if($this->request->is('post') || $this->request->is('put')) {
         $data = $this->request->data;
         $data['BandMembership']['Band'] = $bandId;
         if($this->BandMembership->save($data)) {
            $this->Session->setFlash(__('Member added succesfully'));
            return $this->redirect(array('controller'=>'bands', 'action' => 'view', $bandId));
         }
         $this->Session->setFlash(__('Adding member failed'));
      
      }
      $members = $this->BandMembership->find('available_users_list', array('band' => $bandId));
//       $memberships = $this->BandMembership->find('all', array('conditions' => array('Band.id' => $bandId)));
//       debug($memberships);
//       $members = $this->Member->find('all');
//       debug($members);
      $this->set('members', $members);
      $this->set('band', $this->Band->findById($bandId));

   }
    
}

?>