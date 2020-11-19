				<div class="content margint30 clear">
					<ol class="breadcrumb">
						<?php 
							$controlURL = (isset($controlURL) ? $controlURL : '');
						?>
						<li class="breadcrumb-item"><a href="<?php echo base_url('xcms-admin/users'); ?>">All</a></li>
						<?php
							foreach ($allusertypes as $records) {
								$types	= str_replace(" ", "_", $records->type);

								// $types	= strtolower($types);
								echo "<li class=\"breadcrumb-item\"><a href=\"".$controlURL.$types."\">".$records->type."</a></li>";
							}
						?>
					</ol>
					<div class="alert margintb15 secret alert-success message-success">Record successfully deleted.</div>
					<div class="alert margintb15 secret alert-danger message-error">Record cannot be deleted.</div>
					<div class="panel panel-default margint20">
						<div class="panel-heading margint0 marginb0 h4">All Users</div>
						<div class="panel-body">

							<table class="table">
								<thead>
									<tr>							
										<th align="center" width="2%">
											<input type="checkbox" name="action" value="" class="flat parent-checkbox">
										</th>
										<th align="center" width="5%">Avatar</th>
										<th align="center" width="18%">Username</th>
										<th align="center" width="20%">Name</th>
										<th align="center" width="15%">Email Address</th>
										<th align="center" width="10%">Role</th>
										<th align="center" width="10%">Status</th>
										<th align="center" width="20%">Actions</th>
									</tr>
								</thead>					
								<tbody>
									
									<?php
										if(empty($alluserrecords)){
											echo "<tr>";
											echo "<td align=\"center\" colspan=\"8\"><strong>No User Records</strong></td>";
											echo "</tr>";
										}else{
											foreach ($alluserrecords as $records) {

												$hashedusername	= md5($records->username);

												$fullName	= $records->fname." ".$records->lname;
												echo "<tr id=".$records->id.">";
												echo "<td align=\"center\"><input type=\"checkbox\" value=\"".$records->id."\" class=\"flat checkbox\" name=\"action\"></td>";
												echo "<td>".getAvatar($fullName, $records->avatar_color)."</td>";
												echo "<td>".$records->username."</td>";					
												echo "<td>".$fullName."</td>";
												echo "<td>".$records->email."</td>";
												echo "<td>".$records->type."</td>";
												echo "<td>".ucfirst($records->status)."</td>";
												echo "<td><a href=\"javascript:void(0)\" class=\"btn btn-info btn-edit\" onClick=\"editUser('".$records->id."')\"><i class=\"fa fa-edit\"></i> Edit</a>&nbsp;<button value=\"".$records->id."\" onclick=\"deleteUser(".$records->id.")\" class=\"btn btn-danger\"><i class=\"fa fa-trash\"></i> Delete</button></td>";
												echo "</tr>";
											}
										}
									?>							
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- Modal -->
				<div class="modal fade bs-example-modal-lg" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content border-radius-0">
							<form name="trionForm" id="trionForm" method="post">
								<div class="modal-header">
									<h4 class="modal-title h4" id="userModalLabel">Add User</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								</div>
								<div class="modal-body">
									<div class="row align-items-center">
										<div class="col-12 col-sm-6">
											<div class="form-group relative">
												<input type="hidden" name="id" id="id" value="">
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text"><i class="fa fa-user"></i></div>
													</div>
													<input type="text" id="username" name="username" class="form-control" value="" placeholder="Username">
												</div>
											</div>
										</div>
										<div class="col-12 col-sm-6 change-pass-block d-none">												
											<button type="button" class="btn btn-light" data-toggle="modal" data-target="#userPasswordModal">Change Password</button>
										</div>
									</div>
									<div class="row align-items-center password-block d-none">
										<div class="col-12 col-sm-6">
											<div class="form-group relative">
												<div class="input-group position-relative">
													<div class="input-group-prepend">
														<div class="input-group-text"><i class="fa fa-address-book"></i></div>
													</div>
													<input type="password" name="password" id="password" class="form-control" value="" placeholder="Password">
													<span class="toggle-password" onclick="togglePassword(new Array('password','verifypassword'), 'toggleEye')">
														<i class="fa fa-eye text-right gg-eye" id="toggleEye" aria-hidden="true"></i>
													</span>
												</div>									
											</div>
										</div>
										<div class="col-12 col-sm-6">
											<div class="form-group relative">
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text"><i class="fa fa-address-book"></i></div>
													</div>
													<input type="password" name="verifypassword" id="verifypassword" class="form-control" value="" placeholder="Verify password">
												</div>									
											</div>
										</div>
									</div>
									<div class="row align-items-center">
										<div class="col-12 col-sm-6">
											<div class="form-group relative">
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text"><i class="fa fa-address-book"></i></div>
													</div>
													<input type="text" name="fname" id="fname" class="form-control" value="" placeholder="First Name">
												</div>									
											</div>
										</div>
										<div class="col-12 col-sm-6">
											<div class="form-group relative">
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text"><i class="fa fa-address-book"></i></div>
													</div>
													<input type="text" name="lname" id="lname" class="form-control" value="" placeholder="Last Name">
												</div>									
											</div>
										</div>
										<div class="col-12 col-sm-6">
											<div class="form-group relative">
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text"><i class="fa fa-envelope"></i></div>
													</div>
													<input type="text" name="email" id="email" class="form-control" value="" placeholder="Email Address">
												</div>									
											</div>
										</div>
										<div class="col-12 col-sm-6">
											<div class="form-group relative">
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text"><i class="fa fa-map-marker"></i></div>
													</div>
													<input type="text" name="address" id="address" class="form-control" value="" placeholder="Address">
												</div>									
											</div>
										</div>
										<div class="col-12 col-sm-6">
											<div class="form-group relative">
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text"><i class="fa fa-map-pin"></i></div>
													</div>
													<input type="text" name="zip_code" class="form-control" value="" placeholder="Zip Code">
												</div>
											</div>
										</div>
										<div class="col-12 col-sm-6">
											<div class="form-group relative">
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text"><i class="fa fa-calendar"></i></div>
													</div>
													<input type="text" name="bdate" class="form-control" id="bdate" value="" placeholder="Date of Birth">
												</div>
											</div>
										</div>
										<div class="col-12 col-sm-6">
											<div class="form-group relative marginb0">
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text"><i class="fa fa-user-circle"></i></div>
													</div>
													<select name="type" id="usertype" class="form-control">
														<option value="-1">User Type</option>
														<?php
															foreach ($allusertypes as $record) {
																echo "<option value=\"".$record->type."\">".$record->type."</option>";
															}
														?>
													</select>
												</div>		
											</div>
										</div>
										<div class="col-12 col-sm-6 status d-none">
											<div class="form-group relative marginb0">
												<label for="status">Status</label>
												<div class="clearfix"></div>
												<div class="radio inline-block">
													<label>
														<input type="radio" class="flat" name="status" value="Active"> Active
													</label>
												</div>
												<div class="radio inline-block">
													<label>
														<input type="radio" class="flat" name="status" value="Inactive"> Inactive
													</label>
												</div>
											</div>
										</div>
									</div>
									<div class="alert margint15 marginb0 secret alert-danger message-duplicate">Username already taken.</div>
									<div class="alert margint15 marginb0 secret alert-success return-message"></div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-light btn-close" data-dismiss="modal">Cancel</button>
									<button type="button" class="btn btn-primary btn-save" onclick="<?php echo $modalBtnOnClickFunction; ?>">Save</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="modal fade" id="userPasswordModal" tabindex="-1" role="dialog" aria-labelledby="userPasswordModalLabel">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content border-radius-0">
							<form name="trionFormforPassword" id="trionFormforPassword" method="post">
								<div class="modal-header">
									<h4 class="modal-title h4" id="userPasswordModalLabel">Update Password</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-12">
											<div class="form-group relative">									
												<label for="password">Old Password</label>
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text"><i class="fa fa-key"></i></div>
													</div>
													<input type="password" name="oldpassword" id="oldpassword" class="form-control" value="" placeholder="**********">
												</div>
											</div>
										</div>
										<div class="col-12">
											<div class="form-group relative">									
												<label for="password">New Password</label>
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text"><i class="fa fa-key"></i></div>
													</div>
													<input type="password" name="password" id="password" class="form-control" value="" placeholder="**********">
												</div>
											</div>
										</div>
										<div class="col-12">
											<div class="form-group relative">
												<label for="verifyPassword">Verify New Password</label>
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text"><i class="fa fa-key"></i></div>
													</div>
													<input type="password" name="verifypassword" id="verifyPassword" class="form-control" value="" placeholder="**********">
												</div>
											</div>
										</div>
									</div>
									<div class="alert margint15 marginb0 secret alert-danger message-error">Password not matched.</div>
									<div class="alert margint15 marginb0 secret alert-success message-success-saved"></div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-light btn-close" data-dismiss="modal">Cancel</button>
									<button type="button" class="btn btn-primary btn-save" onclick="<?php echo $modalBtnOnClickFuncPass; ?>">Save</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div><!--right_col-->
		</div><!--main_container-->
	</div><!--container body-->
