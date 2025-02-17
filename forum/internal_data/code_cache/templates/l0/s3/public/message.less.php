<?php
// FROM HASH: dc2700c6f5bb3a5fe4d1371032a7950e
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '@_message-actionColumnWidth: 40px;
@_messageSimple-userColumnWidth: 70px;

.message
{
	+ .message,
	&.message--bordered
	{
		border-top: @xf-borderSize solid @xf-borderColor;
	}
}

.message,
.block--messages .message
{
	&.is-mod-selected
	{
		background: @xf-inlineModHighlightColor;

		.message-cell--user
		{
			background: @xf-inlineModHighlightColor;
		}

		.message-userArrow:after
		{
			border-right-color: @xf-inlineModHighlightColor;
		}
	}
}

.message-inner
{
	display: flex;
}

.message-cell
{
	display: block;
	vertical-align: top;
	padding: @xf-messagePadding;

	.message--quickReply &
	{
		//padding-bottom: 35px; // for the submit row

		> .formRow:last-child
		{
			> dd
			{
				padding-bottom: 0;
			}
		}
	}

	&.message-cell--closer
	{
		padding: @xf-messagePaddingSmall;


		&.message-cell--user
		{
			.m-fixedWidthFlex((@xf-messageUserBlockWidth) + 2 * (@xf-messagePaddingSmall));

			.message--simple &
			{
				.m-fixedWidthFlex(@_messageSimple-userColumnWidth + 2 * (@xf-messagePaddingSmall));
			}
		}

		&.message-cell--action
		{
			.m-fixedWidthFlex((@_message-actionColumnWidth) + 2 * (@xf-messagePaddingSmall));
		}
	}

	&.message-cell--user,
	&.message-cell--action
	{
		position: relative;
		.xf-messageUserBlock(no-border);
		border-right: @xf-messageUserBlock--border-width solid @xf-messageUserBlock--border-color;
		min-width: 0;
	}

	&.message-cell--user
	{
		.m-fixedWidthFlex((@xf-messageUserBlockWidth) + 2 * (@xf-messagePadding));

		.message--simple &
		{
			.m-fixedWidthFlex(@_messageSimple-userColumnWidth + 2 * @xf-messagePaddingSmall);
			// width: auto;
			// min-width: auto;
			// background: none;
			// border: none;
			padding-right: 0;
		}
	}

	&.message-cell--action
	{
		.m-fixedWidthFlex((@_message-actionColumnWidth) + 2 * (@xf-messagePadding));
	}

	&.message-cell--main
	{
		flex: 1 1 auto;
		width: 100%;
		// display: flex;
		min-width: 0;
		.xf-uix_messageMain();

		&.is-editing
		{
			padding: 0;
		}

		.block
		{
			margin: 0;
		}

		.block-container
		{
			margin: 0;
			border: none;
		}
	}

	&.message-cell--alert
	{
		font-size: @xf-fontSizeSmall;
		flex: 1 1 auto;
		width: 100%;
		min-width: 0;
		.xf-contentAccentBase();

		a
		{
			.xf-contentAccentLink();
		}
	}

	&.message-cell--extra
	{
		.m-fixedWidthFlex(180 + 2 * (@xf-messagePadding));
		border-left: @xf-messageUserBlock--border-width solid @xf-messageUserBlock--border-color;
		background: @xf-contentAltBg;

		.formRow-explain
		{
			margin: @xf-paddingMedium 0 0;
			.xf-formExplain();
			.m-textColoredLinks();
			font-size: 80%;
		}
	}
}

.message-main
{
	height: 100%;
	display: flex;
	flex-direction: column;
	width: 100%;
	min-width: 0;
}

.message-content
{
	flex: 1 1 auto;

	// IE11 flex bug
	min-height: 1px;
	max-width: 100%;
}

.message-footer
{
	margin-top: auto;
}

form.message--simple .message-cell--main {
	flex-direction: column;
	padding: @xf-paddingLarge;
}

.message--quickReply .message-cell--main {
	flex-direction: column;
	padding: @xf-messagePadding;
}

@media (max-width: @xf-messageSingleColumnWidth)
{
	.message:not(.message--forceColumns)
	{
		.message-inner
		{
			display: block;
		}

		.message-cell
		{
			display: block;
			.m-clearFix();

			&.message-cell--user
			{
				width: auto;
				border-right: none;
				border-bottom: @xf-messageUserBlock--border-width solid @xf-messageUserBlock--border-color;
			}

			&.message-cell--main
			{
				// padding-left: @xf-messagePadding;
			}

			&.message-cell--extra
			{
				width: auto;
				border-left: none;
				border-top: @xf-messageUserBlock--border-width solid @xf-messageUserBlock--border-color;
			}
		}
	}

	.message--simple:not(.message--forceColumns),
	.message--quickReply:not(.message--forceColumns)
	{
		.message-cell.message-cell--user
		{
			display: none;
		}
	}
}

// ######################## USER COLUMN #########################

.message-userArrow
{
	position: absolute;
	top: (@xf-messagePadding) * 2;
	right: -1px;

	.m-triangleLeft(xf-default(@xf-messageUserBlock--border-color, transparent), @xf-messagePadding);

	';
	if ($__templater->func('property', array('uix_removeMessageArrow', ), false)) {
		$__finalCompiled .= '
	display: none;
	';
	}
	$__finalCompiled .= '

	&:after
	{
		position: absolute;
		top: -(@xf-messagePadding - 1px);
		right: -@xf-messagePadding;
		content: "";

		';
	if ($__templater->func('property', array('uix_messageMain--background-color', ), false)) {
		$__finalCompiled .= '
			.m-triangleLeft(@xf-uix_messageMain--background-color, @xf-messagePadding - 1px);
		';
	} else {
		$__finalCompiled .= '
			.m-triangleLeft(xf-default(@xf-contentBg, transparent), @xf-messagePadding - 1px);
		';
	}
	$__finalCompiled .= '
	}
}


.message-avatar
{
	text-align: center;

	.avatar
	{
		vertical-align: bottom;
		max-width: @xf-messageUserBlockWidth;
		max-height: @xf-messageUserBlockWidth;
	}
}

.message-avatar-wrapper
{
	position: relative;
	display: inline-block;
	vertical-align: bottom;
	margin-bottom: .5em;

	.message-avatar-online
	{
		position: absolute;

		// center bottom position
		left: 50%;
		margin-left: -.615em;
		bottom: -.5em;

		&:before
		{
			.m-faBase();
			.m-faContent(@fa-var-user-circle);
			line-height: 1;
			font-weight: bold;
			color: rgb(127, 185, 0);
			background: @xf-contentBg;
			border: @xf-contentBg solid 2px;
			background: @xf-uix_message--background-color;
			border-color: @xf-uix_message--background-color;
			background: @xf-messageUserBlock--background-color;
			border-color: @xf-messageUserBlock--background-color;
			border-radius: 50%;
			display: inline-block;
		}
	}
}

.message-name
{
	font-weight: @xf-fontWeightHeavy;
	font-size: inherit;
	text-align: center;
	margin: 0;
}

.message-userTitle
{
	font-size: @xf-fontSizeSmaller;
	font-weight: normal;
	text-align: center;
	margin: 0;
}

.message-userBanner.userBanner
{
	@media (min-width: @xf-messageSingleColumnWidth) {
		display: block;
	}
	margin-top: 3px;
}

.message-userExtras
{
	// margin-top: 3px;
	font-size: @xf-fontSizeSmaller;

	';
	if ($__templater->func('property', array('uix_postBitIcons', ), false)) {
		$__finalCompiled .= '
		dl.pairs dt:after {content:\'\';}

	.pairs {

		display: flex;
		align-items: center;

		i {font-size: 18px;}

		dd {
			min-width: 0;
			max-width: 100%;
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
			text-align: left;
		}
	}


	';
	}
	$__finalCompiled .= '
}

.message--deleted
{
	.message-userDetails
	{
		display: none;
	}

	.message-avatar .avatar
	{
		.m-avatarSize(@avatar-s);
	}
}

@media (min-width: @xf-messageSingleColumnWidth) {
	.message-userDetails {text-align: center;}
}

@media (max-width: @xf-messageSingleColumnWidth)
{

	.uix_messagePostBitWrapper {
		display: flex;
		flex-grow: 1;
		flex-direction: column;
		min-width: 0;
		max-width: 100%;
	}

	.message:not(.message--forceColumns)
	{
		.message-userArrow
		{
			top: auto;
			right: auto;
			bottom: -1px;
			left: ((@avatar-s) / 2);

			border: none;
			.m-triangleUp(xf-default(@xf-messageUserBlock--border-color, transparent), @xf-messagePadding);

			&:after
			{
				top: auto;
				right: auto;
				left: -(@xf-messagePadding - 1px);
				bottom: -@xf-messagePadding;

				border: none;
				.m-triangleUp(@xf-contentBg, @xf-messagePadding - 1px);
			}
		}

		&.is-mod-selected
		{
			.message-userArrow:after
			{
				border-color: transparent;
				border-bottom-color: @xf-inlineModHighlightColor;
			}
		}

		.message-user
		{
			display: flex;
		}

		.message-avatar
		{
			margin-bottom: 0;
			.avatar
			{
				.m-avatarSize(@avatar-s);

				& + .message-avatar-online
				{
					left: auto;
					right: 0;
				}
			}
		}

		.message-userDetails
		{
			flex: 1;
			min-width: 0;
			padding-left: @xf-messagePadding;
			width: 100%;
		}

		.message-userExtras {
			display: flex;
			flex-wrap: wrap;
			align-items: center;
			padding-left: @xf-messagePadding;
			padding-top: @xf-paddingSmall;

			.pairs {
				margin-right: @xf-paddingMedium;
				line-height: 1.3;
			}
		}

		.message-name
		{
			text-align: left;
		}

		.message-userTitle,
		.message-userBanner.userBanner
		{
			display: inline-block;
			text-align: left;
			margin: 0;
		}

		.message--deleted
		{
			.message-userDetails
			{
				display: block;
			}
		}
	}
}

// ####################### MAIN COLUMN ####################

.message-content
{
	position: relative;

	.js-selectToQuoteEnd
	{
		height: 0;
		font-size: 0;
		overflow: hidden;
	}

	.message--multiQuoteList &
	{
		min-height: 80px;
		max-height: 120px;
		overflow: hidden;

		.message-body
		{
			pointer-events: none;
		}
	}
}

.message-attribution
{
	color: @xf-textColorMuted;
	font-size: @xf-fontSizeSmaller;
	border-bottom: @xf-borderSize solid @xf-borderColorFaint;
	padding-bottom: 3px;
	// .m-clearFix();
	.xf-uix_messageMeta;

	&.message-attribution--plain
	{
		border-bottom: none;
		font-size: inherit;
		// padding-bottom: 0;
	}

	&.message-attribution--split
	{
		display: flex;
		align-items: flex-end;

		.message-attribution-opposite
		{
			margin-left: auto;
		}
	}
}

.message-attribution-main
{
	float: left;
}

.message-attribution-opposite
{
	float: right;

	&.message-attribution-opposite--list
	{
		display: flex;
		.m-listPlain();

		> li
		{
			margin-left: 14px;

			&:first-child
			{
				margin-left: 0;
			}
		}

		a
		{
			display: inline-block;
			margin: -3px -7px;
			padding: 3px 7px;
		}
	}

	a
	{
		color: inherit;

		&:hover
		{
			text-decoration: none;
			color: @xf-linkHoverColor;
		}
	}
}

.message-attribution-source
{
	font-size: @xf-fontSizeSmaller;
	margin-bottom: @xf-paddingSmall;
}

.message-attribution-user
{
	font-weight: @xf-fontWeightHeavy;

	.avatar
	{
		display: none;
	}

	.attribution
	{
		display: inline;
		font-size: inherit;
		font-weight: inherit;
		margin: 0;
	}
}

.message-newIndicator
{
	.xf-messageNewIndicator();
}

.message-minorHighlight
{
	font-size: @xf-fontSizeSmall;
	color: @xf-textColorFeature;
	padding-left: @xf-messagePadding;
	padding-right: @xf-messagePadding;
}

.message-fields
{
	margin: @xf-messagePadding 0;
	.xf-uix_threadField();
	
	dt, dd {vertical-align: top;}
	
	.pairs dd {display: inline-block;}
}

.message-body
{
	margin: @xf-messagePadding 0;
	font-family: @xf-fontFamilyBody;
	.m-clearFix();
	.xf-uix_messageBody();

	.message--simple &
	{
		// margin-top: @xf-messagePaddingSmall;
		margin-bottom: @xf-messagePaddingSmall;
	}

	&:last-child
	{
		margin-bottom: 0;
	}

	.message-title
	{
		// basically replicates .structItem-title
		font-size: @xf-fontSizeLarge;
		font-weight: @xf-fontWeightNormal;
		margin: 0 0 @xf-messagePadding 0;
		padding: 0;
	}
}

.message-attachments
{
	margin: .5em 0;
	.xf-uix_messageAttachments();
}

	.message-attachments-list
	{
		.m-listPlain();
	}

.message-lastEdit
{
	margin-top: .5em;
	color: @xf-textColorMuted;
	font-size: @xf-fontSizeSmallest;
	text-align: right;
	padding: 0 @xf-messagePadding @xf-messagePadding;
}

.message-signature
{
	margin-top: @xf-messagePadding;
	.xf-messageSignature();
}

.message-actionBar .actionBar-set
{
	// margin-top: @xf-messagePadding;
	font-size: @xf-fontSizeSmall;
	// padding: calc( @xf-messagePadding / 2 );
	.message--simple &
	{
		// margin-top: @xf-messagePaddingSmall;
	}
}

.message .likesBar
{
	// .xf-minorBlockContent();
	// font-size: @xf-fontSizeSmaller;
	margin-top: @xf-messagePadding;
	padding: @xf-messagePaddingSmall;
	.xf-uix_messageLikes();
}

.message .reactionsBar
{
	margin-top: @xf-messagePadding;
	padding: @xf-messagePaddingSmall;
	.xf-uix_messageLikes();
}

.message-historyTarget
{
	margin-top: @xf-messagePadding;
}

.message-gradient
{
	position: absolute;
	bottom: 0;
	left: 0;
	right: 0;
	height: 60px;

	.m-gradient(fade(@xf-contentBg, 0%), @xf-contentBg, @xf-contentBg, 0%, 90%);
}

.message-responses
{
	margin-top: @xf-messagePaddingSmall;
	font-size: @xf-fontSizeSmall;

	.editorPlaceholder
	{
		.input
		{
			font-size: inherit;
		}
	}
}

.message-responseRow
{
	margin-top: -@xf-minorBlockContent--border-width;
	.xf-minorBlockContent();
	padding: @xf-messagePadding;

	// note that border radiuses are very difficult to do here due to a lot of dynamic showing/hiding

	&.message-responseRow--likes,
	&.message-responseRow--reactions
	{
		.m-transitionFadeDown();
	}
}



@media (max-width: @xf-messageSingleColumnWidth)
{
	.message:not(.message--forceColumns)
	{
		.message-attribution-user .avatar
		{
			display: inline-flex;
			.m-avatarSize((@xf-fontSizeNormal) * (@xf-lineHeightDefault));
		}

		.message-content
		{
			// this is 1px to workaround an IE11 issue - see #139187
			min-height: 1px;
		}
	}
}

@media (max-width: @xf-responsiveNarrow)
{
	.message-signature
	{
		display: none;
	}
}

// MESSAGE MENU

.message-menuGroup
{
	display: inline-block;
}

.message-menuTrigger
{
	display: inline-block;

	&:after
	{
		.m-menuGadget(); // 1em
		text-align: right;
	}

	&:hover:after
	{
		color: black;
	}
}

.message-menu-section
{
	&--editDelete
	{
		.menu-linkRow
		{
			font-weight: @xf-fontWeightHeavy;
			font-size: @xf-fontSizeNormal;
		}
	}
}

.message-menu-link
{
	&--delete i:after
	{
		.m-faContent(@fa-var-trash-alt);
	}
	&--edit i:after
	{
		.m-faContent(@fa-var-edit);
	}
	&--report i:after
	{
		.m-faContent(@fa-var-frown);
	}
	&--warn i:after
	{
		.m-faContent(@fa-var-exclamation-triangle);
	}
	&--spam i:after
	{
		.m-faContent(@fa-var-ban);
	}
	&--ip i:after
	{
		.m-faContent(@fa-var-sitemap);
	}
	&--history i:after
	{
		.m-faContent(@fa-var-history);
	}
	&--follow i:after
	{
		.m-faContent(@fa-var-user-plus);
	}
	&--ignore i:after
	{
		.m-faContent(@fa-var-user-times);
	}
	&--share i:after
	{
		.m-faContent(@fa-var-share-alt);
	}
}

// ############################# COMMENTS ###############

.comment
{
}

.comment-inner
{
	display: table;
	table-layout: fixed;
	width: 100%;
}

.comment-avatar
{
	display: table-cell;
	width: 24px;
	vertical-align: top;

	.avatar,
	img
	{
		vertical-align: bottom;
	}
}

.comment-main
{
	display: table-cell;
	padding-left: @xf-messagePadding;
	vertical-align: top;
}

.comment-contentWrapper
{
	margin-bottom: @xf-messagePaddingSmall;
}

.message-responses .comment-actionBar.actionBar {padding: 0;}

.message-responses .comment-actionBar .actionBar-set.actionBar-set--internal {padding: 0;}

.comment-user
{
	font-weight: @xf-fontWeightHeavy;
}

.comment-body
{
	display: inline;
}

.comment-input
{
	display: block;
	height: 2.34em;
	margin-bottom: @xf-messagePaddingSmall;
}

.comment-actionBar .actionBar-set
{
	// margin-top: @xf-messagePaddingSmall;
	color: @xf-textColorMuted;
}

.comment-likes,
.comment-reactions
{
	.m-transitionFadeDown();

	margin-top: @xf-messagePaddingSmall;
	font-size: @xf-fontSizeSmaller;
}

// ######################### ACTION BAR #######################

.actionBar
{
	.m-clearFix();
	.xf-uix_messageActionBar();
}

.actionBar-set
{
	&.actionBar-set--internal
	{
		float: left;
		margin-left: -3px;

		> .actionBar-action:first-child
		{
			margin-left: 0;
		}
	}

	&.actionBar-set--external
	{
		float: right;
		margin-right: -3px;

		> .actionBar-action:last-child
		{
			margin-right: 0;
		}
	}
}

// ################################## MESSAGE QUICK REPLY ADDITIONS #############

.formSubmitRow.formSubmitRow--messageQr
{
	.formSubmitRow-controls
	{
		text-align: center;
		padding-left: 0;
		padding-right: 0;
		margin-left: @xf-messagePadding;
		margin-right: @xf-messagePadding;

		@media (max-width: @xf-formResponsive)
		{
			text-align: right;
		}

		.menu & {text-align: right;}
	}
}

// ################################## MESSAGE NOTICES #############################

.messageNotice
{
	margin: @xf-messagePaddingSmall 0;
	padding: @xf-messagePaddingSmall @xf-messagePadding;
	.xf-contentAccentBase();
	font-size: @xf-fontSizeSmaller;
	border-left: @xf-borderSizeMinorFeature solid @xf-borderColorAttention;
	.xf-uix_messageNotice();

	&.messageNotice--nested
	{
		border-left-width: @xf-borderSize;
	}

	&:not(.messageNotice--highlighted)
	{
		a,
		a:hover
		{
			.xf-contentAccentLink();
		}
	}

	&:before
	{
		display: inline-block;
		.m-faBase();
		padding-right: .2em;
		font-size: 125%;
		color: @xf-textColorAttention;
		vertical-align: middle;
		font-size: @xf-uix_iconSize !important;
	}

	&.messageNotice--highlighted
	{
		.xf-contentHighlightBase();
		border-left-color: @xf-borderColorFeature;

		&:before
		{
			color: @xf-textColorFeature;
		}
	}

	&.messageNotice--deleted:before { .m-faContent(@fa-var-trash-alt, .79em); ' . $__templater->callMacro('uix_icons.less', 'content', array(
		'icon' => 'delete',
	), $__vars) . '}
	&.messageNotice--moderated:before { .m-faContent(@fa-var-shield, .72em); ' . $__templater->callMacro('uix_icons.less', 'content', array(
		'icon' => 'moderate',
	), $__vars) . '}
	&.messageNotice--warning:before { .m-faContent(fa-var-exclamation-triangle, 1em); ' . $__templater->callMacro('uix_icons.less', 'content', array(
		'icon' => 'warning',
	), $__vars) . '}
	&.messageNotice--ignored:before { .m-faContent(@fa-var-microphone-slash, .79em); ' . $__templater->callMacro('uix_icons.less', 'content', array(
		'icon' => 'ignored',
	), $__vars) . '}
}

// ##################### MESSAGE VARIANTS/RESPONSIVE ##################

@media (min-width: @xf-responsiveEdgeSpacerRemoval)
{
	.block:not(.block--messages)
	{
		@{block-noStripSel} > .block-body:first-child > .message:first-child,
		.block-topRadiusContent.message,
		.block-topRadiusContent > .message:first-child
		{
			.message-cell:first-child { border-top-left-radius: @block-borderRadius-inner; }
			.message-cell:last-child { border-top-right-radius: @block-borderRadius-inner; }
		}

		@{block-noStripSel} > .block-body:last-child > .message:last-child,
		.block-bottomRadiusContent.message,
		.block-bottomRadiusContent > .message:last-child
		{
			.message-cell:first-child { border-bottom-left-radius: @block-borderRadius-inner; }
			.message-cell:last-child { border-bottom-right-radius: @block-borderRadius-inner; }
		}
	}
}

.block--messages, .js-quickReply
{
	.block-container
	{
		background: none;
		border: none;
		box-shadow: none;
		border-radius: 0;
		overflow: visible;
		padding: 0;
	}

	.message,
	.block-row
	{
		.xf-contentBase();
		.xf-blockBorder();
		border-radius: @xf-blockBorderRadius;

		.xf-uix_message();

		+ .message,
		+ .block-row
		{
			margin-top: @xf-blockPaddingV;
		}
	}

	.message-spacer
	{
		+ .message,
		+ .block-row
		{
			margin-top: @xf-blockPaddingV;
		}
	}

	.message-cell
	{
		&:first-child
		{
			border-radius: 0;
			border-top-left-radius: @block-borderRadius-inner;
			border-bottom-left-radius: @block-borderRadius-inner;
		}

		&:last-child
		{
			border-radius: 0;
			border-top-right-radius: @block-borderRadius-inner;
			border-bottom-right-radius: @block-borderRadius-inner;
		}

		&:first-child:last-child
		{
			border-radius: @block-borderRadius-inner;
		}
	}

	@media (max-width: @xf-messageSingleColumnWidth)
	{
		.message:not(.message--forceColumns)
		{
			.message-cell
			{
				&:first-child
				{
					border-radius: 0;
					border-top-left-radius: @block-borderRadius-inner;
					border-top-right-radius: @block-borderRadius-inner;
				}

				&:last-child
				{
					border-radius: 0;
					border-bottom-left-radius: @block-borderRadius-inner;
					border-bottom-right-radius: @block-borderRadius-inner;
				}

				&:first-child:last-child
				{
					border-radius: @block-borderRadius-inner;
				}
			}
		}

		.message--simple:not(.message--forceColumns) .message-cell--user + .message-cell
		{
			border-radius: 0;
			border-top-left-radius: @block-borderRadius-inner;
			border-top-right-radius: @block-borderRadius-inner;
		}
	}

	@media (max-width: @xf-responsiveEdgeSpacerRemoval)
	{
		.message,
		.block-row
		{
			border-left: none;
			border-right: none;
			border-radius: 0;
		}

		.message-cell
		{
			border-radius: 0;

			&:first-child,
			&:last-child
			{
				border-radius: 0;
			}
		}

		.message--simple .message-cell--user + .message-cell
		{
			border-radius: 0;
		}

		.message-container
		{
			padding: @xf-paddingMedium 0 0 0;

			.message-container-header
			{
				text-align: center;
			}

			.message
			{
				border-bottom: 0;
			}
		}
	}
}';
	return $__finalCompiled;
});