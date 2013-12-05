{if $sEmployment}
{phrase var='userinfo.works_at' employer=$sEmployment} <br>
{/if}

{if $aEducation}
{if $aEducation.is_present == 1}
{if $sEmployment} {else}{/if}{phrase var='userinfo.studies_at' institution=$aEducation.institution} <br>
{else}
{if $sEmployment} {else}<br />{/if}{phrase var='userinfo.studied_at' institution=$aEducation.institution} <br>
{/if}
{/if}
