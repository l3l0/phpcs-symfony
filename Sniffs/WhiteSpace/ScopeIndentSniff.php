<?php
/**
 * Symfony_Sniffs_Whitespace_ScopeIndentSniff.
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @author    Marc McIntyre <mmcintyre@squiz.net>
 * @author    Dennis Benkert <spinecrasher@googlemail.com>
 * @version   CVS: $Id: ScopeIndentSniff.php 270281 2008-12-02 02:38:34Z squiz $
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */

/**
 * Symfony_Sniffs_Whitespace_ScopeIndentSniff.
 *
 * Checks that control structures are structured correctly, and their content
 * is indented correctly. This sniff will throw errors if tabs are used
 * for indentation rather than spaces.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @author    Marc McIntyre <mmcintyre@squiz.net>
 * @author    Dennis Benkert <spinecrasher@googlemail.com>
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
class Symfony_Sniffs_WhiteSpace_ScopeIndentSniff extends Generic_Sniffs_WhiteSpace_ScopeIndentSniff
{

    /**
     * The number of spaces code should be indented.
     *
     * @var int
     */
    public $indent = 2;
}
