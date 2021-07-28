<?php
if (! function_exists('buttons'))
{
	function buttons($permissions, $functions, $link, $id = null)
	{
		foreach ($permissions as $permission) {
			foreach ($functions as $key => $value) {
				if ($value == $permission['slug']) {
					if ($permission['type_slug'] == 'add') {
						echo '<a href="'.$link.'/add" class="float-end btn btn-add"><i class="fas fa-plus-square"></i> Add </a>';
					}
					elseif ($permission['type_slug'] == 'edit') {
						echo '<a href="'.$link.'/edit/'.$id.'" class="btn btn-edit text-light btn-sm"><i class="fas fa-edit"></i> Edit </a> ';
					}
					elseif ($permission['type_slug'] == 'delete') {
						echo '<a href="'.$link.'/delete/'.$id.'" class="btn btn-delete text-light  btn-sm"><i class="fas fa-trash-alt"></i> Delete </a> ';
					}
					elseif ($permission['type_slug'] == 'restore') {
						echo '<a href="'.$link.'/restore/'.$id.'" class="btn btn-restore text-light  btn-sm"><i class="fas fa-trash-restore"></i> Restore </a> ';
					} else {
						echo "Other Function";
					}
				}
			}
		}
	}
}
