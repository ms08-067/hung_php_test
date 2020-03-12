<?php 
namespace Extend\Auth;

interface AmoUserInterface
{
	public function getAuthPasswordTemp();
	public function getBlockEndedTime();
}