<button title="<?php _e('Edit', GMP_LANG_CODE)?>" type="button" data-marker_id="<?php echo esc_attr($this->marker['id']); ?>" class="button button-small egm-marker-edit" style="margin-right: 5px;" onclick="gmpMarkerEditBtnClick(this); return false;"><i class="fa fa-fw fa-pencil"></i></button><button title="<?php _e('Delete', GMP_LANG_CODE)?>" type="button" data-marker_id="<?php echo esc_attr($this->marker['id']); ?>" class="button button-small egm-marker-remove" onclick="gmpMarkerDelBtnClick(this); return false;"><i class="fa fa-fw fa-trash-o"></i></button>
