<?php

/**-------------------------------
 *    PHP Vague Search API
 * @author Alex Fang
 * @email alex [at] lschs.org
 * LICENSE
 * Copyright (C) 2016 La Salle College High School.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 * 1) All redistributions of source code must retain the above
 *    copyright notice, the list of authors in the original source
 *    code, this list of conditions and the disclaimer listed in this
 *    license;
 *
 * 2) All redistributions in binary form must reproduce the above
 *    copyright notice, this list of conditions and the disclaimer
 *    listed in this license in the documentation and/or other
 *    materials provided with the distribution;
 *
 * 3) Any documentation included with all redistributions must include
 *    the following acknowledgement:
 *
 *      "This product includes software developed by La Salle
 *      College High School`s Department of Information Technology. For further
 *      information, contact the author."
 *
 *    Alternatively, this acknowledgment may appear in the software
 *    itself, and wherever such third-party acknowledgments normally
 *    appear.
 *
 * La Salle College High School provides no reassurances that the source code
 * provided does not infringe the patent or any other intellectual
 * property rights of any other entity.  La Salle College High School disclaims
 * any liability to any recipient for claims brought by any other
 * entity based on infringement of intellectual property rights or
 * otherwise.
 *
 * LICENSEE UNDERSTANDS THAT SOFTWARE IS PROVIDED "AS IS" FOR WHICH
 * NO WARRANTIES AS TO CAPABILITIES OR ACCURACY ARE MADE. LA SALLE COLLEGE
 * HIGH SCHOOL GIVES NO WARRANTIES AND MAKES NO REPRESENTATION THAT
 * SOFTWARE IS FREE OF INFRINGEMENT OF THIRD PARTY PATENT, COPYRIGHT,
 * OR OTHER PROPRIETARY RIGHTS. LA SALLE COLLEGE HIGH SCHOOL MAKES NO
 * WARRANTIES THAT SOFTWARE IS FREE FROM "BUGS", "VIRUSES", "TROJAN
 * HORSES", "TRAP DOORS", "WORMS", OR OTHER HARMFUL CODE.  LICENSEE
 * ASSUMES THE ENTIRE RISK AS TO THE PERFORMANCE OF SOFTWARE AND/OR
 * ASSOCIATED MATERIALS, AND TO THE PERFORMANCE AND VALIDITY OF
 * INFORMATION GENERATED USING SOFTWARE.
 *--------------------------------*/

class Search {
	public function __construct() {
		//
	}



    /**
	 * Keyword gradient search
	 * Search for a list of keywords in a given String. A gradient
	 * is set in percentile so that if the percentile of the final matches
	 * exceed the given gradient, the function returns true.
	 * @param $keywords String Array, the list of given keywords to match
	 * @param $destination String, the given String to perform the search
	 * @param $gradient Integer, gradient in percentile
	 * @param $bias Integer, the oscillation value in percentile. Recommended not to surpass 10%.
	 * @return boolean, true if the result exceeds the gradient, false
	 * if the result doesn't exceed.
	 */
        public function keywordSearch($keywords, $destination, $gradient, $bias) {
                $judgementSequence = array_fill(0, count($keywords), false);
                $iterationCount = 0;
                $judgementScale = [ 0 , count($keywords) ]; //fraction
                foreach($keywords as &$k) {
                        if(preg_match('['.strtolower($k).']', strtolower($destination))) {
                                $judgementSequence[$iterationCount] = true;
                        }
                        $iterationCount++;
                }
                foreach($judgementSequence as &$jsq) {
                        if($jsq) {
                                $judgementScale[0]++;
                        }
                }
		//If false, try to lower the judgementScale
		if((!(($judgementScale[0] / $judgementScale[1]) >= ($gradient / 100))) &&
		   (!((($judgementScale[0] + ($bias/100)) / $judgementScale[1]) >= ($gradient / 100))))) {
				return !((($judgementScale[0] + ($bias/100)) / $judgementScale[1]) - (gradient / 100) <= $bias) ) ? false : true;
		}
                return ((($judgementScale[0] / $judgementScale[1]) >= ($gradient / 100)) ? true : false);
        }
}
