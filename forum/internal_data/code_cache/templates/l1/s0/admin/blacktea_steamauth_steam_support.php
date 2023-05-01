<?php
// FROM HASH: a9b08fd6d6f7acf7ecd71186c294bc8b
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Steam Authentication Support');
	$__finalCompiled .= '
<div class="block-container">
	<div class="support-notice formInfoRow">
		<span>If you are having trouble with the add-on, please refrain from asking for support on the discussion thread itself. Troubleshooting can involve sensitive information and other things that are not ideal for public view.</span>
		<span>Instead, we offer support via the following:</span>
		<ul>
			<li>Discord: <a href="https://discord.gg/cUtwu2J" target="_blank">Join server</a></li>
			<li>E-Mail: <a href="mailto:omar@assadi.co.il" target="_blank">omar@assadi.co.il</a></li>
			<li>Slack: <a href="https://join.slack.com/t/s70/shared_invite/enQtMzAyMjM4MTA2MjEwLTJkZTY5YTg4NWIyYzQ5YjJlZmYzMGJlN2Q3YTYwZTRmMjJmMmI3MTVhZDQwYTY0MzEwZDUyMDZjZmMxZmU2ZWQ" target="_blank">Join server</a></li>
			<li>Private Message: <a href="https://xenforo.com/community/conversations/add?to=Assadi,^Alex,dubwub" target="_blank">https://xenforo.com/community/conversations/add?to=Assadi,^Alex,dubwub</a></li>
		</ul>
		<span>To aid the support request, please provide a data export using the form below:</span>
	</div>
	' . $__templater->form('
		<div class="block-body">
			' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'export_addon_setup',
		'selected' => true,
		'label' => 'Setup',
		'_type' => 'option',
	),
	array(
		'name' => 'export_addon_settings',
		'selected' => true,
		'label' => 'Settings',
		'_type' => 'option',
	),
	array(
		'name' => 'export_addon_permissions',
		'selected' => true,
		'label' => 'Permissions',
		'_type' => 'option',
	),
	array(
		'name' => 'export_addon_users',
		'selected' => true,
		'label' => 'Users',
		'_type' => 'option',
	),
	array(
		'name' => 'export_website_configuration',
		'selected' => true,
		'label' => 'Website Configuration',
		'_type' => 'option',
	),
	array(
		'name' => 'export_enabled_addons',
		'selected' => true,
		'label' => 'Enabled Addons',
		'_type' => 'option',
	)), array(
		'label' => 'Export Options',
		'hint' => 'No personally identifiable information or API keys will be exported',
	)) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'icon' => 'export',
		'sticky' => 'true',
	), array(
	)) . '
	', array(
		'action' => '',
		'class' => 'block',
	)) . '
</div>';
	return $__finalCompiled;
});