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
class Symfony_Sniffs_Classes_ValidClassNameSniff implements PHP_CodeSniffer_Sniff
{
    public $classNamePattern = '/^[a-zA-Z0-9]+$/';

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
     * Processes this test, when one of its tokens is encountered.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The current file being processed.
     * @param int                  $stackPtr  The position of the current token in the
     *                                        stack passed in $tokens.
     *
     * @return void
     */
    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        
        if (isset($tokens[$stackPtr]['scope_opener']) === false) {
            $error = 'Possible parse error: %s missing opening or closing brace';
            $data  = array($tokens[$stackPtr]['content']);
            $phpcsFile->addWarning($error, $stackPtr, 'MissingBrace', $data);
            return;
        }

        // Determine the name of the class or interface. Note that we cannot
        // simply look for the first T_STRING because a class name
        // starting with the number will be multiple tokens.
        $opener    = $tokens[$stackPtr]['scope_opener'];
        $nameStart = $phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 1), $opener, true);
        $nameEnd   = $phpcsFile->findNext(T_WHITESPACE, $nameStart, $opener);
        $name      = trim($phpcsFile->getTokensAsString($nameStart, ($nameEnd - $nameStart)));

        //$valid = preg_match('/^gy[A-Z]{1}[a-zA-Z0-9]+$/', $name);
        $valid = preg_match($this->classNamePattern, $name);
        $isInterface = false;
       
        $type    = ucfirst($tokens[$stackPtr]['content']);
        
        if($valid && $type == 'Interface') {
            if (!preg_match('/^.*Interface$/', $name)) {
                $valid = false; 
                $isInterface = true; 
            }
        }
        
        if (!$valid) {
            $warning = '%s name "%s" does not match to %s pattern%s';
            $data    = array(
                      $type,
                      $name,
                      $this->classNamePattern,
                      ($isInterface) ? ' does not end with "Interface" word' : ''
                     );
            $phpcsFile->addWarning($warning, $stackPtr, 'NotValidClassName', $data);
        }

    }//end process()


}//end class
