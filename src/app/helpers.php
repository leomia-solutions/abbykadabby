<?php

if (! function_exists('uuid')) {
	function uuid()
	{
		return Uuid::generate()->string;
	}
}