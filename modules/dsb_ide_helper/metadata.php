<?php
/**
 * Metadata version
 */
$sMetadataVersion = '1.1';

/**
 * Module information
 */
$aModule = array(
    'id'          => 'dsb_ide_helper',
    'title'       => 'DSB\'s IDE Helper',
    'url'         => 'https://github.com/DSB/Oxid-Module-IDE-Helper',
    'description' => array(
        'en' => 'In OXID IDE\'s can\'t follow the class inheritance chain because the referred parent classes are '
                . ' created in memory at runtime.<br>'
                . 'This makes it impossible for IDE\'s to create auto completion for the parent '
                . 'classes. This module can save them as physical files to disc which enables the IDE to follow the '
                . 'class chain. The benfit is to now have auto completion in your IDE.'
                . '<br />After changing the module chain you should update the files here.',
        'de' => 'Eine IDE kann im OXID-Code der Vererbungskette von Modulklassen nicht folgen, da die referenzierten '
                . 'Elternklassen erst dynamisch zur Laufzeit erstellt werden. Dadurch kann die IDE keine automatische '
                . 'Vervollst&auml;ndigung von vererbten Methoden der Elternklassen anbieten. '
                . 'Dieses Modul f&uuml;gt einen neuen Men&uuml;punkt hinzu, mit dessen Hilfe die *_parent-Klassen '
                . ' in ihrer Vererbungskette als physikalische Dateien auf der Festplatte abgelegt werden können.<br>'
                . 'Anschlie&szlig;end k&ouml;nnen IDEs der Kette wieder folgen und die automatische Vervollständigung '
                . 'anbieten.'
                . '<br />Wenn &Auml;nderungen an der Modulkette vorgenommen wurden, kann der Stand dar&uuml;ber  '
                . 'jederzeit aktualisiert werden.',
    ),
    'lang'        => 'en',
    'version'     => '1.0.0',
    'author'      => 'Daniel Schlichtholz',
    'email'       => 'admin@mysqldumper.de',
    'thumbnail'   => 'thumb.png',
    'extend'      => array(),
    'files'       => array(
        'dsb_ide_helper' => 'dsb_ide_helper/controllers/admin/dsb_ide_helper.php',
    ),
    'templates'   => array(
        'dsb_ide_helper.tpl' => 'dsb_ide_helper/out/admin/tpl/dsb_ide_helper.tpl',
    ),
);