<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

class YouNetCore_Service_Core extends Phpfox_Service
{
	/**
	 * Class constructor
	 */
	private $_config = array(
			'url' =>'',
			'plfversion' =>'',
			'checkPatern' => array(),
			'cache' => array(),
			'iTime' => 0,
	);
	public function __construct()
	{
		$this->_sTable = Phpfox::getT('younetcore_license');
		$this->_config = array(
				'url' => 'http://auth.modules2buy.com/ls.php',
				'plfversion' => Phpfox::getParam('core.phpfox_version'),
				'checkPatern' => array(
						'description' => 'by YouNet Company',
						//'version' => substr(Phpfox::getParam('core.phpfox_version'),2),
						'check_id' =>'younetcore'
				),
				'cache' => array(
						'sCacheYNModuleName' => 'younetcore_cache_module_yn_name',
						'sCacheModuleName' => 'younetcore_cache_module_yours_name',
						'sCacheInvalidName' => 'younetcore_cache_invalid_yours_name',
				),
				'iTime' => 60,//cache time in minutes

		);
	}
	public function c($aData = array(),$sName = "")
	{
		$this->cache()->set($sName);
		$this->cache()->save($sName,$aData);
	}
    public function rma()
    {
        $this->cache()->remove();
    }
	public function rmc($sName= "")
	{
		if($sName == "")
		{
			foreach($this->_config['cache'] as $sKey=>$sName)
			{
                $this->cache()->remove($sName);
			}
		}
		else
		{
			$this->cache()->remove($sName);
		}
		

	}
	public function getUrl()
	{
		return $this->_config['url'];
	}
	public function getCurrentDomain()
	{
		return strtolower(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : (isset($_SERVER['HOST']) ? $_SERVER['HOST'] : ''));
	}
	public function getPhotos($m,$t)
	{
		$url = $this->_config['url'];
		$params['t'] = $t;
		$params['m'] = $m;
		$params['tt'] = 'phpfox';
		$params['ttversion'] = $this->_config['plfversion'];
		$results = $this->doPost($params,$url);
		//$results = json_decode($results);
		return $results;
	}
	public function getVerifyKey($params)
	{
		$url = $this -> _config['url'];
		$domain = $this -> getCurrentDomain();
		$domain = base64_encode($domain);
		$params['t'] = 'license';
		$params['d'] = $domain;
		$params['tt'] = 'phpfox';
		$license = $this->doPost($params, $url);
		return $license;
	}
	public function insertVerifyToken($token)
	{


	}
	public function doPost($params,$url)
	{
		$fields_string = "";
		$params['ttversion'] = $this->_config['plfversion'];
		foreach ($params as $key => $value)
		{
			$fields_string .= $key . '=' . $value . '&';
		}
		rtrim($fields_string, '&');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, count($params));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);

		$head = curl_exec($ch);
		curl_close($ch);
		return $head;

	}
	public function getYnModules($page = null ,$limit = null)
	{
		$sCacheId = $this-> cache()-> set($this->_config['cache']['sCacheYNModuleName']);
		if(!($modules = $this->cache()->get($sCacheId,$this->_config['iTime'])))
		{
			$url = $this->_config['url'];
			$domain = $this->getCurrentDomain();
			$domain = base64_encode($domain);
			$params['t'] = 'modules';
			$params['d'] = $domain;
			$params['tt'] ='phpfox';
			$params['ttversion'] = $this->_config['plfversion'];
			$modules = $this->doPost($params,$url);
			
			$modules = json_decode($modules,true);
			$this->cache()->save($sCacheId,$modules);
		}
		$obj = array();
		if($modules == false || count($modules) <= 0 )
		{
			return $obj;
		}
		foreach($modules as $key=>$module)
		{
			$obj[$key] = $module;
		}
		return $obj;

	}
	public function verifyM($data)
	{
		$url = $this->_config['url'];
		$results = false;
		$data['tt'] = 'phpfox';
		$results = $this->doPost($data,$url);
		return $results;
	}
	public function getToken($module = "")
	{
		if($module == "")
		{
			return false;
		}
		$domain = $this->getCurrentDomain();
		$domain = base64_encode($domain);
		$params = array(
				't' =>'token',
				'd' =>$domain,
				'm' => $module,
				'time' =>time(),
				'tt' =>'phpfox'
		);
		$urlget = $this->_config['url'];
		$token = $this->doPost($params,$urlget);
		$token = json_decode($token,true);
		$token['time'] = $params['time'];
		$token['m'] = $module;
		$token_data = array(
				'token' => $token['tk'],
				'params' => $params['time'],
		);
		return $token;

	}
	public function getLicenseRules()
	{
		$params = array(
				't' =>'viewlicense',
				'tt' =>'phpfox'
		);
		$urlget = $this->_config['url'];
		$license = $this->doPost($params,$urlget);
		return $license;
	}
	public function insertYNProduct($aInsert = array())
	{
		return $this->database()->insert($this->_sTable,$aInsert);
	}
	public function updateYNProduct($aUpdate = array())
	{
		return $this->database()->update($this->_sTable,$aUpdate,'name = "'.$aUpdate['name'].'"');
	}
	public function updateProduct($name = "",$status = 1)
	{
		 
		if($name == "")
		{
			return false;
		}
		$this->database()->update(phpfox::getT('product'),array('is_active'=>$status),'product_id = "'.$name.'"');
		$this->database()->update(phpfox::getT('module'),array('is_active'=>$status),'product_id = "'.$name.'"');
		$this->cache()->remove('product');
	}
	public function getYNProduct($iProductName)
	{
		return $this->database()->select('p.*')
		->from($this->_sTable,'p')
		->where('p.name = "'.$iProductName.'"')
		->execute('getRow');
	}
	public function getModuleFromInstall()
	{
		$lst_modules =  $this->database()->select('p.*')
		->from($this->_sTable,'p')
		->execute('getRows');
		$modules = array();
		foreach($lst_modules as $key =>$m)
		{
			/*if($m['current_version'] =="3.01")
			{
				continue;
			}*/
			$modules[$m['name']] = array(
					'name' => $m['title'],
					'current_v' => $m['current_version'],
					'latest_v' => $m['lasted_version'],
					'demo_url' => $m['demo_link'],
					'image_url' => '',
					'purchase' => '',
					'download' => $m['download_link'],
					'price' => '',
					'currency' =>'',
					'params' =>$m['params'],
			);
		}
		return $modules;
		 
	}
	public function reverifiedModules()
	{
		$sCacheId = $this-> cache()-> set($this->_config['cache']['sCacheInvalidName']);
		
		if(!($m_invalid = $this->cache()->get($sCacheId,$this->_config['iTime'])))
		{
			$modules = $this->getModuleFromInstall();
			$url = $this->_config['url'];
			$params = array(
					't' =>'verifymodules',
					'tt' =>'phpfox',
					'data' =>base64_encode(serialize($modules)),
			);
			$m_invalid = $this->doPost($params,$url);
			$m_invalid = json_decode($m_invalid,true);
			$this->cache()->save($sCacheId,$m_invalid);
		}
		if($m_invalid == false || count($m_invalid) <= 0 || !is_array($m_invalid))
		{
			return false;
		}
		$version = $this->_getPlatformVersion($this->_config['plfversion']);
		foreach($m_invalid as $key=>$module)
		{
			$m = str_replace("{".$version."}",'',$key);
			$this->updateProduct($m,0);
			$aUpdate['params'] = "";
			$aUpdate['name'] = $m;
			$aUpdate['is_active'] = 0;
			$this->updateYNProduct($aUpdate);

		}
		
	}
	public function checkYouNetProducts($aModules = array())
	{
		if(!phpfox::isAdminPanel())
		{
			return true;
		}
		$aYNProducts = $this->getYounetProductsFromSite();
		$aYNLiveModules = $this->getYnModules();
        $this->cache()->remove('module_menu');
		$this->cache()->remove('module');
		if(count($aYNProducts) > 0)
		{
			foreach($aYNProducts as $key=>$aProduct)
			{
				$aCheckProduct = $this->getYNProduct($aProduct['product_id']);
				/*foreach($aModules as $m=>$aModule)
				 {
				if($aModule['module_id'] == $aProduct['product_id'])
				{
				unset($aModules[$m]);
				}
				}*/
				//end
				if(count($aCheckProduct)>0 && $aCheckProduct != false)
				{
					$aCheckProduct['current_version'] = $aProduct['version'];
					$aCheckProduct['lasted_version'] = $aProduct['version'];
					//$this->updateYNProduct($aCheckProduct);
					$this->updateProduct($aProduct['product_id'],$aProduct['is_active']);
				}
				else
				{
					if(count($aYNLiveModules) <= 0)
					{
						$aInsert = array(
								'name' => $aProduct['product_id'],
								'title' => $aProduct['title'],
								'descriptions' => $aProduct['description'],
								'type' =>'module',
								'current_version' =>$aProduct['version'],
								'lasted_version' =>$aProduct['version'],
								'is_active' => 0,
						);

						$this->insertYNProduct($aInsert);
						$this->updateProduct($aProduct['product_id'],0);
						break;
					}
					else
					{
						foreach($aYNLiveModules as $key=>$aYNLiveModule)
						{
							if($aYNLiveModule['key'] == $aProduct['product_id'])
							{
								$aInsert = array(
										'name' => $aProduct['product_id'],
										'title' => $aProduct['title'],
										'descriptions' => $aProduct['description'],
										'type' =>'module',
										'current_version' =>$aProduct['version'],
										'lasted_version' =>$aProduct['version'],
										'is_active' => 0,
								);
									
								$this->insertYNProduct($aInsert);
								$this->updateProduct($aProduct['product_id'],0);
								break;
							}
						}
							
					}


				}
			}
		}
		return $aModules;
		 
	}
	public function getYounetProductsFromSite()
	{
		$aProducts = $this->database()->select('p.*,pd.type_id,pd.check_id')
			->from(phpfox::getT('product'),'p')
			->leftJoin(phpfox::getT('product_dependency'),'pd','pd.product_id = p.product_id')
			->where("p.product_id !='younetcore'")
			->execute('getRows');
        
		(($sPlugin = Phpfox_Plugin::get('younetcore.check_dependency_younet_module')) ? eval($sPlugin) : false);
       
        $aYNProducts = array(); 
        $iCnt = count($this->_config['checkPatern']);
		if(count($aProducts)>0)
		{
			foreach($aProducts as $key=>$aProduct)
			{
				if($iCnt > 0)
				{
					$iCheck = 0;
					foreach($this->_config['checkPatern'] as $index=>$sCheck)
					{
						if(isset($aProduct[$index]))
						{
							if($aProduct[$index] == $this->_config['checkPatern'][$index])
							{
								$iCheck++;
								
							}
						}
					}
					if($iCheck == $iCnt && !isset($aYNProducts[$aProduct['product_id']]))
					{
						$aYNProducts[$aProduct['product_id']] = $aProduct;
						
					}
				}
				
			}
			return $aYNProducts;
		}
		
		return false;
		 
	}
	public function getPhpFoxProducts($isCache = false)
	{
		$aProducts = $this->database()->select('p.*,pd.type_id,pd.check_id,ync.params as yncparams,ync.is_active as yncstatus')
			->from(phpfox::getT('younetcore_license'),'ync')
			->join(phpfox::getT('product'), 'p','ync.name = p.product_id')
			->leftJoin(phpfox::getT('product_dependency'),'pd','pd.product_id = p.product_id')
			//->where('pd.check_id = "younetcore" AND pd.type_id = "product"')
			->execute('getRows');
        $aResults = array();
        if(count($aProducts)<=0)
        {
            return $aResults;
        }
        foreach($aProducts as $iKey => $aProduct)
        {
            if(!isset($aResults[$aProduct['product_id']]))
            {
                $aResults[$aProduct['product_id']] = $aProduct;
            }
        }
        return $aResults;
	}
	public function getNews()
	{
		$sCacheId = $this -> cache() -> set('younetcore_news');

		if (!($aCache = $this -> cache() -> get($sCacheId, 60)))
		{

			$aNews = Phpfox::getLib('xml.parser') -> parse(Phpfox::getLib('request') -> send('http://phpfox.modules2buy.com/feed', array(), 'GET'));

			$aCache = array();
			$iCnt = 0;
			foreach ($aNews['channel']['item'] as $aItem)
			{
				$iCnt++;
				$aCache[] = array(
						'title' => $aItem['title'],
						'link' => $aItem['link'],
						'creator' => $aItem['dc:creator'],
						'time_stamp' => strtotime($aItem['pubDate'])
				);

				if ($iCnt === 20)
				{
					break;
				}
			}

			$this -> cache() -> save($sCacheId, $aCache);
		}

		foreach ($aCache as $iKey => $aRow)
		{
			$aCache[$iKey]['posted_on'] = Phpfox::getPhrase('admincp.posted_on_time_stamp_by_creator', array(
					'creator' => $aRow['creator'],
					'time_stamp' => Phpfox::getTime(Phpfox::getParam('core.global_update_time'), $aRow['time_stamp'])
			));
		}

		return $aCache;
	}
	public function _getPlatformVersion($version = '0')
	{
		if(!strpos($version,'.'))
		{
			return 0;
		}
		$version = explode('.',$version);
		if(count($version)<= 0)
		{
			return 0;
		}
		return $version[0];
	}

}
?>
