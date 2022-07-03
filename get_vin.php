<?php
    class Vin_Search {
        /**
         * Plate number of the car
         * 
         * @var string
         */
        private string $plate_number;
        /**
         * @var object
         */
        private object $request;
        /**
         * Construction function
         * 
         * @return void
         */
        public function __construct(){
            $this->request = (object)[
                "get_code" => "https://uzzinivin.lv/?rn=%s",
                "get_vin"  => "https://uzzinivin.lv/v/%s"
            ];
        }
        /**
         * User Agent for the requests
         * 
         * @var string
         */
        private string $user_agent = "Mozilla/5.0 (Windows NT 10.0; Win64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4735.62 Safari/537.36";
        /**
         * Setting the car's plate number to get the VIN number
         * 
         * @param string
         * @return $this
         */
        public function set_plate(string $plate) {
            $this->plate_number = str_replace(" ", "", $plate);
            return $this;
        }
        /** 
         * Find the VIN number by car plate
         * 
         * @return void
        */
        public function find(){
            $code = $this->_get_code();
            $vin  = $this->_get_vin($code);
            print_r( $vin );
        }
        /**
         * @param string $method
         * @param string $uri
         * 
         * @return string
         */
        private function NewRequest(string $method, string $uri) {
            return file_get_contents($uri, false, stream_context_create([
                "http" => [
                    "method" => $method,
                    "header" => join("\r\n", [
                        "User-Agent: " . $this->user_agent
                    ])
                ]
            ]));
        }
        /** 
         * Getting the base64 encoded code that will help to get VIN number in the next request
         * 
         * @return string
        */
        private function _get_code(){
            $string = $this->NewRequest("GET", sprintf($this->request->get_code, $this->plate_number));
            if (!$string) return;
            preg_match("/window\.location\.href\=\"https\:\/\/[a-zA-Z0-9]+\.[a-zA-Z]+\/v\/(.*)\"\;/", $string, $match);
            return end($match);
        }
        /**
         * Getting the VIN
         * 
         * @param string $code
         * @return string
         */
        private function _get_vin(string $code){
            $string = $this->NewRequest("GET", sprintf($this->request->get_vin, $code));
            if (!$string) return;
            preg_match("/https\:\/\/www\.autodna\.lv\/vin\/(.*)\"/", $string, $match);
            return current(explode("\"", $match[1]));
        }
    }
    // Printing out the VIN number
    echo (new Vin_Search)->set_plate("JL 152")->find();