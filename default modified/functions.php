<?php
if (!defined('__TYPECHO_ROOT_DIR__'))
    exit;

function themeConfig($form)

{
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text(
        'logoUrl',
        NULL,
        NULL,
        _t('站点 LOGO 地址'),
        _t('在这里填入一个图片 URL 地址, 以在网站标题前加上一个 LOGO')
        );
    $form->addInput($logoUrl);

    $sidebarBlock = new Typecho_Widget_Helper_Form_Element_Checkbox(
        'sidebarBlock',
        array(
        'ShowRecentPosts' => _t('显示最新文章'),
        'ShowRecentComments' => _t('显示最近回复'),
        'ShowCategory' => _t('显示分类'),
        'ShowArchive' => _t('显示归档'),
        'ShowOther' => _t('显示其它杂项'),
        'ShowPR' => _t('Show PR')
    ),
        array('ShowRecentPosts', 'ShowRecentComments', 'ShowCategory', 'ShowArchive', 'ShowOther', 'ShowPR'),
        _t('侧边栏显示')
        );

    $form->addInput($sidebarBlock->multiMode());

    //gravatar emaile input
    $grav_mail = new Typecho_Widget_Helper_Form_Element_Text(
        'grav_mail',
        NULL,
        NULL,
        _t('プロファイル画像'),
        _t('ここでGravatarと接続したメールを入力したください')
        );
    $form->addInput($grav_mail);

    //self PR
    $PR = new Typecho_Widget_Helper_Form_Element_Text(
        'PR',
        NULL,
        NULL,
        _t('一言'),
        _t('ここで言いたいことを入力してください'),
        );
    $form->addInput($PR);
}


//Gravatar profile image
/**
 * Get either a Gravatar URL or complete image tag for a specified email address.
 *
 * @param string $grav_email The email address
 * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
 * @param string $d Default imageset to use [ 404 | mp | identicon | monsterid | wavatar ]
 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
 * @param boole $img True to return a complete IMG tag False for just the URL
 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
 * @return String containing either just a URL or a complete image tag
 * @source https://gravatar.com/site/implement/images/php/
 */


function get_gravatar(
    $mail,
    $s = 200,
    $d = 'mp',
    $r = 'x',
    $img = false,
    $atts = array())
{
    $options = Typecho_Widget::widget('Widget_Options');
    $mail = $options->grav_mail;
    if (!empty($options->grav_mail)) {
        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($mail)));
        $url .= "?s=$s&d=$d&r=$r";
        if ($img) {
            $url = '<img src="' . $url . '"';
            foreach ($atts as $key => $val)
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }
    }
    return $url;
}


/* function themeFields($layout) {
 $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点LOGO地址'), _t('在这里填入一个图片URL地址, 以在网站标题前加上一个LOGO'));
 $layout->addItem($logoUrl); } */
