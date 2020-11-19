	
	<div class="col-sm-8 col-md-9 col-lg-10 pull-right paddingtb30">
		<h1 class="inline-block margint0 marginb0 h1">User Type: <?php echo $type; ?></h1>
		<a href="/xcms-admin/users" class="btn btn-light source-sans-600 marginl15">Back to Users Page</a>
		<div class="content margint30">
			<div class="panel panel-default margint20">
				<div class="panel-heading margint0 marginb0 h4">All Users</div>
				<div class="panel-body">

					<table class="table">
						<thead>
							<tr>							
								<th align="center" width="2%"><input type="checkbox" value="" class="parent-checkbox" name="action"></th>
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
								foreach ($usertype as $records) {
									$fullName	= $records->fname." ".$records->lname;
									echo "<tr>";
									echo "<td align=\"center\"><input type=\"checkbox\" value=\"".$records->id."\" class=\"checkbox\" name=\"action\"></td>";
									echo "<td>".getAvatar($fullName)."</td>";
									echo "<td>".$records->username."</td>";					
									echo "<td>".$fullName."</td>";
									echo "<td>".$records->email."</td>";
									echo "<td>".$records->type."</td>";
									echo "<td>".ucfirst($records->status)."</td>";
									echo "<td><a href=\"users/edit/".$records->id."\" class=\"btn btn-info btn-edit\">Edit</a>&nbsp;<button value=\"".$records->id."\" onclick=\"deleteUser(".$records->id.")\" class=\"btn btn-danger\">Delete</button></td>";
									echo "</tr>";
								}
							?>							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>