<?php
/**
 * Symfony_Sniffs_Classes_ValidClassNameSniff.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Leszek Prabucki <leszek.prabucki@goyello.com>>
 */

/**
 * Symfony_Sniffs_Classes_ValidClassNameSniff.
 *
 * Ensures classes are in camel caps, and the first letter is capitalised
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 */
class Symfony_Sniffs_Classes_OnePerFileSniff implements PHP_CodeSniffer_Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return array(
                T_CLASS,
                T_INTERFACE,
               );

    }//end register()


    /**
     * @param PHP_CodeSniffer_File $phpcsFile The current file being processed.
     * @param int                  $stackPtr  The position of the current token in the
     *                                        stack passed in $tokens.
     *
     * @return void
     */
    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
 
        $classesQuantity = 0;
        foreach ($tokens as $token) {
            if ($token['type'] === 'T_INTERFACE' || $token['type'] === 'T_CLASS') {
              $classesQuantity++;    
            }
        }

        if ($classesQuantity > 1) {
            $warning = '%d classes or interfaces are in one file';
            $data    = array(
                       $classesQuantity 
                     );
            $phpcsFile->addWarning($warning, $stackPtr, 'TooManyClasses', $data);
        }

    }//end process()


}//end class
