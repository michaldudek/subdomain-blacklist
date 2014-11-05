<?php
/**
 * @package SubdomainBlacklist
 * @author Michał Dudek <michal@michaldudek.pl>
 * 
 * @copyright Copyright (c) 2014, Michał Dudek
 * @license MIT
 */
namespace MD\SubdomainBlacklist;

/**
 * Common words that your users shouldn't use when setting up accounts.
 */
class SubdomainBlacklist
{

    /**
     * The blacklist.
     * 
     * @var array
     */
    private $list = array();

    /**
     * Validate that the given string is not on the blacklist.
     * 
     * @param  string $string String to be validated.
     * @return boolean
     */
    public function validate($string) {
        $normalized = $this->normalize($string);
        return !in_array($normalized, $this->getList());
    }

    /**
     * Add item to the blacklist.
     *
     * Useful when you want to add some custom (app-specific) words.
     * 
     * @param string|array $add Item (or array of items) string to be added
     *                          to the blacklist.
     */
    public function addToList($add) {
        $add = is_array($add) ? $add : array($add);
        $add = array_map(array($this, 'normalize'), $add);

        // trigger load of the list
        $this->getList();

        $this->list = array_merge($this->list, $add);
    }

    /**
     * Returns the blacklist.
     * 
     * @return array
     */
    public function getList() {
        // if not yet loaded then do it
        if (empty($this->list)) {
            $path = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'blacklist.txt';
            $this->list = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        }

        return $this->list;
    }

    /**
     * Normalizes a string for blacklist validation by removing any suffixed digits,
     * lowercasing it and remove an `s` from the end of it.
     * 
     * @param  string $string String to be normalized.
     * @return string
     */
    protected function normalize($string) {
        $string = rtrim($string, '0123456789');
        $string = strtolower($string);
        $string = (substr($string, -1) === 's') ? substr($string, 0, -1) : $string;
        return $string;
    }

}
