<?php
/**
 * @author      Laurent Jouanneau
 * @copyright   2021 Laurent Jouanneau
 * @licence     MIT
 */

namespace Jelix\GandiApi\ApiV5\Entities;

/**
 * Contact of a domain
 *
 * @property-read string $given
 * @property-read string $family
 * @property-read string $email
 * @property-read string $phone
 * @property-read string $fax
 * @property-read string $mobile
 * @property-read string $orgname
 * @property-read string $siren
 * @property-read string $streetaddr
 * @property-read string $zip
 * @property-read string $city
 * @property-read string $country
 * @property-read string $state
 * @property-read boolean $data_obfuscated
 * @property-read boolean $mail_obfuscated
 * @property-read string $type
 * @property-read boolean $same_as_owner
 * @property-read array $extra_parameters
 * @property-read string $brand_number
 * @property-read string $jo_announce_number
 * @property-read string $jo_announce_page
 * @property-read string $jo_declaration_date
 * @property-read string $jo_publication_date
 * @property-read string $reachability
 * @property-read string $validation
 * @property-read string $sharing_id
 */
class Contact
{
    const CONTACT_TYPE_INDIVIDUAL = 'individual';
    const CONTACT_TYPE_COMPANY = 'company';
    const CONTACT_TYPE_ASSOCIATION = 'association';
    const CONTACT_TYPE_PUBLICBODY = 'publicbody';


    protected $_given = '';
    protected $_family = '';
    protected $_email = '';
    protected $_phone = '';
    protected $_fax = '';
    protected $_mobile = '';

    protected $_orgname = '';
    protected $_siren = '';


    protected $_streetaddr = '';
    protected $_zip = '';
    protected $_city = '';

    /**
     * @var string country code, see https://api.gandi.net/docs/domains/#appendix-Country-Codes
     */
    protected $_country = '';
    protected $_state = 'FR-J';


    protected $_data_obfuscated = true;
    protected $_mail_obfuscated = true;


    protected $_type = 'individual';
    protected $_same_as_owner = false;


    protected $_extra_parameters = array();

    protected $_brand_number = '';

    protected $_jo_announce_number = '';
    protected $_jo_announce_page = '';
    protected $_jo_declaration_date = '';
    protected $_jo_publication_date = '';

    // pending, done, failed, deleted, none
    protected $_reachability = '';

    //  "pending", "done", "failed", "deleted", "none"
    protected $_validation = '';

    protected $_sharing_id ='';

    /**
     * Contact creation, with required properties
     *
     * @param $givenName
     * @param $familyName
     * @param $email
     * @param $country
     * @param $same_as_owner
     * @param $streetaddr
     * @param  string  $type
     */
    function __construct($givenName, $familyName, $email, $country, $streetaddr, $type='individual', $same_as_owner=false)
    {
        $this->_given = $givenName;
        $this->_family = $familyName;
        $this->_email = $email;
        $this->_country = $country;
        $this->_streetaddr = $streetaddr;
        if (!in_array($type, array(
            self::CONTACT_TYPE_INDIVIDUAL,
            self::CONTACT_TYPE_COMPANY,
            self::CONTACT_TYPE_ASSOCIATION,
            self::CONTACT_TYPE_PUBLICBODY,
        ))) {
            throw new \DomainException('Invalid contact type');
        }

        $this->_type = $type;
        $this->_same_as_owner = $same_as_owner;
    }


    /**
     * Create a Contact object from data retrieved with the web API
     * @param \stdClass $rawRecord
     * @return Contact
     */
    static function createFromApi($rawRecord)
    {
        $contact = new Contact(
            $rawRecord->given,
            $rawRecord->family,
            $rawRecord->email,
            $rawRecord->country,
            $rawRecord->streetaddr,
            $rawRecord->type,
            $rawRecord->same_as_owner
        );

        foreach(array('data_obfuscated', 'mail_obfuscated', 'phone', 'fax',
            'mobile', 'orgname', 'siren', 'zip', 'city', 'extra_parameters',
            'brand_number', 'jo_announce_number', 'jo_announce_page',
            'jo_declaration_date', 'jo_publication_date', 'reachability',
            'validation', 'sharing_id'
        ) as $field) {

            if (isset($rawRecord->$field)) {
                $contact->{'_'.$field} = $rawRecord->$field;
            }
        }
        return $contact;
    }

    public function __get($property)
    {
        if (isset($this->{'_'.$property})) {
            return $this->{'_'.$property};
        }
        return null;
    }

    function setAddress($streetaddr, $zip, $city, $country, $state)
    {
        $this->_streetaddr = $streetaddr;
        $this->_zip = $zip;
        $this->_city = $city;
        $this->_country = $country;
        $this->_state = $state;
    }


}
