<?php

namespace LSTATS\RiotBundle\Twig;

class ChampionExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('fillSpell', array($this, 'fillSpellWithValues')),
        );
    }

    public function fillSpellWithValues($spell)
    {
        try {
            while ($beginning = strpos($spell['sanitizedTooltip'], '{{ ')) {
                $strToReplace = substr($spell['sanitizedTooltip'], $beginning, 8);
                $replacedWith = '';
                if ($strToReplace[3] == 'e') {
                    $replacedWith = '<span class=value>' . $spell['effectBurn'][$strToReplace[4]] . '</span>';
                } else if ($strToReplace[3] == 'a') {
                    $replacedWith = '<span class="coeff">' . $spell['vars'][0]['coeff'][0] . '</span>';
                }
                $spell['sanitizedTooltip'] = str_replace($strToReplace, $replacedWith, $spell['sanitizedTooltip']);
            }
            return $spell['sanitizedTooltip'];
        } catch (\Exception $e) {
            return '';
        }
    }
}