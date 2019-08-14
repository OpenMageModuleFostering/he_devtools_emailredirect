<?php
/**
 * Created by JetBrains PhpStorm.
 * User: greg c
 * Date: 12/18/12
 * Time: 2:40 PM
 * To change this template use File | Settings | File Templates.
 */
class HEDevTools_EmailRedirect_Model_Email_Info extends Mage_Core_Model_Email_Info
{
    /**
     * Add new "To" recipient to current email
     *
     * @param string $email
     * @param string|null $name
     * @return Mage_Core_Model_Email_Info
     */

    public function addTo($email, $name = null)
    {
        Mage::log("Email Redirect - testing $email ",null,"he_devtools.log");

        $enabled = Mage::getStoreConfig('he_dev_tools/email_redirect/enable');
        $safeDomains = Mage::getStoreConfig('he_dev_tools/email_redirect/safe_domains');
        $redirectEmail = Mage::getStoreConfig('he_dev_tools/email_redirect/redirect_to');

        if ($enabled && $safeDomains && $redirectEmail) {
            $email_item = explode("@", $email);
            if (strpos( $safeDomains , $email_item[1]) === false ) {
                $origEmail = $email;
                $email = $redirectEmail;

                Mage::log("Email Redirect - $origEmail not in allowed domain, redirecting email to $email ",null,"he_devtools.log");
            }
        }

        return parent::addTo($email, $name);
    }
}
