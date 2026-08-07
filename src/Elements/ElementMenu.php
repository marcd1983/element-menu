<?php

namespace Antlion\ElementMenu\Elements;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\ToggleCompositeField;
use SilverStripe\LinkField\Form\MultiLinkField;
use SilverStripe\LinkField\Models\Link;

/**
 * @property string $Orientation
 * @property string $Alignment
 */
class ElementMenu extends BaseElement
{
    private static string $table_name = 'ElementMenu';
    private static string $singular_name = 'Menu';
    private static string $plural_name = 'Menus';
    private static string $description = 'A Foundation CSS menu block';
    private static string $icon = 'font-icon-menu';

    private static array $db = [
        'Orientation' => "Enum('horizontal,vertical','horizontal')",
        'Alignment'   => "Enum('align-left,align-center,align-right,align-spaced','align-left')",
    ];

    private static array $has_many = [
        'Links' => Link::class . '.Owner',
    ];

    private static array $owns = [
        'Links',
    ];

    private static array $cascade_deletes = [
        'Links',
    ];

    private static array $cascade_duplicates = [
        'Links',
    ];

    public function getCMSFields(): FieldList
    {
        $fields = parent::getCMSFields();

        $fields->removeByName(['Orientation', 'Alignment', 'Links']);

        $fields->addFieldToTab(
            'Root.Main',
            MultiLinkField::create('Links', 'Menu items')
        );

        $fields->addFieldToTab('Root.Main', ToggleCompositeField::create(
            'MenuAppearanceGroup',
            'Appearance',
            [
                DropdownField::create('Orientation', 'Orientation', [
                    'horizontal' => 'Horizontal',
                    'vertical'   => 'Vertical',
                ]),
                DropdownField::create('Alignment', 'Item alignment', [
                    'align-left'   => 'Left',
                    'align-center' => 'Center',
                    'align-right'  => 'Right',
                    'align-spaced' => 'Spaced',
                ])->setDescription('Applies to horizontal menus. Spaced distributes items evenly.'),
            ]
        ));

        return $fields;
    }

    public function MenuClasses(): string
    {
        return trim(implode(' ', [
            $this->Orientation ?: 'horizontal',
            $this->Alignment   ?: 'align-left',
        ]));
    }

    public function getSummary(): string
    {
        $count = $this->Links()->Count();
        return $count ? "{$count} menu item(s)" : 'No items';
    }

    public function getType(): string
    {
        return 'Menu';
    }
}
