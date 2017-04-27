<?php

	class qa_html_theme_layer extends qa_html_theme_base {
		
		function head_script() // change style of WYSIWYG editor to match theme better
		{
			qa_html_theme_base::head_script();

			$firstrequest=strtolower(qa_request_part(0));
			if (empty($firstrequest) || $firstrequest != 'admin') return;

			if(!qa_opt('ckeditor4_admin_enable')) return;
			$targets = trim(qa_opt('ckeditor4_admin_target'));
			if($targets == '') return;
			
			$uploadimages = qa_opt('ckeditor4_upload_images');
			$uploadall = $uploadimages && qa_opt('ckeditor4_upload_all');
			$configstr = 
				"qa_ckeditor4_config={toolbar:[".str_replace(array("\r\n","\n","\r"), '', qa_opt('ckeditor4_admin_toolbar'))."]".
				", defaultLanguage:".qa_js(qa_opt('site_language')).
				", skin:".qa_js(qa_opt('ckeditor4_admin_skin')).
				", ".str_replace(array("\r\n","\n","\r"), '', qa_opt('ckeditor4_admin_config')).
				($uploadimages ? (", filebrowserImageUploadUrl:".qa_js(qa_path('ckeditor4-upload', array('qa_only_image' => true)))) : "").
				($uploadall ? (", filebrowserUploadUrl:".qa_js(qa_path('ckeditor4-upload'))) : "").
				"}";

			$targets = explode(',', $targets);
			$replacescript = '<SCRIPT TYPE="text/javascript"><!--' . "\n";
			$replacescript .= $configstr . "\n";
			$replacescript .= '$(function(){' . "\n";
			foreach($targets as $target) {
				//$replacescript .= "if($('#".$target."').size()>0){CKEDITOR.replace('" . $target ."',window.qa_ckeditor4_config);}" . "\n";				
				$replacescript .= "if($('.qa-main textarea[name=".$target."]').size()>0){CKEDITOR.replace('" . $target ."',window.qa_ckeditor4_config);}" . "\n";				
			}
			$replacescript .= '});' . "\n";
			$replacescript .= '//--></SCRIPT>';
			
			$this->output('<SCRIPT SRC="'.qa_html(qa_path_to_root().'qa-plugin/q2a-ckeditor4-admin/ckeditor4/ckeditor.js').'" TYPE="text/javascript"></SCRIPT>');
			$this->output($replacescript);
		}
	}
	

/*
	Omit PHP closing tag to help avoid accidental output
*/