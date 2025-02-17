<?php
// FROM HASH: b49f389ae5fec4ffb04cb48a4b3be280
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '.avatarControl
{
}

.avatarControl-preview
{
	display: block;
	float: left;
	position: relative;

	img
	{
		display: inline-block;
		position: relative;
	}
}

.avatarControl-inputs
{
	margin-left: 110px;
}

.avatarCropper
{
	display: inline-block;
	vertical-align: bottom;
	direction: ltr;

	label
	{
		display: block;
		overflow: hidden;
		position: relative;

		img
		{
			cursor: move;
		}
	}

	.avatar--o
	{
		.m-avatarSize(@avatar-l);
	}
}

@media (max-width: @xf-responsiveNarrow)
{
	.avatarControl-preview
	{
		display: block;
		float: none;
		text-align: center;
	}

	.avatarControl-inputs
	{
		display: block;
		margin-left: 0;
	}
}

// classes from the cropping JS
.cropFrame
{
	overflow: hidden;
	position: relative;
}

.cropImage
{
	position: absolute;
	top: 0;
	left: 0;
	cursor: move;
	max-width: none;
}

.cropControls
{
	display: none;
}';
	return $__finalCompiled;
});