<?php
    namespace App\Core\Fingerprint;

    class BasicFingerprintProvider implements FingerprintProvider {
        private $data;

        public function __construct(array $data){
            $this->data = $data;
        }

        public function provideFingerprint(): string{
            $userAgant = filter_var($this->data['HTTP_USER_AGENT'] ?? '', FILTER_SANITIZE_STRING);
            $ipAddress = filter_var($this->data['REMOTE_ADDR'] ?? '', FILTER_SANITIZE_STRING);

            $string = $userAgant . '|' .$ipAddress;
            
            $hash1 = hash('sha512', $string);
            return hash('sha512', $hash1);
        }
    }