{extends file="admin_template.tpl"}
{block name="title"}My Page Title{/block}
{block name=body }
    <a href="{php}action('HomeController@otro');{/php}">oe chiche</a>
    app_path=  <br>
    public_path= {php}public_path();{/php}<br>
    asset={php}asset();{/php} <br>
    action={php}action('HomeController@otro');{/php} <br>
{/block}