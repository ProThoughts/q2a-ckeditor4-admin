<?php

class qa_ckeditor4_admin_form {

    var $enable;
    var $targets = array(
		'option_notice_visitor',
		'option_custom_register',
		'option_notice_welcome',
		'option_custom_sidebar',
		'option_custom_sidepanel',
		'option_custom_header',
		'option_custom_footer',
		'option_custom_home_content',
		'option_custom_ask',
		'option_custom_answer',
		'option_custom_comment',
		'content',
	);
    var $row;
	var $toolbar;
	var $config;
	
	function qa_ckeditor4_admin_form() {
		$this->enable = false;
		$this->row = 10;
		$this->toolbar =
			"['Source'],\n".
			"['Undo','Redo'],".
			"['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],\n".
			"['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],\n".
			"['NumberedList','BulletedList','-','Blockquote'],\n".
			"['TextColor','BGColor'],\n".
			"['Cut','Copy','Paste'],\n".
			"['FontSize','Format'],\n".
			"['Link','Unlink','Anchor'],\n".
			"['Image','Flash','Table','HorizontalRule','SpecialChar'],\n".
			"['RemoveFormat','Maximize']";
		$this->config =
			"toolbarCanCollapse:false,\n".
			"removePlugins:'elementspath',\n".
			"resize_enabled:false,\n".
			"autogrow:false,\n".
			"entities:false\n";
    }

	function option_default($option) {
		if ($option=='ckeditor4_admin_enable') return $this->enable;
		if ($option=='ckeditor4_admin_target') return implode(',', $this->targets);
		if ($option=='ckeditor4_admin_skin') return 'moono';
		if ($option=='ckeditor4_admin_toolbar') return $this->toolbar;
		if ($option=='ckeditor4_admin_config') return $this->config;
	}
	
	function admin_form(&$qa_content) {
		$saved=false;
		if (qa_clicked('ckeditor4_admin_save_button')) {
			qa_opt('ckeditor4_admin_enable',(int)qa_post_text('ckeditor4_admin_enable_field'));
			qa_opt('ckeditor4_admin_target',qa_post_text('ckeditor4_admin_target_field'));
			qa_opt('ckeditor4_admin_skin', qa_post_text('ckeditor4_admin_skin_field'));
			qa_opt('ckeditor4_admin_toolbar', qa_post_text('ckeditor4_admin_toolbar_field'));
			qa_opt('ckeditor4_admin_config', qa_post_text('ckeditor4_admin_config_field'));
			$saved=true;
		}
		if (qa_clicked('ckeditor4_admin_default_button')) {
			qa_opt('ckeditor4_admin_enable',$this->enable);
			qa_opt('ckeditor4_admin_target',implode(',', $this->targets));
			qa_opt('ckeditor4_admin_skin','moono');
			qa_opt('ckeditor4_admin_toolbar',$this->toolbar);
			qa_opt('ckeditor4_admin_config',$this->config);
			$saved=true;
		}
		qa_set_display_rules($qa_content, array(
			'ckeditor4_admin_target' => 'ckeditor4_admin_enable_field',
			'ckeditor4_admin_skin' => 'ckeditor4_admin_enable_field',
			'ckeditor4_admin_toolbar' => 'ckeditor4_admin_enable_field',
			'ckeditor4_admin_config' => 'ckeditor4_admin_enable_field',
		));
		return array(
			'ok' => $saved ? qa_lang_html('ckeditor4_admin/setting_saved_message') : null,
			'fields' => array(
				array(
					'label' => qa_lang_html('ckeditor4_admin/option_enable_label'),
					'type' => 'checkbox',
					'value' => (int)qa_opt('ckeditor4_admin_enable'),
					'tags' => 'NAME="ckeditor4_admin_enable_field" ID="ckeditor4_admin_enable_field"',
				),
				array(
					'id' => 'ckeditor4_admin_target',
					'label' => qa_lang_html('ckeditor4_admin/option_target_label'),
					'type' => 'textarea',
					'value' => qa_opt('ckeditor4_admin_target'),
					'tags' => 'NAME="ckeditor4_admin_target_field"',
					'rows' => $this->row,
				),
				array(
					'id' => 'ckeditor4_admin_skin',
					'type' => 'select',
					'label' => 'Skin:',
					'value' => qa_opt('ckeditor4_admin_skin'),
					'tags' => 'name="ckeditor4_admin_skin_field"',
					'options' => array('moono' => 'moono', 'moono-lisa' => 'moono-lisa', 'moono-dark' => 'moono-dark', 'moonocolor' => 'moonocolor'),
				),
				array(
					'id' => 'ckeditor4_admin_toolbar',
					'label' => 'Toolbar bottons:',
					'type' => 'textarea',
					'value' => qa_opt('ckeditor4_admin_toolbar'),
					'tags' => 'NAME="ckeditor4_admin_toolbar_field"',
					'rows' => 10,
					'note' => str_replace(array("\r\n","\n","\r"), '<BR/>',"Default:\n".$this->toolbar),
				),
				array(
					'id' => 'ckeditor4_admin_config',
					'label' => 'Other configration:',
					'type' => 'textarea',
					'value' => qa_opt('ckeditor4_admin_config'),
					'tags' => 'NAME="ckeditor4_admin_config_field"',
					'rows' => 10,
					'note' => str_replace(array("\r\n","\n","\r"), '<BR/>',"Default:\n".$this->config),
				),
			),
			'buttons' => array(
				array(
					'label' => qa_lang_html('ckeditor4_admin/setting_saved_button_label'),
					'tags' => 'NAME="ckeditor4_admin_save_button"',
				),
				array(
					'label' => qa_lang_html('ckeditor4_admin/setting_default_button_label'),
					'tags' => 'NAME="ckeditor4_admin_default_button"',
				),
			),
		);
	}
}

/*
	Omit PHP closing tag to help avoid accidental output
*/