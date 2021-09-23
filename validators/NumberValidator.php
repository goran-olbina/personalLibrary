<?php
    namespace App\Validators;

    use \App\Core\Validator;

    class NumberValidator implements Validator {
        
        private $isRequired;
        private $isReal;
        private $isSigned;
        private $integerLength;
        private $integerRequiredLength;
        private $maxDecimalDigits;

        public function __construct() {
            $this->isRequired            = false;
            $this->isReal                = false;
            $this->isSigned              = false;
            $this->integerRequiredLength = false;
            $this->integerLength         = 11;
            $this->maxDecimalDigits      = 0;
        }


        public function &setRequired():NumberValidator {
            $this->isRequired = true;
            return $this;
        }
        public function &setNotRequired():NumberValidator {
            $this->isRequired = false;
            return $this;
        }


        public function &setInteger():NumberValidator {
            $this->isReal = false;
            return $this;
        }
        public function &setDecimal():NumberValidator {
            $this->isReal = true;
            return $this;
        }


        public function &setSigned():NumberValidator {
            $this->isSigned = true;
            return $this;
        }
        public function &setUnsigned():NumberValidator {
            $this->isSigned = false;
            return $this;
        }


        public function &setRequiredIntegerLength():NumberValidator {
            $this->integerRequiredLength = true;
            return $this;
        }
        public function &setNotRequiredIntegerLength():NumberValidator {
            $this->integerRequiredLength = false;
            return $this;
        }


        public function &setIntegerLength(int $length):NumberValidator {
            $this->integerLength = max(1, $length);
            return $this;
        }


        public function &setMaxDecimalDigits(int $maxDigits):NumberValidator {
            $this->maxDecimalDigits = max(0, $maxDigits);
            return $this;
        }


        public function isValid(string $value): bool{
            $pattern = '/^';

            if($this->isSigned === true){
                $pattern .='\-?';
            }


            if($this->integerRequiredLength === true){
                $pattern .= '[0-9]{' . ($this->integerLength) . '}';
            }


            if($this->integerRequiredLength === false){
                if($this->isRequired === true) {
                    $pattern .= '[1-9][0-9]{0,' . ($this->integerLength-1) . '}';
                }

                if($this->isRequired === false) {
                    $pattern .= '[0-9]{0,' . ($this->integerLength) . '}';
                }
            }


            if($this->isReal === true){
                $pattern .= '\.[0-9]{0,' . $this->maxDecimalDigits . '}';
            }
            
            $pattern .= '$/';

            return boolval(preg_match($pattern, $value));
        }
    }