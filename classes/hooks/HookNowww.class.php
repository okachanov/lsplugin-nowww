<?php

class PluginNowww_HookNowww extends Hook {

	//*************************************************************************************
	public function RegisterHook(){
		$this->AddHook('init_action','HookInitAction');
	}
	
	//*************************************************************************************
	protected function BuildUrlFromParts($parts){
        $url = '';
          if (array_key_exists('scheme', $parts)){
            $url .= $parts['scheme'] . '://';
        }
        if (array_key_exists('user', $parts)){
            $url .= $parts['user'];
            if (array_key_exists('pass', $parts)){
                $url .= ':' . $parts['pass'];
            }
            $url .= '@';
        }
        if (array_key_exists('host', $parts)){
            $url .= $parts['host'];
        }
        if (array_key_exists('port', $parts)){
            $url .= ':' . $parts['port'];
        }
        if (array_key_exists('path', $parts)){
            $url .= $parts['path'];
        }
        if (array_key_exists('query', $parts)){
            $url .= '?' . $parts['query'];
        }
        if (array_key_exists('fragment', $parts)){
            $url .= '#' . $parts['fragment'];
        }
    
        return $url;
	}
		
	//*************************************************************************************
	public function HookInitAction(){
		$sCurrentUrl	= Router::GetPathWebCurrent();
		$aParts			= parse_url($sCurrentUrl);
		$sHost			= $aParts['host'];
		
		if(strpos($sHost,'www.') !== false){
			$aParts['host']		= str_replace('www.','',$sHost);
			$sNewUrl			= $this->BuildUrlFromParts($aParts);
			
			Router::Location($sNewUrl);
		}
	}


}

?>