<?php
/*
 * @copyright        [YouNet_COPYRIGHT]
 * @author           YouNet Development
 * @package          Module_Contactimporter
 * @version          2.06
 *
 */
defined('PHPFOX') or exit('NO DICE!');
?>

<?php
class Contactimporter_Service_Export extends Phpfox_Service  
{
    public function exportCSV($userID)
    {        
        $csv_terminated = "\n";
        $csv_separator = ",";
        $error = '';
        $aRows = $this->database()->select("u.*")
			->from(phpfox::getT('user'), 'u')
			->leftjoin(Phpfox::getT('friend'), 'fr', 'u.user_id = fr.user_id')
			->where('fr.friend_user_id = '.$userID)
			->execute('getSlaveRows');
		
		foreach ($aRows as $key=>$aRow)
		{
			$aInserts[$key]['full_name'] = explode(' ', $aRow['full_name']);
			$aInserts[$key]['email'] = $aRow['email'];
		}

		$fRows = "First Name,Middle Name,Last Name,Title,Suffix,Initials,Web Page,Gender,Birthday,Anniversary,Location,Language,Internet Free Busy,Notes,E-mail Address,E-mail 2 Address,E-mail 3 Address,Primary Phone,Home Phone,Home Phone 2,Mobile Phone,Pager,Home Fax,Home Address,Home Street,Home Street 2,Home Street 3,Home Address PO Box,Home City,Home State,Home Postal Code,Home Country,Spouse,Children,Manager's Name,Assistant's Name,Referred By,Company Main Phone,Business Phone,Business Phone 2,Business Fax,Assistant's Phone,Company,Job Title,Department,Office Location,Organizational ID Number,Profession,Account,Business Address,Business Street,Business Street 2,Business Street 3,Business Address PO Box,Business City,Business State,Business Postal Code,Business Country,Other Phone,Other Fax,Other Address,Other Street,Other Street 2,Other Street 3,Other Address PO Box,Other City,Other State,Other Postal Code,Other Country,Callback,Car Phone,ISDN,Radio Phone,TTY/TDD Phone,Telex,User 1,User 2,User 3,User 4,Keywords,Mileage,Hobby,Billing Information,Directory Server,Sensitivity,Priority,Private,Categories";
		$aCols = explode(',', $fRows);
        if (count($aRows) > 0) {
			$file = 'contact.export.' . date('Y-m-d', time()) . '.csv';
			$contentCSV = '';
			$contentCSV .= $fRows;
			$contentCSV .= $csv_terminated;
		   foreach($aInserts as $aRow)
		   {
				foreach($aCols as $key2=>$aCol)
                {
					if(in_array($key2, array(0,1,2)))
					{
						$contentCSV .= $aRow['full_name'][$key2];
						$contentCSV .= $csv_separator;
					}
					else if($key2 == 14)
					{
						$contentCSV .= $aRow['email'];
						$contentCSV .= $csv_separator;
					}
					else 
					{
						$contentCSV .= ' '.$csv_separator;
					}
				}
				$contentCSV .= $csv_terminated;
            }
        }
        else
        {
            $error =Phpfox::getPhrase('contactimporter.your_friend_contact_is_empty').'.';
        }
        if($error !='')
        {
            return $error;
        }
        ob_clean();
        ob_start();
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Length: " . strlen( $contentCSV));
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=$file");
        echo  $contentCSV;
        $str = ob_get_clean();
        echo $str;
        exit;
	}
}
?>