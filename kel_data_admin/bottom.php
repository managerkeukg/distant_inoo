										</div><!-- center -->
									</td>
									<td style="width:17%; vertical-align:top; padding: 0px 3px 15px 20px;">
										<div id="right"  style="width:100%;">
											<?php
											//$right=$_GET['right'];
											if (!empty($right))
											{
												include _DATA_PATH_.$right.'.php' ; 
											}
											else { 
												include _DATA_PATH_."3.php";
											} 
											?>
										</div><!-- right -->
									</td>
								</tr>
							</tbody>
						</table>
						<hr><br>
						<div style="text-align:center; width:100%;">
							<div id="footer" style="text-align:center; padding:25px 0px 25px 0px; background-color:#1A3867;" >
								<p style="color:white;"> Админка<br>
									&nbsp;&nbsp;&nbsp;All Rights Reserved. Since 2010
									<br>+996 555 13-74-00 
								</p> 
							</div>
						</div>
					</div id="content">
				</td>
			</tr>
		</tbody>
		</table>
	</div><!-- all -->	
</body>
</html>