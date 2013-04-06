<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>[{ oxmultilang ident="dsb_ide_helper" }]</title>
    <link rel="stylesheet" href="[{$oViewConf->getResourceUrl()}]main.css">
    <link rel="stylesheet" href="[{$oViewConf->getResourceUrl()}]colors.css">
    <meta http-equiv="Content-Type" content="text/html; charset=[{$charset}]">
</head>
<body>
<div class="box">
    <h1>[{oxmultilang ident="DSB_IDEHELPER_TITLE"}]</h1>

    <form action="[{ $oViewConf->getSelfLink() }]" method="post">
        <div>
            [{ $oViewConf->getHiddenSid() }]
            <input type="hidden" name="oxid" value="[{ $oxid }]">
            <input type="hidden" name="cl" value="dsb_ide_helper">
            <input type="hidden" name="editlanguage" value="[{ $editlanguage }]">
            <input type="submit" name="create" value="[{oxmultilang ident="DSB_IDEHELPER_BUTTON_CREATE"}]">
            <input type="submit" name="delete" value="[{oxmultilang ident="DSB_IDEHELPER_BUTTON_DELETE"}]">
        </div>
    </form>
    <div class="clear"><br></div>
    [{if count($deleteErrors) > 0}]
        <div class="errorbox">
            <h3>[{oxmultilang ident="DSB_IDEHELPER_DELETE_FILES_ERROR"}]</h3>
            <ul>
            [{foreach from=$deleteErrors item=file}]
                <li>[{$file}]</li>
            [{/foreach}]
            </ul>
        </div>
        <br>
    [{/if}]

    [{if count($deleteSuccess) > 0}]
        <div class="messagebox">
            <h3>[{oxmultilang ident="DSB_IDEHELPER_DELETE_FILES_SUCCESS"}]</h3>
            <ul>
                [{foreach from=$deleteSuccess item=file}]
                <li>[{$file}]</li>
                [{/foreach}]
            </ul>
        </div>
        <br>
    [{/if}]

    [{if count($createErrors) > 0}]
        <div class="errorbox">
            <h3>[{oxmultilang ident="DSB_IDEHELPER_CREATE_FILES_ERROR"}]</h3>
            <ul>
                [{foreach from=$createErrors item=file}]
                    <li>[{$file}]</li>
                [{/foreach}]
            </ul>
        </div>
        <br>
    [{/if}]

    [{if count($createSuccess) > 0}]
        <div class="messagebox">
            <h3>[{oxmultilang ident="DSB_IDEHELPER_CREATE_FILES_SUCCESS"}]</h3>
            <ul>
                [{foreach from=$createSuccess item=file}]
                <li>[{$file}]</li>
                [{/foreach}]
            </ul>
        </div>
        <br>
    [{/if}]

    [{if count($existsErrors) > 0}]
        <div class="errorbox">
            <h3>[{oxmultilang ident="DSB_IDEHELPER_MISSING_FILES"}]</h3>
            <ul>
                [{foreach from=$existsErrors item=file}]
                <li>[{$file}]</li>
                [{/foreach}]
            </ul>
        </div>
        <br>
    [{/if}]

    [{if count($existsSuccess) > 0}]
        <div class="messagebox">
            <h3>[{oxmultilang ident="DSB_IDEHELPER_EXISTING_FILES"}]</h3>
            <ul>
                [{foreach from=$existsSuccess item=file}]
                <li>[{$file}]</li>
                [{/foreach}]
            </ul>
        </div>
        <br>
    [{/if}]

    [{include file="bottomitem.tpl"}]