<?php

use Core\Formatter;

?>
<!DOCTYPE html>
<html lang="<?=t('StatusPage.lang')?>">
<head>
    <title><?= htmlspecialchars($this->getTitle()) ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="manifest" href="/dist/Common/manifest.json">
    <link rel="shortcut icon" href="/dist/Common/icon.png">
    <link rel="icon" sizes="192x192" href="/dist/Common/icon192.png">
    <link rel="stylesheet" href="/dist/StatusPage/public.css">
    <meta name="color-scheme" content="light dark">
    <meta name="theme-color" content="#d7ee1b" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#111917" media="(prefers-color-scheme: dark)">
    <?php foreach ($this->getHeadLinks() ?? [] as $link){
        echo '<link ';
        foreach ($link as $key=>$value){
            echo htmlspecialchars($key).'="'.htmlspecialchars($value).'" ';
        }
        echo '>';
    } ?>

    <?= $this->headerHtml() ?>
</head>
<body>

<div class="mainContent">
    <div data-views="main"><?php $this->showViews('main'); ?></div>
</div>
<footer>
    Made by <a href="https://greenlogcollector.green-code.studio/">Green Log Collector</a>
</footer>
<script>
    //<![CDATA[
    window.controllerInitInfo = <?=json_encode($this->getInitInfo())?>;
    window.DEBUG =<?=json_encode($this->isDebug())?>;
    //]]>
</script>
<script src="/dist/StatusPage/public.js"></script>
</body>
</html>
