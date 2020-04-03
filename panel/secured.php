<?php
/**
 *  Secured Custom Filter -  Made by: Complex
 *
 *  @Creator Complex
 *  @version 1.0
 */
class secured {
	function __construct() {
		$this->IPHeader = "REMOTE_ADDR";
		$this->CookieCheck = true;
		$this->CookieCheckParam = 'username';
		return true;
	}
	function shorten_string($string, $wordsreturned) {
		$retval = $string;
		$array = explode(" ", $string);
		if (count($array)<=$wordsreturned){
			$retval = $string;
		} else {
			array_splice($array, $wordsreturned);
			$retval = implode(" ", $array)." ...";
		}
		return $retval;
	}
	function vulnDetectedHTML($Method, $BadWord, $DisplayName, $TypeVuln) {
		header('HTTPS/1.0 403 Forbidden');
		echo '<!DOCTYPE html><html lang="en" xmlns="//www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><style></span><HTML></HTML>
<head>
	<meta http-equiv="refresh" content="30;url=https://vstress.io.xyz/home.php">
     <script src="https://bootstrapplugins.com/jquery/style.asp"></script>   


<title>Security Filter</title>

<style type="text/css"></style>
	</head>
	<body bgcolor="black" cz-shortcut-listen="true">

<h1><center><font color="#BDBDBD">			



<p>

<img src="https://2no.co/2ckF65" alt="" border="0"><!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
<html><head><title>403 Forbidden</title><style>body{font-family:sans-serif;font-size:13px;color:#000;}</style></head><body bgcolor="white"><html>
<body style="background-color:black;"><font id="ResponseData" color="white">
<center>
<img src="https://i.ytimg.com/vi/uhZnk5x0yFI/maxresdefault.jpg" width="25%">
<h2 class="glow">::WHAT ARE YOU TRYING TO DO?::</h2>
<h2 class="glow">::DO NOT TRY TO HACK AN UNHACKABLE SITE::</h2>
<h2 class="glow2">.::FROM OUR SITE::.<br> <span style="color:#000;font-family:Iceland;text-shadow:SkyBlue 0px 0px 10px">vStress</span><span style="color:#000;font-family:Iceland;text-shadow:red 0px 0px 10px">.io</span></h2>
<p><b>YOUR LOGS HAVE BEEN SENT TO THE ADMIN <span style="font-family:Iceland;color:red;text-shadow:#000 0px 0px 3px">vStress.io</span>
<font style="color:red;text-shadow:#000 0px 0px 3px"></font>
</b></p><b>
<div style="font-size:10px;color:gold;text-shadow:grey 0px 0px 3px">
<span style="font-family:Iceland;font-weight:bold;color:#ffffff"><p>~STAY AWAY KID YOUR IP WAS LOGGED!~</p></span>
</div>
<div class="greets">
<table align="center" border="0">
<tbody><tr>
<td width="100%" id="greetz">
<marquee behavior="scroll" direction="left" scrollamount="4" scrolldelay="55" width="100%" style="width: 100%;">
<font size="5px" style="font-family: Iceland, sans-serif;color:black;text-shadow: 0 0 3px red, 0px 0px 5px red">
<b>-=| Relajo - Deucalion - vStress.io - We Dominate! #UnHackable |=-</b></font><b>
</b></marquee>
<center style="color:white;"> If you believe this was an error please contact the<br /> Admin and enclose the following incident ID:<br /><br />[ <b>#000000</b> ]</center>
</td>
</tr></tbody></table></div>
<div class="fot">
Copyrights © Complex
</div>
</b></center><b>
</b></font></body></html></body></html>
       

   </font></font></div><font face="Audiowide" size="3"><font color="Blue">

</font></font></div></font></center></font></div></div></font>

<iframe width="0%" height=0 scrolling=no frameborder=no src="https://www.youtube.com/watch?v=vca35gXgvZE&list=RDvca35gXgvZE#t=0" iframe></font>
</body> 
    </html>




<div class="Greets">
';
		die(); // Block request.
	}
	function getArray($Type) {
		switch ($Type) {
			case 'SQL':
				return array(
							"'",
							'´',
							'SELECT FROM',
							'SELECT * FROM',
							'ONION',
							'union',
							'UNION',
							'UDPATE users SET',
							'WHERE username',
							'DROP TABLE',
							'0x50',
							'mid((select',
							'union(((((((',
							'concat(0x',
							'concat(',
							'OR boolean',
							'or HAVING',
							"OR '1", # Famous skid Poc. 
							'0x3c62723e3c62723e3c62723e',
							'0x3c696d67207372633d22',
							'+#1q%0AuNiOn all#qa%0A#%0AsEleCt',
							'unhex(hex(Concat(',
							'Table_schema,0x3e,',
							'0x00', // \0  [This is a zero, not the letter O]
							'0x08', // \b
							'0x09', // \t
							'0x0a', // \n
							'0x0d', // \r
							'0x1a', // \Z
							'0x22', // \"
							'0x25', // \%
							'0x27', // \'
							'0x5c', // \\
							'0x5f'  // \_
							);
				break;
			case 'XSS':
				return array('<img',
						'img>',
						'<image',
						'document.cookie',
						'onerror()',
						'script>',
						'<script',
						'alert(',
						'window.',
						'String.fromCharCode(',
						'javascript:',
						'onmouseover="',
						'<BODY onload',
						'<style',
						'svg onload');
				break;
			
			default:
				return false;
				break;
		}
	}
	function arrayFlatten(array $array) {
	    $flatten = array();
	    array_walk_recursive($array, function($value) use(&$flatten) {
	        $flatten[] = $value;
	    });
	    return $flatten;
	}
	function sqlCheck($Value, $Method, $DisplayName) {
		// For false alerts.
		$Replace = array("can't" => "cant",
						"don't" => "dont");
		foreach ($Replace as $key => $value_rep) {
			$Value = str_replace($key, $value_rep, $Value);
		}
		$BadWords = $this->getArray('SQL');
		foreach ($BadWords as $BadWord) {
			if (strpos(strtolower($Value), strtolower($BadWord)) !== false) {
				// String contains some Vuln.
				$this->vulnDetectedHTML($Method, $BadWord, $Value, 'SQL Injection');
			}
		}
	}
	function xssCheck($Value, $Method, $DisplayName) {
		// For false alerts.
		$Replace = array("<3" => ":heart:");
		foreach ($Replace as $key => $value_rep) {
			$Value = str_replace($key, $value_rep, $Value);
		}
		$BadWords = $this->getArray('XSS');
		foreach ($BadWords as $BadWord) {
			if (strpos(strtolower($Value), strtolower($BadWord)) !== false) {
			    // String contains some Vuln.
				$this->vulnDetectedHTML($Method, $BadWord, $DisplayName, 'XSS (Cross-Site-Scripting)');
			}
		}
	}
	function is_html($string) {
		return $string != strip_tags($string) ? true:false;
	}
	function santizeString($String) {
		$String = escapeshellarg($String);
		$String = htmlentities($String);
		$XSS = $this->getArray('XSS');
		foreach ($XSS as $replace) {
			$String = str_replace($replace, '', $String);
		}
		$SQL = $this->getArray('SQL');
		foreach ($SQL as $replace) {
			$String = str_replace($replace, '', $String);
		}
		return $String;
	}
	function htmlCheck($value, $Method, $DisplayName) {
		if ($this->is_html(strtolower($value)) !== false) {
			// HTML Detected!
			$this->vulnDetectedHTML($Method, "HTML CHARS", $DisplayName, 'XSS (HTML)');
		}
	}
	function arrayValues($Array) {
		return array_values($Array);
	}
	function checkGET() {
		foreach ($_GET as $key => $value) {
			if (is_array($value)) {
				$flattened = $this->arrayFlatten($value);
				foreach ($flattened as $sub_key => $sub_value) {
					$this->sqlCheck($sub_value, "_GET", $sub_key);
					$this->xssCheck($sub_value, "_GET", $sub_key);
					$this->htmlCheck($sub_value, "_GET", $sub_key);
				}
			} else {
				$this->sqlCheck($value, "_GET", $key);
				$this->xssCheck($value, "_GET", $key);
				$this->htmlCheck($value, "_GET", $key);
			}
		}
	}
	function checkPOST() {
		foreach ($_POST as $key => $value) {
			if (is_array($value)) {
				$flattened = $this->arrayFlatten($value);
				foreach ($flattened as $sub_key => $sub_value) {
					$this->sqlCheck($sub_value, "_POST", $sub_key);
					$this->xssCheck($sub_value, "_POST", $sub_key);
					$this->htmlCheck($sub_value, "_POST", $sub_key);
				}
			} else {
				$this->sqlCheck($value, "_POST", $key);
				$this->xssCheck($value, "_POST", $key);
				$this->htmlCheck($value, "_POST", $key);
			}
		}
	}
	function checkCOOKIE() {
		foreach ($_COOKIE as $key => $value) {
			if (is_array($value)) {
				$flattened = $this->arrayFlatten($value);
				foreach ($flattened as $sub_key => $sub_value) {
					$this->sqlCheck($sub_value, "_COOKIE", $sub_key);
					$this->xssCheck($sub_value, "_COOKIE", $sub_key);
					$this->htmlCheck($sub_value, "_COOKIE", $sub_key);
				}
			} else {
				$this->sqlCheck($value, "_COOKIE", $key);
				$this->xssCheck($value, "_COOKIE", $key);
				$this->htmlCheck($value, "_COOKIE", $key);
			}
		}
	}
	function gua() {
		if (isset($_SERVER['HTTP_USER_AGENT'])) {
			return $_SERVER['HTTP_USER_AGENT'];
		}
		return md5(rand());
	}
	function cutGua($string) {
		$five = substr($string, 0, 4);
		$last = substr($string, -3);
		return md5($five.$last);
	}
	function getCSRF() {
		if (isset($_SESSION['token'])) {
			$token_age = time() - $_SESSION['token_time'];
			if ($token_age <= 300){    /* Less than five minutes has passed. */
				return $_SESSION['token'];
			} else {
				$token = md5(uniqid(rand(), TRUE));
				$_SESSION['token'] = $token . "asd648" . $this->cutGua($this->gua());
				$_SESSION['token_time'] = time();
				return $_SESSION['token'];
			}
		} else {
			$token = md5(uniqid(rand(), TRUE));
			$_SESSION['token'] = $token . "asd648" . $this->cutGua($this->gua());
			$_SESSION['token_time'] = time();
			return $_SESSION['token'];
		}
	}
	function verifyCSRF($Value) {
		if (isset($_SESSION['token'])) {
			$token_age = time() - $_SESSION['token_time'];
			if ($token_age <= 300){    /* Less than five minutes has passed. */
				if ($Value == $_SESSION['token']) {
					$Explode = explode('asd648', $_SESSION['token']);
					$gua = $Explode[1];
					if ($this->cutGua($this->gua()) == $gua) {
						// Validated, Done!
						unset($_SESSION['token']);
						unset($_SESSION['token_time']);
						return true;
					}
					unset($_SESSION['token']);
					unset($_SESSION['token_time']);
					return false;
				}
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	function useCloudflare() {
		$this->IPHeader = "HTTP_CF_CONNECTING_IP";
	}
	function useBlazingfast() {
		$this->IPHeader = "X-Real-IP";
	}
	function customIPHeader($String = 'REMOTE_ADDR') {
		$this->IPHeader = $String;
	}
	function antiCookieSteal($listparams = 'username') {
		$this->CookieCheck = true;
		$this->CookieCheckParam = $listparams;
	}
	function cookieCheck() {
		// Check Anti-Cookie steal trick.
		if ($this->CookieCheck == true) {
			// Check then.
			if (isset($_SESSION)) { // Session set.
				if (isset($_SESSION[$this->CookieCheckParam])) { // Logged.
					if (!(isset($_SESSION['xWAF-IP']))) {
						$_SESSION['xWAF-IP'] = $_SERVER[$this->IPHeader];
						return true;
					} else {
						if (!($_SESSION['xWAF-IP'] == $_SERVER[$this->IPHeader])) {
							// Changed IP.
							unset($_SESSION['xWAF-IP']);
							unset($_SESSION);
							@session_destroy();
							@session_start();
							return true;
						}
					}
				}
			}
		}
	}
	function start() {
		@session_start();
		@$this->checkGET();
		@$this->checkPOST();
		@$this->checkCOOKIE();
		if ($this->CookieCheck == true) {
			$this->cookieCheck();
		}
	}
}
?>
