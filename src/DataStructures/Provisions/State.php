<?php
/**
 * This file is part of the Payroll Calculator Package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author         Steeve Andrian Salim
 * @copyright      Copyright (c) Steeve Andrian Salim
 */

// ------------------------------------------------------------------------

namespace IrwanRuntuwene\IndonesiaPayrollCalculator\DataStructures\Provisions;

// ------------------------------------------------------------------------

/**
 * Class State
 * @package Steevenz\IndonesiaPayrollCalculator\DataStructures\Provisions
 */
class State
{
    /**
     * State::$overtimeRegulationCalculation
     * 
     * @var bool 
     */
    public $overtimeRegulationCalculation = true;
    
    /**
     * State::$provinceMinimumWage
     *
     * @var int
     */
    public $provinceMinimumWage = 3940972;

    /**
     * State::$highestWage
     *
     * @var int
     */
    public $highestWage = 7703500;

    /**
     * State::$additionalPTKPforMarriedEmployees
     *
     * @var int
     */
    public $additionalPTKPforMarriedEmployees = 4500000;

    // ------------------------------------------------------------------------

    /**
     * State::$listOfPTKP
     *
     * @var array
     */
    protected $listOfPTKP = [
        'TK/0' => 54000000,
        'TK/1' => 58500000,
        'TK/2' => 63000000,
        'TK/3' => 67500000,
        'K/0'  => 58500000,
        'K/1'  => 63000000,
        'K/2'  => 67500000,
        'K/3'  => 72000000,
    ];

    /**
     * State::$listOfJKKRiskGradePercentage
     *
     * @var array
     */
    protected $listOfJKKRiskGradePercentage = [
        1 => 0.24,
        2 => 0.54,
        3 => 0.89,
        4 => 1.27,
        5 => 1.74,
    ];

    // ------------------------------------------------------------------------

    /**
     * State::__set
     *
     * @param string $name
     * @param int    $value
     */
    public function __set($name, $value)
    {
        if (is_int($value)) {
            $this->{$name} = $value;
        }
    }

    // ------------------------------------------------------------------------

    /**
     * State::__get
     *
     * @param string $name
     *
     * @return int
     */
    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return (int)$this->{$name};
        }

        return 0;
    }

    // ------------------------------------------------------------------------

    /**
     * State::getListOfPTKP
     *
     * @return array
     */
    public function getListOfPTKP()
    {
        return $this->listOfPTKP;
    }

    // ------------------------------------------------------------------------

    // public function getPtkpType('TK/1')
    // {
    //     return 
    // }

    /**
     * State::getPtkp
     *
     * @param int $numOfDependentsFamily
     * @param bool $married
     *
     * @return string
     */
    public function getPtkp($numOfDependentsFamily, $married = false)
    {
        if ($numOfDependentsFamily >= 3) {
            return 'K/3';
        } elseif ($numOfDependentsFamily == 2) {
            return 'K/2';
        } elseif ($numOfDependentsFamily == 1) {
            return 'K/1';
        } elseif ($married !== false) {
            return 'K/0';
        }

        return 'TK/0';
    }

    // ------------------------------------------------------------------------

    /**
     * State::getPtkpAmount
     *
     * @param int  $numOfDependentsFamily
     * @param bool $married
     *
     * @return float
     */
    public function getPtkpAmount($type)
    {
        // if ($numOfDependentsFamily >= 3) {
        //     return $this->listOfPTKP[ 'K/3' ];
        // } elseif ($numOfDependentsFamily == 2) {
        //     return $this->listOfPTKP[ 'K/2' ];
        // } elseif ($numOfDependentsFamily == 1) {
        //     return $this->listOfPTKP[ 'K/1' ];
        // } elseif ($married !== false) {
        //     return $this->listOfPTKP[ 'K/0' ];
        // }

        if(isset( $this->listOfPTKP[ $type ] ) && $this->listOfPTKP[ $type ] > 0 ){
            return $this->listOfPTKP[ $type ];
        } else {
            return $this->listOfPTKP[ 'TK/0' ];
        }
    }

    // ------------------------------------------------------------------------

    /**
     * State::getListOfPTKP
     *
     * @return array
     */
    public function getListOfJKKRiskGradePercentage()
    {
        return $this->listOfJKKRiskGradePercentage;
    }

    // ------------------------------------------------------------------------

    /**
     * State::getJKKRiskGradePercentage
     *
     * @param int $companyRiskGrade
     *
     * @return float
     */
    public function getJKKRiskGradePercentage($companyRiskGrade)
    {
        if (array_key_exists($companyRiskGrade, $this->listOfJKKRiskGradePercentage)) {
            return $this->listOfJKKRiskGradePercentage[ $companyRiskGrade ];
        }

        return $this->listOfJKKRiskGradePercentage[ 2 ];
    }

    // ------------------------------------------------------------------------

    /**
     * State::getBPJSKesehatanGrade
     *
     * @param int $grossTotalIncome
     *
     * @return int
     */
    public function getBPJSKesehatanGrade($grossTotalIncome)
    {
        if ($grossTotalIncome <= 4000000) {
            return 2;
        } elseif ($grossTotalIncome >= 8000000) {
            return 1;
        }

        return 3;
    }
}
