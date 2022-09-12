<?php
class ArrayManage {
	public $ArrayMain = array ();
	public $ArrayMain_KeyField;
	public $ArrayMain_ParentField;
	public $ArrayMain_JoinedField;
	
	public $ArrayDependent = array ();
	public $ArrayDependent_KeyField;
	public $ArrayDependent_DependentField;
	
	public $ArrayDependent_JoinedFields = array ();
	
	private $MerjedArray = array ();
	public function merge_arrays ($array_main, $array_dependent) {
		$this -> ArrayMain = $array_main;
		$this -> ArrayDependent = $array_dependent;
		$this -> MerjedArray = $this -> ArrayMain;
		foreach ($this -> ArrayMain as $key => $value) {
			foreach ($this -> ArrayDependent as $key_dependent => $value_dependent) {
				if ( $value[$this -> ArrayMain_ParentField] == $value_dependent[$this -> ArrayDependent_DependentField]) 
				{
					//echo "<br> ".$value[$this -> ArrayMain_ParentField];
					$array_joined_fields = array ();
					foreach ($this->ArrayDependent_JoinedFields as $Joined_fields) {
						$array_joined_fields[$Joined_fields] = $value_dependent[$Joined_fields];
					} 
					$this -> MerjedArray[$key][$this -> ArrayMain_JoinedField] = $array_joined_fields;
				} else {
					
				}
			}
			//ok $this -> MerjedArray[$key][$this -> ArrayMain_JoinedField] = $this ->ArrayDependent_KeyField;
				 
				
				//$this -> ArrayDependent[$this -> ArrayDependent[$this ->ArrayDependent_KeyField]][$this->ArrayDependent_JoinedFields[0]];
				//ok echo "<br>".$this->ArrayDependent_JoinedFields[0];
		}
		return $this -> MerjedArray;
	}
}
?>