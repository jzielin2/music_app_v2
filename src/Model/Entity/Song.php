<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Song Entity
 *
 * @property int $Id
 * @property int $User_Id
 * @property string $Album
 * @property string $Artist
 * @property string $BitRate
 * @property string $Composer
 * @property string $Genre
 * @property string $Kind
 * @property string $Name
 * @property int $PlayCount
 * @property \Cake\I18n\Time $PlayDateUTC
 * @property int $Rating
 * @property string $SampleRate
 * @property int $Size
 * @property int $SkipCount
 * @property string $TotalTime
 * @property string $TrackID
 * @property int $Year
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Song extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'Id' => false
    ];
}
