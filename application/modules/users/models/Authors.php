<?php
/**
 * This is the Data Mapper class for the Banners table.
 */
class Users_Model_Authors
{
    /**
     * Random password generator
     * The letter l (lowercase L) and the number 1
     * have been removed, as they can be mistaken
     * for each other.
     * @return string
     */
    public function createRandomPassword() {
        $chars = "abcdefghijkmnopqrstuvwxyz023456789";
        srand((double)microtime()*1000000);
        $i = 0;
        $pass = '' ;

        while ($i++ < 10) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $pass .= $tmp;
        }
        return $pass;
    }
}