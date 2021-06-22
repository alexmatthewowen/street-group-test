<?php

namespace App\Helpers;


class HomeOwnerNamesHelper
{
    /**
     * Returns an array of associative array(s) which hold name components.
     *
     * @param string $homeOwnerName
     * @return array
     */
    public static function getHomeOwnerDetails(string $homeOwnerName)
    {
        $names = self::splitHomeOwners($homeOwnerName);

        foreach($names as $key => $val) {
            $names[$key] = self::getNameComponents($val);
        }

        //If the provided string contained more than one name, and the first name did not contain a distinct surname,
        //set the surname of the first name to the same as the second name.
        if (count($names) > 1 && !$names[0]['last_name']) {
            $names[0]['last_name'] = $names[1]['last_name'];
        }

        return $names;
    }

    /**
     * Splits out a string into
     *
     * @param string $homeOwnerName
     * @return string[]
     */
    public static function splitHomeOwners(string $homeOwnerName): array
    {
        if (str_contains($homeOwnerName, ' and ')) {
            return explode(' and ', $homeOwnerName);
        }

        if (str_contains($homeOwnerName, ' & ')) {
            return explode(' & ', $homeOwnerName);
        }

        return [$homeOwnerName];
    }

    /**
     * Checks whether the provided string is a valid initial.
     * Returns true if the provided string is an alphabetic character of length 1 after removing a full stop (if present).
     *
     * @param string $initial
     * @return bool
     */
    public static function isInitial(string $initial)
    {
        $initial = trim(str_replace('.', '', $initial));

        return strlen($initial) === 1 && ctype_alpha($initial);
    }

    /**
     * Takes a name of a single person and returns the components of their name (title, forename, initial, surname).
     * If the string provided does not contain certain data, then these are set to null.
     *
     * @param string $name
     * @return array
     */
    public static function getNameComponents(string $name): array
    {
        $components = explode(' ', $name);
        $numComponents = count($components);

        //Sets the output array with title (since we always expect this to be present), and the last name if present.
        $output = [
            'title'      => $components[0],
            'first_name' => null,
            'initial'    => null,
            'last_name'  => $numComponents > 1 ? end($components) : null
        ];

        if ($numComponents > 2) {

            //Loop through the remaining components of the name (those which are not title or last name).
            //If the element is a valid initial, use it as the initial else use it as the first name.
            $slice = array_splice($components, 1, ($numComponents-2));
            foreach ($slice as $element) {
                self::isInitial($element) ? $output['initial'] = $element : $output['first_name'] = $element;
            }
        }

        return $output;
    }
}
