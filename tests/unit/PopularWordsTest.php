<?php

use Codeception\Test\Unit;
//use UnitTester;
use TestFunc\Str\Str;

class PopularWordsTest extends Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    protected  function testIt($expected, $source) 
    {
        $I = $this->tester;
        
        $result = getPopularWords($source);
//        $I->pre($expected, 'expected');
//        $I->pre($result, 'result');
        $I->assertEquals($expected, $result);
        
    }
    
    public function testSimpleStr()
    {
        $source = 'Мой дядя самых честных правил, честных правил самых, правил.';
        $expected = [
          'правил' => 3,
          'самых' => 2,
          'честных' => 2,
          'Мой' => 1,
          'дядя' => 1, 
        ];
          
        $this->testIt($expected, $source);
    }
    
    public function testEmptyStr()
    {
        $source = '';
        $expected = [];
          
        $this->testIt($expected, $source);
    }
    
    public function testWithDigits()
    {
        $source = '-- ! -- -! i18n, i18n, i18n, 2000 2000 15 15 15 15';
        $expected = [
            '15' => 4,
            'i18n' => 3,
            '--' => 2,
            '2000' => 2,
            '-' => 1,
        ];
        
        $this->testIt($expected, $source);
    }
    
    
    public function testWithDigitsSmallerResult()
    {
        $source = 'i18n, i18n, i18n, 2000 2000 15 15 15 15';
        $expected = [
            '15' => 4,
            'i18n' => 3,
            '2000' => 2,
        ];
        
        $this->testIt($expected, $source);
    }
    
    
    public function testEnglishSimpleStr()
    {
        $source = 'My uncle! has the most, honest rules, the most honest rules, the rules. ';
        $expected = [
          'rules' => 3,
          'the' => 3,
          'most' => 2,
          'honest' => 2,
          'My' => 1, 
        ];
          
        $this->testIt($expected, $source);
    }
    
    
    public function testChainiseTraditional()
    {
        $source = '我叔叔有最誠實的規則，最誠實的規則，規則。';
        $expected = [
            '我叔叔有最誠實的規則' => 1,
            '最誠實的規則' => 1,
            '規則' => 1,
        ];
          
        $this->testIt($expected, $source);
    }

   
}