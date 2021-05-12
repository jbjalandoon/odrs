<?php
if (! function_exists('buttons'))
{
	function buttons($permissions, $functions, $link, $id = null)
	{
		foreach ($permissions as $permission) {
			foreach ($functions as $key => $value) {
				if ($value == $permission['slug']) {
					if ($permission['type_slug'] == 'add') {
						echo '<a href="'.$link.'/add" class="float-end btn"> Add </a>';
					}
					elseif ($permission['type_slug'] == 'edit') {
						echo '<a href="'.$link.'/edit/'.$id.'" class="btn btn-edit btn-sm"><i class="fas fa-edit"></i> Edit </a> ';
					}
					elseif ($permission['type_slug'] == 'delete') {
						echo '<a href="'.$link.'/delete/'.$id.'" class="btn btn-delete btn-sm"><i class="fas fa-trash-alt"></i> Delete </a> ';
					} else {
						echo "Other Function";
					}
				}
			}
		}
	}
}
