<?php 
	/*
	
		DDoS Protection - By StressLayer.co
	*/
	if(!empty($_COOKIE['ddos_key']))
	{		
			header('Location: index.php');
	}	
	if(!empty($_POST['continue']) && (!empty($_POST['g-recaptcha-response']))){

		if(empty($_COOKIE['ddos_key']))
			{	
				$length = 8;
				$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
				// Sets a 30 Mintue Session Before Renew
				setcookie("ddos_key", MD5($randomString), time() + 3600);
				header('Location: index.php');	
			}
	
}	

?>
<html lang="en-US">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
  <meta name="robots" content="noindex, nofollow">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Security Scan...</title>
  <style>.globload,html{width:100%;height:100%}.globload,body,html{height:100%}.globload,.spinner{top:0;bottom:510px;left:0;right:0}*,body,html{margin:0;padding:-10px;font-family:segoe ui,arial;font-stretch:condensed}*{cursor:default}li{list-style:none}a{cursor:pointer}a:visited{color:#fff}input,input:active,input:focus{-webkit-border-radius:0;-moz-border-radius:0;border-radius:0;-webkit-appearance:none}.globload{background:#222;background:-moz-radial-gradient(center ,ellipse cover ,#222 0 ,#333 100%);background:-webkit-gradient(radial ,center center ,0 ,center center ,100% ,color-stop(0 ,#222) ,color-stop(100% ,#333));background:-webkit-radial-gradient(center ,ellipse cover ,#222 0 ,#333 100%);background:-o-radial-gradient(center ,ellipse cover ,#222 0 ,#333 100%);background:-ms-radial-gradient(center ,ellipse cover ,#222 0 ,#333 100%);background:radial-gradient(ellipse at center ,#222 0 ,#333 100%);position:fixed;z-index:100000}@-webkit-keyframes bounce{0%{-webkit-transform:translateY(0);transform:translateY(0)}40%{-webkit-transform:translateY(-30px);transform:translateY(-30px)}60%{-webkit-transform:translateY(-15px);transform:translateY(-15px)}}@keyframes bounce{0%{-webkit-transform:translateY(0);-ms-transform:translateY(0);transform:translateY(0)}40%{-webkit-transform:translateY(-30px);-ms-transform:translateY(-30px);transform:translateY(-30px)}60%{-webkit-transform:translateY(-15px);-ms-transform:translateY(-15px);transform:translateY(-15px)}}.bounce{-webkit-animation-name:bounce;animation-name:bounce}.animated{-webkit-animation-duration:3s;animation-duration:3s;-webkit-animation-fill-mode:both;animation-fill-mode:both}@-webkit-keyframes fadeIn{0%{opacity:0}100%{opacity:1}}@keyframes fadeIn{0%{opacity:0}100%{opacity:1}}.spinner h6{font-family:'Lucida Grande',Lato,'Helvetica Neue',Arial,Verdana,sans-serif;font-weight:300;font-size:23px;color:#FFF;margin-top:10px}.spinner h1,.spinner h2{font-weight:600;font-family:'Lucida Grande',Lato,'Helvetica Neue',Arial,Verdana,sans-serif;color:#FFF}.spinner h1{font-size:26px;padding:10px 0}.spinner h2{font-size:26px;padding:0}.spinner h3{font-family:'Lucida Grande',Lato,'Helvetica Neue',Arial,Verdana,sans-serif;font-weight:300;font-size:16px;color:#FFF;padding:40px 0 0}.spinner h3>a,.spinner h3>a:visited{color:#fff!important}.spinner h3>a{text-decoration:underline}.fadeIn{-webkit-animation-name:fadeIn;animation-name:fadeIn}.spinner{font-size:10px;height:200px;position:absolute;margin:auto;text-align:center}.spinner>div{width:12px;height:12px;background-color:#3385ff;border-radius:100%;display:inline-block;-webkit-animation:bouncedelay 1.4s infinite ease-in-out;animation:bouncedelay 1.4s infinite ease-in-out;-webkit-animation-fill-mode:both;animation-fill-mode:both}.spinner .bounce1{-webkit-animation-delay:-.32s;animation-delay:-.32s}.spinner .bounce2{-webkit-animation-delay:-.16s;animation-delay:-.16s}.spinner .bounce3{-webkit-animation-delay:-1.4s;animation-delay:-1.4s}@-webkit-keyframes bouncedelay{0%{-webkit-transform:scale(0)}40%{-webkit-transform:scale(1)}}@keyframes bouncedelay{0%{transform:scale(0);-webkit-transform:scale(0)}40%{transform:scale(1);-webkit-transform:scale(1)}}</style>
<STYLE> 
BODY { background: url(laja.jpg) center fixed no-repeat} 
</STYLE> 
<style>
.button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  -webkit-transition-duration: 0.4s; /* Safari */
  transition-duration: 0.4s;
  cursor: pointer;
}

.button1 {
  background-color: white; 
  color: black; 
  border: 2px solid #4CAF50;
}

.button1:hover {
  background-color: #4CAF50;
  color: white;
}

.button2 {
  background-color: white; 
  color: black; 
  border: 2px solid #008CBA;
}

.button2:hover {
  background-color: #008CBA;
  color: white;
}

.button3 {
  background-color: white; 
  color: black; 
  border: 2px solid #f44336;
}

.button3:hover {
  background-color: #f44336;
  color: white;
}

.button4 {
  background-color: white;
  color: black;
  border: 2px solid #e7e7e7;
}

.button4:hover {background-color: #e7e7e7;}

.button5 {
  background-color: #111111;
  color: black;
  border: 2px solid #ff0000;
}

.button5:hover {
  background-color: #ff0000;
  color: white;
}
</style>

<style type="text/css">
html {
  background: url(img1.gif) no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;

}
#loadingProgressG{
	width:90px;
	height:7px;
	overflow:hidden;
	background-color:rgb(0,0,0);
	margin:auto;
	border-radius:3px;
		-o-border-radius:3px;
		-ms-border-radius:3px;
		-webkit-border-radius:3px;
		-moz-border-radius:3px;
}

.loadingProgressG{
	background-color:rgb(255,255,255);
	margin-top:0;
	margin-left:-90px;
	animation-name:bounce_loadingProgressG;
		-o-animation-name:bounce_loadingProgressG;
		-ms-animation-name:bounce_loadingProgressG;
		-webkit-animation-name:bounce_loadingProgressG;
		-moz-animation-name:bounce_loadingProgressG;
	animation-duration:1.5s;
		-o-animation-duration:1.5s;
		-ms-animation-duration:1.5s;
		-webkit-animation-duration:1.5s;
		-moz-animation-duration:1.5s;
	animation-iteration-count:infinite;
		-o-animation-iteration-count:infinite;
		-ms-animation-iteration-count:infinite;
		-webkit-animation-iteration-count:infinite;
		-moz-animation-iteration-count:infinite;
	animation-timing-function:linear;
		-o-animation-timing-function:linear;
		-ms-animation-timing-function:linear;
		-webkit-animation-timing-function:linear;
		-moz-animation-timing-function:linear;
	width:90px;
	height:7px;
}



@keyframes bounce_loadingProgressG{
	0%{
		margin-left:-90px;
	}

	100%{
		margin-left:90px;
	}
}

@-o-keyframes bounce_loadingProgressG{
	0%{
		margin-left:-90px;
	}

	100%{
		margin-left:90px;
	}
}

@-ms-keyframes bounce_loadingProgressG{
	0%{
		margin-left:-90px;
	}

	100%{
		margin-left:90px;
	}
}

@-webkit-keyframes bounce_loadingProgressG{
	0%{
		margin-left:-90px;
	}

	100%{
		margin-left:90px;
	}
}

@-moz-keyframes bounce_loadingProgressG{
	0%{
		margin-left:-90px;
	}

	100%{
		margin-left:90px;
	}
}

.loader{height:4px;width:100%;position:relative;overflow:hidden;background-color:rgba(221 ,221 ,221 ,0)}.loader:before{display:block;position:absolute;content:"";left:-200px;width:200px;height:4px;background-color:#0c93e2;animation:loading 2s linear infinite}@keyframes loading{from{left:-200px;width:30%}50%{width:30%}70%{width:70%}80%{left:50%}95%{left:120%}to{left:100%}}


</style>

</head>
<body background="laja.jpg" class="center">
  <link href="https://fonts.googleapis.com/css?family=Gugi" rel="stylesheet">
  
    <tbody><tr>
      <td align="center" valign="middle">
          <div class="cf-browser-verification cf-im-under-attack">
  <noscript><h1 data-translate="turn_on_js" style="color:#bd2426;">Please turn JavaScript on and reload the page.</h1></noscript>
  <div id="cf-content" style="display: block;">
    
    <div>
      <div class="bubbles"></div>
      <div class="bubbles"></div>
      <div class="bubbles"></div>
    </div>
	
<div class="spinner animated fadeIn" style="margin-top:100px;">
	<h1></h1>
<div style="background-color:#000000" class="bounce1"></div>
<div style="background-color:#ff0000" class="bounce2"></div>
<div style="background-color:#000000" class="bounce3"></div>
<div style="background-color:#ff0000" class="bounce1"></div>
<div style="background-color:#000000" class="bounce2"></div>
<div style="background-color:#ff0000" class="bounce3"></div>
    <h1  style="color:#ff0000;"><span data-translate="checking_browser">Checking your browser before accessing</span> StressLayer.xyz </h1>
	
    
    <h3><p data-translate="process_is_automatic" style="color:#FFFFFF;">Please submit a request in the button below to access the site.</p></h3>
	<br>
	<form method="POST">
				<div class="form-group">
					<div class="jumbotron">
					<div class="form-group">
                                                    <div class="col-xs-12">
                                                        <center> <div class="g-recaptcha" data-callback="enableBtn" data-sitekey=6LcKZaMUAAAAAPfS8eIRbPks6CFINPJKVSfytxiD></div> </center>
                                                    </div>
                                                </div>
		<input type="submit" class="button button5"  class="orange-flat-button"  name="continue" ></input> 
	<div class="loader"></div>
		
	
					</div> 
				</div>
			</form>
			<h3><a href="https://StressLayer.xyz" style="font-size: 16px;">DDoS protection by StressLayer</a></h3>
			
			
  </div>
				
  </div>
  
   
  <form id="challenge-form" action="/cdn-cgi/l/chk_jschl" method="get">
    <input type="hidden" name="jschl_vc" value="e5f419997991637f387549ddb064342f">
    <input type="hidden" name="pass" value="1532148221.005-kRfKoSgx61">
    <input type="hidden" id="jschl-answer" name="jschl_answer">
  </form>
</div>

          
           <div class="attribution">
           
            <br>
            
          </div>
      </td>
     
    </tr>
  </tbody></table>


</body>

        <script src='https://www.google.com/recaptcha/api.js' type="1bbf4e6903ae8a2a4f92755f-text/javascript">
        </script>
        <script type="1bbf4e6903ae8a2a4f92755f-text/javascript">
//            $("form").submit(function (e) {
//                e.preventDefault();
//                if (jQuery("#button5").attr('data-valid') === 'false') {
//                    Swal.fire({
//                        type: 'error',
//                        title: 'Oops...',
//                        text: 'Verify re-capcha'
//                    })
//                } else {
//
//                    $(this).unbind('submit').submit()
//                }
//
//            });
////            document.getElementById("button5").disabled = true;
//
            function enableBtn() {
                jQuery('#button5').show();
//                jQuery("#challenge-form").submit();
//                $("#button5").closest('form').on('submit', function (event) {
//                    this.submit(); //now submit the form
//                });

//                jQuery("#button5").attr('data-valid', 'true');
//                document.getElementById("button5").disabled = false;
            }
        </script>

        <style>.globload,html{width:100%;height:100%}.globload,body,html{height:100%}.globload,.spinner{top:0;bottom:510px;left:0;right:0}*,body,html{margin:0;padding:-10px;font-family:segoe ui,arial;font-stretch:condensed}*{cursor:default}li{list-style:none}a{cursor:pointer}a:visited{color:#fff}input,input:active,input:focus{-webkit-border-radius:0;-moz-border-radius:0;border-radius:0;-webkit-appearance:none}.globload{background:#222;background:-moz-radial-gradient(center ,ellipse cover ,#222 0 ,#333 100%);background:-webkit-gradient(radial ,center center ,0 ,center center ,100% ,color-stop(0 ,#222) ,color-stop(100% ,#333));background:-webkit-radial-gradient(center ,ellipse cover ,#222 0 ,#333 100%);background:-o-radial-gradient(center ,ellipse cover ,#222 0 ,#333 100%);background:-ms-radial-gradient(center ,ellipse cover ,#222 0 ,#333 100%);background:radial-gradient(ellipse at center ,#222 0 ,#333 100%);position:fixed;z-index:100000}@-webkit-keyframes bounce{0%{-webkit-transform:translateY(0);transform:translateY(0)}40%{-webkit-transform:translateY(-30px);transform:translateY(-30px)}60%{-webkit-transform:translateY(-15px);transform:translateY(-15px)}}@keyframes bounce{0%{-webkit-transform:translateY(0);-ms-transform:translateY(0);transform:translateY(0)}40%{-webkit-transform:translateY(-30px);-ms-transform:translateY(-30px);transform:translateY(-30px)}60%{-webkit-transform:translateY(-15px);-ms-transform:translateY(-15px);transform:translateY(-15px)}}.bounce{-webkit-animation-name:bounce;animation-name:bounce}.animated{-webkit-animation-duration:3s;animation-duration:3s;-webkit-animation-fill-mode:both;animation-fill-mode:both}@-webkit-keyframes fadeIn{0%{opacity:0}100%{opacity:1}}@keyframes fadeIn{0%{opacity:0}100%{opacity:1}}.spinner h6{font-family:'Lucida Grande',Lato,'Helvetica Neue',Arial,Verdana,sans-serif;font-weight:300;font-size:23px;color:#FFF;margin-top:10px}.spinner h1,.spinner h2{font-weight:600;font-family:'Lucida Grande',Lato,'Helvetica Neue',Arial,Verdana,sans-serif;color:#FFF}.spinner h1{font-size:26px;padding:10px 0}.spinner h2{font-size:26px;padding:0}.spinner h3{font-family:'Lucida Grande',Lato,'Helvetica Neue',Arial,Verdana,sans-serif;font-weight:300;font-size:16px;color:#FFF;padding:40px 0 0}.spinner h3>a,.spinner h3>a:visited{color:#fff!important}.spinner h3>a{text-decoration:underline}.fadeIn{-webkit-animation-name:fadeIn;animation-name:fadeIn}.spinner{font-size:10px;height:200px;position:absolute;margin:auto;text-align:center}.spinner>div{width:12px;height:12px;background-color:#3385ff;border-radius:100%;display:inline-block;-webkit-animation:bouncedelay 1.4s infinite ease-in-out;animation:bouncedelay 1.4s infinite ease-in-out;-webkit-animation-fill-mode:both;animation-fill-mode:both}.spinner .bounce1{-webkit-animation-delay:-.32s;animation-delay:-.32s}.spinner .bounce2{-webkit-animation-delay:-.16s;animation-delay:-.16s}.spinner .bounce3{-webkit-animation-delay:-1.4s;animation-delay:-1.4s}@-webkit-keyframes bouncedelay{0%{-webkit-transform:scale(0)}40%{-webkit-transform:scale(1)}}@keyframes bouncedelay{0%{transform:scale(0);-webkit-transform:scale(0)}40%{transform:scale(1);-webkit-transform:scale(1)}}</style>
        <STYLE> 
            BODY { background: url(laja.jpg) center fixed no-repeat} 
        </STYLE> 
        <style>
            .button {
                background-color: #4CAF50; /* Green */
                border: none;
                color: white;
                padding: 16px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                -webkit-transition-duration: 0.4s; /* Safari */
                transition-duration: 0.4s;
                cursor: pointer;
            }

            .button1 {
                background-color: white; 
                color: black; 
                border: 2px solid #4CAF50;
            }

            .button1:hover {
                background-color: #4CAF50;
                color: white;
            }

            .button2 {
                background-color: white; 
                color: black; 
                border: 2px solid #008CBA;
            }

            .button2:hover {
                background-color: #008CBA;
                color: white;
            }

            .button3 {
                background-color: white; 
                color: black; 
                border: 2px solid #f44336;
            }

            .button3:hover {
                background-color: #f44336;
                color: white;
            }

            .button4 {
                background-color: white;
                color: black;
                border: 2px solid #e7e7e7;
            }

            .button4:hover {background-color: #e7e7e7;}

            .button5 {
                background-color: #111111;
                /*//color: black;*/
                border: 2px solid #ff0000;
            }

            .button5:hover {
                background-color: #ff0000;
                color: white;
            }
        </style>

        <style type="text/css">
            html {
                background: url(img1.gif) no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;

            }
            #loadingProgressG{
                width:90px;
                height:7px;
                overflow:hidden;
                background-color:rgb(0,0,0);
                margin:auto;
                border-radius:3px;
                -o-border-radius:3px;
                -ms-border-radius:3px;
                -webkit-border-radius:3px;
                -moz-border-radius:3px;
            }

            .loadingProgressG{
                background-color:rgb(255,255,255);
                margin-top:0;
                margin-left:-90px;
                animation-name:bounce_loadingProgressG;
                -o-animation-name:bounce_loadingProgressG;
                -ms-animation-name:bounce_loadingProgressG;
                -webkit-animation-name:bounce_loadingProgressG;
                -moz-animation-name:bounce_loadingProgressG;
                animation-duration:1.5s;
                -o-animation-duration:1.5s;
                -ms-animation-duration:1.5s;
                -webkit-animation-duration:1.5s;
                -moz-animation-duration:1.5s;
                animation-iteration-count:infinite;
                -o-animation-iteration-count:infinite;
                -ms-animation-iteration-count:infinite;
                -webkit-animation-iteration-count:infinite;
                -moz-animation-iteration-count:infinite;
                animation-timing-function:linear;
                -o-animation-timing-function:linear;
                -ms-animation-timing-function:linear;
                -webkit-animation-timing-function:linear;
                -moz-animation-timing-function:linear;
                width:90px;
                height:7px;
            }



            @keyframes bounce_loadingProgressG{
                0%{
                    margin-left:-90px;
                }

                100%{
                    margin-left:90px;
                }
            }

            @-o-keyframes bounce_loadingProgressG{
                0%{
                    margin-left:-90px;
                }

                100%{
                    margin-left:90px;
                }
            }

            @-ms-keyframes bounce_loadingProgressG{
                0%{
                    margin-left:-90px;
                }

                100%{
                    margin-left:90px;
                }
            }

            @-webkit-keyframes bounce_loadingProgressG{
                0%{
                    margin-left:-90px;
                }

                100%{
                    margin-left:90px;
                }
            }

            @-moz-keyframes bounce_loadingProgressG{
                0%{
                    margin-left:-90px;
                }

                100%{
                    margin-left:90px;
                }
            }

        </style>
    <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/95c75768/cloudflare-static/rocket-loader.min.js" data-cf-settings="1bbf4e6903ae8a2a4f92755f-|49" defer=""></script></body>

</html>
