<?php
// FROM HASH: 196902b73fc40206bed11c3c0d1c8410
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Alerts');
	$__finalCompiled .= '
';
	$__templater->setPageParam('uix_myAccountLinks', 'alerts');
	$__finalCompiled .= '

';
	$__templater->wrapTemplate('account_wrapper', $__vars);
	$__finalCompiled .= '

<div class="block">
	<div class="block-container">
		<div class="block-body">
			';
	if (!$__templater->test($__vars['alerts'], 'empty', array())) {
		$__finalCompiled .= '
				<ol class="listPlain">
				';
		if ($__templater->isTraversable($__vars['alerts'])) {
			foreach ($__vars['alerts'] AS $__vars['alert']) {
				$__finalCompiled .= '
					<li data-alert-id="' . $__templater->escape($__vars['alert']['alert_id']) . '"
						class="block-row block-row--separated' . ($__templater->method($__vars['alert'], 'isUnviewed', array()) ? ' block-row--highlighted' : ($__templater->method($__vars['alert'], 'isRecentlyViewed', array()) ? '' : ' block-row--alt')) . '">
						' . $__templater->callMacro('alert_macros', 'row', array(
					'alert' => $__vars['alert'],
				), $__vars) . '
					</li>
				';
			}
		}
		$__finalCompiled .= '
				</ol>
			';
	} else if ($__vars['page'] <= 1) {
		$__finalCompiled .= '
				<div class="block-row">' . 'You do not have any recent alerts.' . '</div>
			';
	} else {
		$__finalCompiled .= '
				<div class="block-row">' . 'No alerts can be shown. Please select a different page.' . '</div>
			';
	}
	$__finalCompiled .= '
		</div>
	</div>

	' . $__templater->func('page_nav', array(array(
		'link' => 'account/alerts',
		'page' => $__vars['page'],
		'total' => $__vars['totalAlerts'],
		'wrapperclass' => 'block-outer block-outer--after',
		'perPage' => $__vars['perPage'],
	))) . '
</div>';
	return $__finalCompiled;
});