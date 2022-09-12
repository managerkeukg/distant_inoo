<?php
class UserAccess

{
	public $table_prefix; public $user_prefix;
	private $modules="0"; public $blocks; private $user_permissions_array;
	public $blocks_modules_array; private $id_user;
	
	public  function showUserModules($array) { 
	    $this->id_user= trim($array['user']);
		//$this->user_permissions_array=$array['perm_array'];
	    //or use this instead above 
		$this->getUserPermissions();
		///echo "<pre> USER PERMISSIONS"; print_r($this->user_permissions_array) ; echo "</pre>";
        if (empty($this->modules)) {
			$this->getModules();  
			/// echo "<pre> ALL MODULES "; print_r($this->modules) ; echo "</pre>";
		}
		$this->getBlocks();   ///echo "<pre> ALL BLOCKS "; print_r($this->blocks) ; echo "</pre>";
		
		foreach ($this->blocks as $key => $value) { 
			foreach ($this->modules as $key1 => $value1) {
				if ($value1['blocks']==$key) 
				{ 
					$blocks_modules_array[$key]['modules'][$key1]=$key1;
			    } else {}
			}
		    //$new_array[$value['blocks']]['modules'][] = $value;
		}
		$this->blocks_modules_array=$blocks_modules_array;
		//echo "<pre> ALL BLOCKS "; print_r($new_array) ; echo "</pre>";
		///echo "<pre> Permissions "; print_r($permissions) ; echo "</pre>";
		
		$this->ShowModules();
		///echo "<BR><BR><BR><BR><BR><BR><pre> USER PERMISSIONS "; print_r($this->user_permissions_array) ; echo "</pre>";
        //echo "<BR><BR><BR><BR><BR><BR><pre> blocks modules "; print_r($blocks_modules_array) ; echo "</pre>";
        
   }
   
   
	public  function ShowModules() {
		if (isset($this->user_permissions_array) AND (!empty($this->user_permissions_array))  AND (isset($this->modules) )  AND (!empty($this->modules))   ) 
        {
			foreach ($this->blocks as $key =>$value)
            { 
				?>
				<br>
				<div class="grid_3 blq-navegacion-lateral">	
					<div class="caixa">
						<ul>
							<li class="titulo" ><?php echo $value['name']; ?></li>
							<?php 
							foreach ($this->blocks_modules_array[$key]['modules'] as $key1 => $value1) 
							{  
								if (isset($this->user_permissions_array[$value1])) {
									?>
									<li>
										<a href="../<?php echo	$this->modules[$value1]['path']; ?>/">
											<img src="../../common_data/images/icons/list.jpg"> <?php echo $this->modules[$value1]['name'] ?>
										</a>
									<?php 
								}
							}
							?>
						</ul>
					</div>
				</div>
				<?php
            }
        } else {}
	}
   
	public  function getUserPermissions($id_user) {
		$this->id_user=$id_user;
		$query = "SELECT * FROM `".$this->table_prefix.$this->user_prefix."_access_user_permissions`
			WHERE `user` = '".$this->id_user."' AND `status`='1' AND ('0' <`permission`<'7');"; 
		$rez= mysql_query($query);
		if(!$rez) exit(mysql_error());
		if(mysql_num_rows($rez) > 0)
		{
			while($array= mysql_fetch_array($rez))
			{
				$permissions_array[$array['module']][$array['permission']]=$array['permission'];
			}
			$this->user_permissions_array = $permissions_array;
			///echo "<BR><BR><BR><BR><BR><BR><pre>USER PERMISSIONS "; print_r($permissions_array) ; echo "</pre>";
			///echo "<BR><BR><BR><BR><BR><BR><pre>USER PERMISSIONS "; print_r($this->user_permissions_array) ; echo "</pre>";
		} else {}
	}
   
	public  function getModules() {
		$query = "SELECT * FROM `".$this->table_prefix.$this->user_prefix."_access_modules`   WHERE `status` = '1'  ";  //echo $query;
		$rez= mysql_query($query);
		if(!$rez) exit(mysql_error());
		if(mysql_num_rows($rez) > 0)
		{
			$modules_array = array();
			while($array= mysql_fetch_array($rez))
			{
				$modules_array[$array['id']]['name']=$array['name'];
				$modules_array[$array['id']]['path']=$array['path'];
				$modules_array[$array['id']]['blocks']=$array['blocks'];
			}
			$this->modules=$modules_array;
		} else { return "";}
	}
   
   
	public  function getBlocks() {
		$query = "SELECT * FROM `".$this->table_prefix.$this->user_prefix."_blocks`   WHERE `status` = '1'  ORDER BY `order`";  //echo $query;
		$rez= mysql_query($query);
		if(!$rez) exit(mysql_error());
		if(mysql_num_rows($rez) > 0)
		{
			while($array= mysql_fetch_array($rez))
			{
				$blocks_array[$array['id']]['name']=$array['name'];
			}
		} else { }
		$blocks_array['0']="Modules";
		$this->blocks=$blocks_array;	
	} // end function

} // end class
?>