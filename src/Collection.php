<?php

    namespace jeyofdev\Helper\ManipulateArray;


    use Exception;


    /**
     * @author jeyofdev <jgregoire.pro@gmail.com>
     */
    class Collection
    {
        /**
         * @var array
         */
        private $datas;



        /**
         * @param array $datas
         */
        public function __construct (array $datas)
        {
            $this->datas = $datas;
        }



        /**
         * Get the value of a given index
         *
         * @return string|null
         */
        public function get (string $key) : ?string
        {
            if(array_key_exists($key, $this->datas)){
                return $this->datas[$key];
            } else {
                throw new Exception("The key '$key' does not exist in the array");
            }
        }



        /**
         * Set the value of a given index
         * 
         * @return self
         */
        public function set ($key, $value) : self
        {
            $this->datas[$key] = $value;
            return $this;
        }



        /**
         * Get the contents of an array
         *
         * @return array
         */
        public function getDatas () : array
        {
            return $this->datas;
        }
    }